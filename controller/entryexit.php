<?php

require_once '../model/Config.php';
require_once '../model/DB.php';
require_once '../model/Visitor.php';
require_once '../model/Response.php';

try {
  $writeDB = DB::connectWriteDB();
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

//include('authenticate.php'); Authentication to be included where appropriate

try {

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists('l', $_GET)) { //ENTRY

    if ($_SERVER['CONTENT_TYPE'] !== 'application/json') {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: content type header not set to JSON.");
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
  
    if (!isset($json_data->name, $json_data->phone)) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      (!isset($json_data->name) ? $response->addMessage("Error: request body does not contain a visitor name.") : false);
      (!isset($json_data->phone) ? $response->addMessage("Error: request body does not contain a phone number.") : false);
      $response->send();
      exit();
    }

    $visitor = new Visitor();
    $visitor->setName(trim($json_data->name));
    $visitor->setPhoneNumber(trim($json_data->phone));
    (isset($json_data->arr)) ? $visitor->setArrival($json_data->arr) : $visitor->setArrival(date('Y-m-d H:i:s'));

    $query_name = $visitor->getName();
    $query_phone = $visitor->getPhoneNumber();
    $query_account_id = intval($_GET['l']);
    $query_arr = $visitor->getArrival();
    $query = $writeDB->prepare("INSERT INTO `contacts`(`account_id`,`name`, `phone`, `arr`) VALUES (:a, :n, :p, :arr)");
    $query->bindParam(':a', $query_account_id, PDO::PARAM_STR);
    $query->bindParam(':n', $query_name, PDO::PARAM_STR);
    $query->bindParam(':p', $query_phone, PDO::PARAM_STR);
    $query->bindParam(':arr', $query_arr, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(409);
      $response->setSuccess(false);
      $response->addMessage("Error: New arrival not added.");
      $response->send();
      exit();
    }

    $response = new Response();
    $response->setHttpStatusCode(201);
    $response->setSuccess(true);
    $response->setData(["id" => $writeDB->lastInsertId()]);
    $response->addMessage("Visitor successfully checked in.");
    $response->send();
    Config::RegisterAPIAccess($query_account_id, "entry");
    exit();

  } elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH' && array_key_exists('v', $_GET)) { //EXIT

    $visitor = new Visitor();
    $visitor->setID(intval($_GET['v']));
    $visitor->setDeparture(date('Y-m-d H:i:s'));

    $query_id = $visitor->getID();
    $query_dep = $visitor->getDeparture();
    $query = $writeDB->prepare("SELECT * FROM `contacts` WHERE id=:id");
    $query->bindParam(':id', $query_id, PDO::PARAM_INT);
    $query->execute();
    
    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(409);
      $response->setSuccess(false);
      $response->addMessage("Error: Arrival entry not found.");
      $response->send();
      exit();
    }

    $query_account_id = $query->fetch(PDO::FETCH_ASSOC)['account_id'];
    $query = $writeDB->prepare("UPDATE `contacts` SET `dep`=:dep WHERE id=:id");
    $query->bindParam(':id', $query_id, PDO::PARAM_INT);
    $query->bindParam(':dep', $query_dep, PDO::PARAM_INT);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(409);
      $response->setSuccess(false);
      $response->addMessage("Error: New arrival not added.");
      $response->send();
      exit();
    }

    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(true);
    $response->addMessage("Visitor successfully checked out.");
    $response->send();
    Config::RegisterAPIAccess($query_account_id, "exit");
    exit();

  } else {
    $response = new Response();
    $response->setHttpStatusCode(405);
    $response->setSuccess(false);
    $response->addMessage('Server request method not allowed.');
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