<?php
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

try {

    $query = $writeDB->prepare("SELECT `account_id`, UNIX_TIMESTAMP(`access_token_expiry`) AS `access_token_expiry`, `is_active`, `login_attempts` FROM `sessions`, `accounts` WHERE `sessions`.`account_id` = `accounts`.`id` AND `access_token` = :accessToken");
    $query->bindParam(":accessToken", $accessToken, PDO::PARAM_STR);
    $query->execute();

    $rowCount = $query->rowCount();
    if ($rowCount === 0) {
        $response = new Response();
        $response->setHttpStatusCode(401);
        $response->setSuccess(false);
        $response->addMessage("Error: access token provided is invalid.");
        $response->send();
        exit();
    }

    $row = $query->fetch(PDO::FETCH_OBJ);
    $_accountID = $row->account_id;
    $_accessExpiry = $row->access_token_expiry;
    $_isActive = $row->is_active;
    $_loginAttempts = $row->login_attempts;

    if ($_loginAttempts > 2) {
        $response = new Response();
        $response->setHttpStatusCode(401);
        $response->setSuccess(false);
        $response->addMessage('User account currently locked.');
        $response->send();
        exit();
    }

    if ($_accessExpiry < time()) {
        $response = new Response();
        $response->setHttpStatusCode(401);
        $response->setSuccess(false);
        $response->addMessage('Access token expired.');
        $response->send();
        exit();
    }

    if (!$_isActive) {
        $response = new Response();
        $response->setHttpStatusCode(401);
        $response->setSuccess(false);
        $response->addMessage('User account currently inactive.');
        $response->send();
        exit();
    }
} catch (PDOException $e) {
    $response = new Response();
    $response->setHttpStatusCode(500);
    $response->setSuccess(false);
    $response->addMessage('User authentication failed. Please try again.');
    $response->send();
    exit();
}
?>