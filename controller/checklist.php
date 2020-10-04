<?php

require_once '../model/Config.php';
require_once '../model/DB.php';
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

if (!isset($_GET['id'])) {
  $response = new Response();
  $response->setHttpStatusCode(400);
  $response->setSuccess(false);
  $response->addMessage("Error: Account / check item id not sent.");
  $response->send();
  exit();
}

try {

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    include('./authenticate.php');

    $location = new Location();
    $location->setID($_GET['id']);

    $query_id = $location->getID();
    $query = $writeDB->prepare("SELECT `id`, `statement` FROM `checklist` WHERE account_id=:id");
    $query->bindParam(":id", $query_id, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(404);
      $response->setSuccess(false);
      $response->addMessage("Error: no checklist items found.");
      $response->send();
      exit();
    }

    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(true);
    $response->setData($query->fetchAll(PDO::FETCH_ASSOC));
    $response->send();
    Config::RegisterAPIAccess($location->getID(), 'checklist');
    exit();
  } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_SERVER['CONTENT_TYPE'] !== 'application/json') {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: content type header not set to JSON.");
      $response->send();
      exit();
    }

    include('./authenticate.php');

    $raw_post_data = file_get_contents('php://input');
    if (!$json_data = json_decode($raw_post_data)) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: request body is not valid JSON.");
      $response->send();
      exit();
    }

    if (!isset($json_data->text) || strlen($json_data->text) === 0) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      (!isset($json_data->text) ? $response->addMessage("Error: request body does not contain a text prompt.") : false);
      $response->send();
      exit();
    }

    $location = new Location();
    $location->setID($_GET['id']);
    $location->checklist()->addStatement($json_data->text);

    $query_id = $location->getID();
    $query_text = $location->checklist()->current();
    $query = $writeDB->prepare("INSERT INTO `checklist` (`account_id`, `statement`) VALUES (:id, :st)");
    $query->bindParam(":id", $query_id, PDO::PARAM_STR);
    $query->bindParam(":st", $query_text, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(409);
      $response->setSuccess(false);
      $response->addMessage("Error: Checklist item not added.");
      $response->send();
      exit();
    }

    $response = new Response();
    $response->setHttpStatusCode(201);
    $response->setSuccess(true);
    $response->setData(["id" => $writeDB->lastInsertId()]);
    $response->addMessage("Checklist item successfully added.");
    $response->send();
    Config::RegisterAPIAccess($query_account_id, "checklist");
    exit();
  } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    include('./authenticate.php');

    $location = new Location();
    $location->setID($_accountID);

    $query_id = $location->getID();
    $query_cid = $_GET['id'];
    $query = $writeDB->prepare("DELETE FROM `checklist` WHERE id=:cid AND account_id=:id");
    $query->bindParam(":cid", $query_cid, PDO::PARAM_STR);
    $query->bindParam(":id", $query_id, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(404);
      $response->setSuccess(false);
      $response->addMessage("Error: account / checklist item pair not found.");
      $response->send();
      exit();
    }

    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(true);
    $response->addMessage("Checklist item successfully erased.");
    $response->send();
    Config::RegisterAPIAccess($location->getID(), 'checklist');
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
  $response->addMessage("Database query failed.");
  $response->send();
  exit();
} catch (APIException $e) {
  $response = new Response();
  $response->setHttpStatusCode(400);
  $response->setSuccess(false);
  $response->addMessage("API Exception: " . $e->getMessage());
  $response->send();
  exit();
} catch (Exception $e) {
  error_log("Exception: " . $e->getMessage());
  $response = new Response();
  $response->setHttpStatusCode(500);
  $response->setSuccess(false);
  $response->addMessage("Unknown error occurred=.");
  $response->send();
  exit();
}
