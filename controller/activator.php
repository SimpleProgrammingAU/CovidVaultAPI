<?php

require_once '../model/Config.php';
require_once '../model/DB.php';
require_once '../model/Activator.php';
require_once '../model/Location.php';
require_once '../model/Response.php';

try {
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

try {
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (!isset($_GET['id'])) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: request did not contain a valid id.");
      $response->send();
      exit();
    }

    if (!isset($_GET['a'], $_GET['c'])) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      (!isset($_GET['a']) ? $response->addMessage("Error: request did not contain a valid account id.") : false);
      (!isset($_GET['c']) ? $response->addMessage("Error: request did not contain a valid activation code.") : false);
      $response->send();
      exit();
    }

    $activator = new Activator();
    $activator->setID(intval($_GET['id']));
    $activator->setAccountID(intval($_GET['a']));
    $activator->setActivator($_GET['c']);

    $query_id = $activator->getID();
    $query_aid = $activator->getAccountID();
    $query_code = $activator->getActivator();
    $query = $writeDB->prepare("SELECT * FROM activators WHERE id=:i AND account_id=:a AND activator=:c");
    $query->bindParam(":i", $query_id, PDO::PARAM_STR);
    $query->bindParam(":a", $query_aid, PDO::PARAM_STR);
    $query->bindParam(":c", $query_code, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(404);
      $response->setSuccess(false);
      $response->addMessage("Error: matching account activator not found.");
      $response->send();
      exit();
    }

    $query = $writeDB->prepare("SELECT is_active FROM accounts WHERE id=:id");
    $query->bindParam(":id", $query_aid, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(404);
      $response->setSuccess(false);
      $response->addMessage("Error: account not found.");
      $response->send();
      exit();
    }

    $is_active = boolval($query->fetch(PDO::FETCH_ASSOC)['is_active']);
    $response_data = [
      "valid" => true,
      "accountActive" => $is_active
    ];
    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(true);
    $response->setData($response_data);
    $response->send();
    if ($is_active) {
      Config::RegisterAPIAccess($query_aid, 'activator');
    }
    exit();
  } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $activator = new Activator();
    if (isset($_GET['id'])) {
      $activator->setAccountID(intval($_GET['id']));
    } else {
      $raw_post_data = file_get_contents('php://input');
      if (!$json_data = json_decode($raw_post_data)) {
        $response = new Response();
        $response->setHttpStatusCode(400);
        $response->setSuccess(false);
        $response->addMessage("Error: request body is not valid JSON.");
        $response->send();
        exit();
      }
      if (!isset($json_data->email)) {
        $response = new Response();
        $response->setHttpStatusCode(400);
        $response->setSuccess(false);
        (!isset($json_data->email) ? $response->addMessage("Error: request did not contain a valid email address.") : false);
        $response->send();
        exit();
      }

      $location = new Location();
      $location->setEmailAddress($json_data->email);
      $query_email = $location->getEmailAddress();
      $query = $writeDB->prepare("SELECT id, auth_contact FROM accounts WHERE email=:e LIMIT 1");
      $query->bindParam(":e", $query_email, PDO::PARAM_STR);
      $query->execute();

      $row_count = $query->rowCount();
      if ($row_count === 0) {
        $response = new Response();
        $response->setHttpStatusCode(404);
        $response->setSuccess(false);
        $response->addMessage("Error: account not found.");
        $response->send();
        exit();
      }

      $row = $query->fetch(PDO::FETCH_ASSOC);
      $location->setID(intval($row['id']));
      $location->setAuthContact($row['auth_contact']);
      $activator->setAccountID($location->getID());
    }
    $activator->generateActivator();

    $query_id = $activator->getAccountID();
    $query_code = $activator->getActivator();
    $query = $writeDB->prepare("INSERT INTO activators(account_id, activator) VALUES (:id, :c)");
    $query->bindParam(":id", $query_id, PDO::PARAM_STR);
    $query->bindParam(":c", $query_code, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(404);
      $response->setSuccess(false);
      $response->addMessage("Error: matching account activator not found.");
      $response->send();
      exit();
    }

    $activator->setID($writeDB->lastInsertId());
    $response_data = [
      "id" => $activator->getID(),
      "activator" => $query_code
    ];

    if (!isset($_GET['id'])) {
      $verify_url = $activator->getBaseURL() . "dashboard/?id={$activator->getID()}&a={$activator->getAccountID()}&c={$activator->getActivator()}";
      if (!Config::Mailer([
        "type" => "password",
        "contact_name" => $location->getAuthorisedContact(),
        "email" => $location->getEmailAddress(),
        "verify_url" => $verify_url
      ])) {
        $response = new Response();
        $response->setHttpStatusCode(500);
        $response->setSuccess(false);
        $response->addMessage("Could not send password reset email.");
        $response->send();
        exit();
      }
    }

    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(true);
    $response->setData($response_data);
    $response->send();
    exit();
  } elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH') {

    if (!isset($_GET['id'])) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: request did not contain a valid id.");
      $response->send();
      exit();
    }

    $raw_post_data = file_get_contents('php://input');
    if (!$json_data = json_decode($raw_post_data)) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: request body is not valid JSON.");
      $response->send();
      exit();
    }

    if (!isset($json_data->accountID, $json_data->code)) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      (!isset($json_data->accountID) ? $response->addMessage("Error: request did not contain a valid account id.") : false);
      (!isset($json_data->code) ? $response->addMessage("Error: request did not contain a valid activation code.") : false);
      $response->send();
      exit();
    }

    $activator = new Activator();
    $activator->setID(intval($_GET['id']));
    $activator->setAccountID(intval($json_data->accountID));
    $activator->setActivator($json_data->code);

    $query_aid = $activator->getAccountID();
    $query = $writeDB->prepare("SELECT is_active FROM accounts WHERE id=:id");
    $query->bindParam(":id", $query_aid, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(404);
      $response->setSuccess(false);
      $response->addMessage("Error: account not found.");
      $response->send();
      exit();
    }

    $is_active = boolval($query->fetch(PDO::FETCH_ASSOC)['is_active']);

    if ($is_active && !isset($json_data->password)) {
      $response = new Response();
      $response->setHttpStatusCode(403);
      $response->setSuccess(false);
      $response->addMessage("Error: no password supplied for update.");
      $response->send();
      exit();
    }

    $query_id = $activator->getID();
    $query_code = $activator->getActivator();
    $query = $writeDB->prepare("DELETE FROM `activators` WHERE id=:id AND account_id=:a AND activator=:c");
    $query->bindParam(":id", $query_id, PDO::PARAM_STR);
    $query->bindParam(":a", $query_aid, PDO::PARAM_STR);
    $query->bindParam(":c", $query_code, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(403);
      $response->setSuccess(false);
      $response->addMessage("Error: matching activator not found.");
      $response->send();
      exit();
    }

    if ($is_active) {
      $passwordHash = password_hash($json_data->password, PASSWORD_DEFAULT);
      $query = $writeDB->prepare("UPDATE accounts SET auth=:a, login_attempts=0 WHERE id=:id");
      $query->bindParam(":a", $passwordHash, PDO::PARAM_STR);
      $query->bindParam(":id", $query_aid, PDO::PARAM_STR);
      $query->execute();

      $row_count = $query->rowCount();
      if ($row_count === 0) {
        $response = new Response();
        $response->setHttpStatusCode(500);
        $response->setSuccess(false);
        $response->addMessage("Error: password not updated.");
        $response->send();
        exit();
      }

      $query = $writeDB->prepare("DELETE FROM `sessions` WHERE account_id=:id");
      $query->bindParam(":id", $query_aid, PDO::PARAM_STR);
      $query->execute();

      $response = new Response();
      $response->setHttpStatusCode(200);
      $response->setSuccess(true);
      $response->send();
      Config::RegisterAPIAccess($query_aid, "activator");
      exit();
    } else {
      $query = $writeDB->prepare("UPDATE accounts SET is_active=1, login_attempts=0 WHERE id=:id");
      $query->bindParam(":id", $query_aid, PDO::PARAM_STR);
      $query->execute();

      $row_count = $query->rowCount();
      if ($row_count === 0) {
        $response = new Response();
        $response->setHttpStatusCode(500);
        $response->setSuccess(false);
        $response->addMessage("Error: account not activated.");
        $response->send();
        exit();
      }

      $response = new Response();
      $response->setHttpStatusCode(200);
      $response->setSuccess(true);
      $response->send();
      exit();
    }
  } else {
    $response = new Response();
    $response->setHttpStatusCode(405);
    $response->setSuccess(false);
    $response->addMessage("Error: request method not permitted on the user endpoint.");
    $response->send();
    exit();
  }
} catch (PDOException $e) {
  error_log("Exception: " . $e->getMessage());
  $response = new Response();
  $response->setHttpStatusCode(500);
  $response->setSuccess(false);
  $response->addMessage("Error: database error.");
  $response->addMessage("Query: {$query->queryString}.");
  $response->addMessage("GET ID: {$_GET['id']}.");
  $response->addMessage("Query ID: {$query_aid}.");
  $response->send();
  exit();
} catch (APIException $e) {
  $response = new Response();
  $response->setHttpStatusCode(400);
  $response->setSuccess(false);
  $response->addMessage("API Error: " . $e->getMessage());
  $response->send();
  exit();
} catch (Error $e) {
  error_log("Exception: " . $e->getMessage());
  $response = new Response();
  $response->setHttpStatusCode(500);
  $response->setSuccess(false);
  $response->addMessage("Unknown error.");
  $response->send();
  exit();
}
