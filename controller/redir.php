<?php

require_once '../model/Config.php';
require_once '../model/DB.php';
require_once '../model/Location.php';
require_once '../model/Response.php';

try {
  $readDB = DB::connectReadDB();
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
    if (!isset($_GET['shortname'])) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: request did not contain a shortname.");
      $response->send();
      exit();
    }

    $shortname = $_GET['shortname'];
    $query = $readDB->prepare("SELECT `id` FROM `accounts` WHERE `shortname`=:sn");
    $query->bindParam(':sn', $shortname, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(409);
      $response->setSuccess(false);
      $response->addMessage("Error: matching shortname not found.");
      $response->send();
      exit();
    }

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];
    Config::RegisterAPIAccess($id, 'shortlink');
    header("Location: " . getenv("BASE_URL") . "checkin/?id=$id", true, 303);
    exit();

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
