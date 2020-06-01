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

include('authenticate.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $response = new Response();
  $response->setHttpStatusCode(405);
  $response->setSuccess(false);
  $response->addMessage('Server request method not allowed.');
  $response->send();
  exit();
}

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

if (!isset($jsonData->name, $jsonData->phone)) {
  $response = new Response();
  $response->setHttpStatusCode(400);
  $response->setSuccess(false);
  (!isset($jsonData->name) ? $response->addMessage("Error: request body does not contain a visitor name.") : false);
  (!isset($jsonData->phone) ? $response->addMessage("Error: request body does not contain a phone number.") : false);
  $response->send();
  exit();
}

try {

  $visitor = new Visitor();
  $visitor->setName(trim($json_data->name));
  $visitor->setPhoneNumber(trim($json_data->phone));

  $query_name = $visitor->getName();
  $query_phone = $visitor->getPhoneNumber();
  $query_arr = new DateTime();
  $query = $writeDB->prepare("INSERT INTO `contacts`(`name`, `phone`) VALUES (:n, :p)");
  $query->bindParam(':n', $query_name, PDO::PARAM_STR);
  $query->bindParam(':p', $query_phone, PDO::PARAM_STR);
  $query->execute();

  $row_count = $query->rowCount();
  if ($rowCount === 0) {
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
  $response->addMessage("Visitor successfully checked in.");
  $response->send();
  exit();

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
  $response->setHttpStatusCode(200);
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