<?php

require_once '../model/Config.php';
require_once '../model/DB.php';
require_once '../model/Response.php';

try {
  $writeDB = DB::connectWriteDB();
}
catch (PDOException $e) {
  error_log("Exception: " . $e->getMessage(), 0);
  $response = new Response();
  $response->setHttpStatusCode(500);
  $response->setSuccess(false);
  $response->addMessage("Error: connection to database could not be established.");
  $response->send();
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  try {
  
    $raw_post_data = file_get_contents('php://input');

    if (!$json_data = json_decode($raw_post_data)) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: request body is not valid JSON.");
      $response->send();
      exit();
    }

    if (!property_exists($_GET, 'id') || !isset($json_data->startDate, $json_data->endDate)) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      (!property_exists($_GET, 'id')) ? $response->addMessage("Error: account ID not supplied.") : false;
      (!isset($json_data->startDate)) ? $response->addMessage("Error: start date not supplied.") : false;
      (!isset($json_data->endDate)) ? $response->addMessage("Error: end date not supplied.") : false;
      $response->send();
      exit();
    }

    sleep(5);

    $start_date = new DateTime($json_data->startDate);
    $end_date = new DateTime($json_data->endDate);
    
    $query_id = $_GET['id'];
    $query_start_date = $start_date->format("Y-m-d");
    $query_end_date = $end_date->format("Y-m-d");
    $query = $writeDB->prepare("SELECT `name`, `phone`, `arr` AS arrival, `dep` AS departure FROM `contacts` WHERE `account_id`=:id AND `arr` BETWEEN :s AND :e LIMIT 500");
    $query->bindParam(':id', $query_id, PDO::PARAM_STR);
    $query->bindParam(':s', $query_start_date, PDO::PARAM_STR);
    $query->bindParam(':e', $query_end_date, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
        $response = new Response();
        $response->setHttpStatusCode(404);
        $response->setSuccess(false);
        $response->addMessage("Error: No results found for the given period.");
        $response->send();
        exit();
    }

    $query = $writeDB->prepare("INSERT INTO `data_exports` (`account_id`, `rows_exported`) VALUES (:id, :r)");
    $query->bindParam(':id', $query_id, PDO::PARAM_STR);
    $query->bindParam(':r', $row_count, PDO::PARAM_INT);
    $query->execute();

    $row_count_b = $query->rowCount();
    if ($row_count_b === 0) {
        $response = new Response();
        $response->setHttpStatusCode(500);
        $response->setSuccess(false);
        $response->addMessage("Error: could not store data request. Contact database administrator.");
        $response->send();
        exit();
    }

    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(true);
    ($row_count === 500) ? $response->addMessage("Number of rows may exceed limit. Try reducing the search period.") : false;
    $response->addMessage("Data export query successful.");
    $response->setData($query->fetchAll());
    $response->send();
    Config::RegisterAPIAccess($query_id, "export");
    exit();

  }catch (PDOException $e) {
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
} else {
  $response = new Response();
  $response->setHttpStatusCode(405);
  $response->setSuccess(false);
  $response->addMessage("Error: request method not permitted on the user endpoint.");
  $response->send();
  exit();
}