<?php

require_once '../model/DB.php';
require_once '../model/Response.php';

try{

    $writeDB = DB::connectWriteDB();

} catch (PDOException $e) {
    error_log("Exception: " . $e->getMessage(), 0);
    $response = new Response();
    $response->setHttpStatusCode(500);
    $response->setSuccess(false);
    $response->addMessage("Error: connection to database could not be established.");
    $response->send();
    exit();
}

if (array_key_exists("id", $_GET)) {

    $sessionid = $_GET['id'];
    if ($sessionid === '' || !is_numeric($sessionid)) {
        $response = new Response();
        $response->setHttpStatusCode(400);
        $response->setSuccess(false);
        $response->addMessage("Error: Session ID cannot be blank or non-numeric.");
        $response->send();
        exit();
    }

    if (!isset($_SERVER['HTTP_AUTHORIZATION']) || strlen($_SERVER['HTTP_AUTHORIZATION']) < 1) {
        $response = new Response();
        $response->setHttpStatusCode(401);
        $response->setSuccess(false);
        (!isset($_SERVER['HTTP_AUTHORIZATION']) ? $response->addMessage("Error: Access token not received.") : false);
        (strlen($_SERVER['HTTP_AUTHORIZATION'] < 1) ? $response->addMessage("Error: Access token cannot be blank.") : false);
        $response->send();
        exit();
    }

    $accessToken = $_SERVER['HTTP_AUTHORIZATION'];

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        try {

            $query = $writeDB->prepare("DELETE FROM `sessions` WHERE `id` = :sessionid AND `access_token` = :accessToken");
            $query->bindParam(":sessionid", $sessionid, PDO::PARAM_INT);
            $query->bindParam(":accessToken", $accessToken, PDO::PARAM_STR);
            $query->execute();

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                $response = new Response();
                $response->setHttpStatusCode(400);
                $response->setSuccess(false);
                $response->addMessage("Error: failed to log out of this session.");
                $response->send();
                exit();
            }

            $returnData = [];
            $returnData['session_id'] = intval($sessionid);

            $response = new Response();
            $response->setHttpStatusCode(200);
            $response->setSuccess(true);
            $response->addMessage("Session successfully logged out.");
            $response->setData($returnData);
            $response->send();
            exit();

        } catch (PDOException $e) {
            error_log("Error: " . $e);
            $response = new Response();
            $response->setHttpStatusCode(500);
            $response->setSuccess(false);
            $response->addMessage("Error: problem accessing database.");
            $response->send();
            exit();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH') {

        if ($_SERVER['CONTENT_TYPE'] !== 'application/json') {
            $response = new Response();
            $response->setHttpStatusCode(400);
            $response->setSuccess(false);
            $response->addMessage("Error: content type header not set to JSON.");
            $response->send();
            exit();
        }

        $rawPatchData = file_get_contents('php://input');
        if (!$jsonData = json_decode($rawPatchData)) {
            $response = new Response();
            $response->setHttpStatusCode(400);
            $response->setSuccess(false);
            $response->addMessage("Error: request body is not valid JSON.");
            $response->send();
            exit();
        }

        if (!isset($jsonData->refreshToken) || strlen($jsonData->refreshToken) < 1) {
            $response = new Response();
            $response->setHttpStatusCode(400);
            $response->setSuccess(false);
            (!isset($jsonData->refreshToken) ? $response->addMessage("Error: refresh token required.") : false);
            (strlen($jsonData->refreshToken) < 1 ? $response->addMessage("Error: refresh token cannot be blank.") : false);
            $response->send();
            exit();
        }

        try {

            $refreshToken = $jsonData->refreshToken;
            $query = $writeDB->prepare("SELECT `sessions`.`id` as sessionID, `sessions`.`account_id` as accountID, access_token, refresh_token, UNIX_TIMESTAMP(access_token_expiry) AS access_token_expiry,  UNIX_TIMESTAMP(refresh_token_expiry) AS refresh_token_expiry, is_active, login_attempts FROM `sessions`, `accounts` WHERE `accounts`.`id`=`sessions`.`account_id` AND `sessions`.`id` = :sessionID AND `sessions`.`access_token` = :accessToken AND `sessions`.`refresh_token` = :refreshToken");
            $query->bindParam(":sessionID", $sessionid, PDO::PARAM_STR);
            $query->bindParam(":accessToken", $accessToken, PDO::PARAM_STR);
            $query->bindParam(":refreshToken", $refreshToken, PDO::PARAM_STR);
            $query->execute();

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                $response = new Response();
                $response->setHttpStatusCode(401);
                $response->setSuccess(false);
                $response->addMessage("Error: access token or refresh token is invalid for session ID.");
                $response->send();
                exit();
            }

            $row = $query->fetch(PDO::FETCH_OBJ);
            $_sessionID = $row->sessionID;
            $_accountID = $row->accountID;
            $_accessToken = $row->access_token;
            $_refreshToken = $row->refresh_token;
            $_is_active = intval($row->is_active);
            $_loginAttempts = $row->login_attempts;
            $_accessExpiry = $row->access_token_expiry;
            $_refreshExpiry = $row->refresh_token_expiry;

            if ($_is_active !== 1) {
                $response = new Response();
                $response->setHttpStatusCode(401);
                $response->setSuccess(false);
                $response->addMessage("Error: account not currently active.");
                $response->send();
                exit();
            }

            if ($_loginAttempts > 2) {
                $response = new Response();
                $response->setHttpStatusCode(401);
                $response->setSuccess(false);
                $response->addMessage("Error: account is locked.");
                $response->send();
                exit();
            }

            if ($_refreshExpiry < time()) {
                $response = new Response();
                $response->setHttpStatusCode(401);
                $response->setSuccess(false);
                $response->addMessage("Error: refresh token has expired, please login again.");
                $response->send();
                exit();
            }

            $accessToken = base64_encode(bin2hex(openssl_random_pseudo_bytes(24)).time());
            $refreshToken = base64_encode(bin2hex(openssl_random_pseudo_bytes(24)).time());
            $accessExpiry = 16*60*60;
            $refreshExpiry = 28*24*60*60;

            $query= $writeDB->prepare("UPDATE `sessions` SET
                `access_token`=:accessToken,
                `access_token_expiry`=DATE_ADD(NOW(), INTERVAL :accessTokenExpiry SECOND),
                `refresh_token`=:refreshToken,
                `refresh_token_expiry`=DATE_ADD(NOW(), INTERVAL :refreshTokenExpiry SECOND)
                 WHERE `id`=:sessionID AND `account_id`=:accountID AND
                `access_token`=:oldAccessToken AND `refresh_token`=:oldRefreshToken");
            $query->bindParam(":accessToken", $accessToken, PDO::PARAM_STR);
            $query->bindParam(":accessTokenExpiry", $accessExpiry, PDO::PARAM_INT);
            $query->bindParam(":refreshToken", $refreshToken, PDO::PARAM_STR);
            $query->bindParam(":refreshTokenExpiry", $refreshExpiry, PDO::PARAM_INT);
            $query->bindParam(":sessionID", $_sessionID, PDO::PARAM_INT);
            $query->bindParam(":accountID", $_accountID, PDO::PARAM_INT);
            $query->bindParam(":oldAccessToken", $_accessToken, PDO::PARAM_STR);
            $query->bindParam(":oldRefreshToken", $_refreshToken, PDO::PARAM_STR);
            $query->execute();

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                $response = new Response();
                $response->setHttpStatusCode(401);
                $response->setSuccess(false);
                $response->addMessage("Error: access token could not be refreshed, please login again.");
                $response->send();
                exit();
            }

            $returnData = [];
            $returnData['accountID'] = $_accountID;
            $returnData['sessionID'] = $_sessionID;
            $returnData['accessToken'] = $accessToken;
            $returnData['accessExpiry'] = $accessExpiry;
            $returnData['refreshToken'] = $refreshToken;
            $returnData['refreshExpiry'] = $refreshExpiry;

            $response = new Response();
            $response->setHttpStatusCode(200);
            $response->setSuccess(true);
            $response->addMessage("Access token successfully refreshed.");
            $response->setData($returnData);
            $response->send();
            exit();

        } catch (PDOException $e) {
            error_log($e);
            $response = new Response();
            $response->setHttpStatusCode(500);
            $response->setSuccess(false);
            $response->addMessage("Error: database query failed please login again.");
            $response->send();
            exit();
        }

    } else {
        $response = new Response();
        $response->setHttpStatusCode(405);
        $response->setSuccess(false);
        $response->addMessage("Error: request method not permitted on this endpoint.");
        $response->send();
        exit();
    }

} elseif (empty($_GET)) {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $response = new Response();
        $response->setHttpStatusCode(405);
        $response->setSuccess(false);
        $response->addMessage("Error: request method not permitted on this endpoint.");
        $response->send();
        exit();
    }

    sleep(1);

    if ($_SERVER['CONTENT_TYPE'] !== 'application/json') {
        $response = new Response();
        $response->setHttpStatusCode(400);
        $response->setSuccess(false);
        $response->addMessage("Error: content type header not set to JSON.");
        $response->send();
        exit();
    }

    $rawPostData = file_get_contents('php://input');

    if (!$jsonData = json_decode($rawPostData)) {
        $response = new Response();
        $response->setHttpStatusCode(400);
        $response->setSuccess(false);
        $response->addMessage("Error: request body is not valid JSON.");
        $response->send();
        exit();
    }

    if (!isset($jsonData->username) || !isset($jsonData->password)) {
        $response = new Response();
        $response->setHttpStatusCode(400);
        $response->setSuccess(false);
        $response->addMessage("Error: email and password must be provided to login.");
        $response->send();
        exit();
    }

    if (strlen($jsonData->username) < 1 || strlen($jsonData->username) > 127 || strlen($jsonData->password) < 1 || strlen($jsonData->password) > 127) {
        $response = new Response();
        $response->setHttpStatusCode(400);
        $response->setSuccess(false);
        (strlen($jsonData->username) < 1 ? $response->addMessage("Error: Username cannot be blank.") : false);
        (strlen($jsonData->username) > 127 ? $response->addMessage("Error: Username cannot exceed 127 characters.") : false);
        (strlen($jsonData->password) < 1 ? $response->addMessage("Error: Password cannot be blank.") : false);
        (strlen($jsonData->password) > 127 ? $response->addMessage("Error: Password cannot exceed 127 characters.") : false);
        $response->send();
        exit();
    }

    try {

        $username = $jsonData->username;
        $password = $jsonData->password;
        $query = $writeDB->prepare("SELECT * FROM accounts WHERE email=:username");
        $query->bindParam(":username", $username, PDO::PARAM_STR);
        $query->execute();

        $rowCount = $query->rowCount();

        if ($rowCount === 0) {
            $response = new Response();
            $response->setHttpStatusCode(401);
            $response->setSuccess(false);
            $response->addMessage("Error: username or password is incorrect.");
            $response->send();
            exit();
        }

        $row = $query->fetch(PDO::FETCH_OBJ);
        $account_id = $row->id;
        $name = $row->business_name;
        $email = $row->email;
        $dbPassword = $row->auth;
        $is_active = intval($row->is_active);
        $loginAttempts = $row->login_attempts;

        if ($loginAttempts > 2) {
            $response = new Response();
            $response->setHttpStatusCode(401);
            $response->setSuccess(false);
            $response->addMessage("Error: account locked.");
            $response->send();
            exit();
        }

        if (!password_verify($password, $dbPassword)) {
            $query = $writeDB->prepare("UPDATE `accounts` SET `login_attempts`=`login_attempts`+1 WHERE id=:id");
            $query->bindParam(":id", $account_id, PDO::PARAM_STR);
            $query->execute();

            $response = new Response();
            $response->setHttpStatusCode(401);
            $response->setSuccess(false);
            $response->addMessage("Error: username or password is incorrect.");
            $response->send();
            exit();
        }

        if ($is_active !== 1) {
            $response = new Response();
            $response->setHttpStatusCode(401);
            $response->setSuccess(false);
            $response->addMessage("Error: account does not have this feature switched on.");
            $response->setData(["is_active" => $is_active, "from_server" => $row->is_active ]);
            $response->send();
            exit();
        }

        $accessToken = base64_encode(bin2hex(openssl_random_pseudo_bytes(24)).time());
        $refreshToken = base64_encode(bin2hex(openssl_random_pseudo_bytes(24)).time());
        $accessExpiry = 1200;
        $refreshExpiry = 28*24*60*60;
    } catch (PDOException $e) {
        $response = new Response();
        $response->setHttpStatusCode(500);
        $response->setSuccess(false);
        $response->addMessage("Error: database query failed on login.");
        $response->send();
        exit();
    }

    try {

        $writeDB->beginTransaction();
        $query = $writeDB->prepare("UPDATE `accounts` SET `login_attempts`=0 WHERE id=:id");
        $query->bindParam(":id", $account_id, PDO::PARAM_STR);
        $query->execute();

        $query = $writeDB->prepare("INSERT INTO `sessions`
                    (`account_id`, `access_token`, `access_token_expiry`, `refresh_token`, `refresh_token_expiry`)
                    VALUES (:accountID, :accessToken, DATE_ADD(NOW(), INTERVAL :accessExpiry SECOND), :refreshToken, DATE_ADD(NOW(), INTERVAL :refreshExpiry SECOND))");
        $query->bindParam(":accountID", $account_id, PDO::PARAM_STR);
        $query->bindParam(":accessToken", $accessToken, PDO::PARAM_STR);
        $query->bindParam(":accessExpiry", $accessExpiry, PDO::PARAM_INT);
        $query->bindParam(":refreshToken", $refreshToken, PDO::PARAM_STR);
        $query->bindParam(":refreshExpiry", $refreshExpiry, PDO::PARAM_INT);
        $query->execute();

        $lastSessionId = $writeDB->lastInsertId();

        $writeDB->commit();

        $returnData = [];
        $returnData['accountID'] = $account_id;
        $returnData['sessionID'] = intval($lastSessionId);
        $returnData['accessToken'] = $accessToken;
        $returnData['accessExpiry'] = $accessExpiry;
        $returnData['refreshToken'] = $refreshToken;
        $returnData['refreshExpiry'] = $refreshExpiry;

        $response = new Response();
        $response->setHttpStatusCode(201);
        $response->setSuccess(true);
        $response->setData($returnData);
        $response->send();
        exit();

    } catch (PDOException $e) {
        $writeDB->rollBack();
        error_log("ERROR: " . $e);
        $response = new Response();
        $response->setHttpStatusCode(500);
        $response->setSuccess(false);
        $response->addMessage("Error: database query failed on login - please try again.");
        $response->send();
        exit();
    }

} else {
    $response = new Response();
    $response->setHttpStatusCode(404);
    $response->setSuccess(false);
    $response->addMessage("Error: endpoint not found.");
    $response->send();
    exit();
}

?>