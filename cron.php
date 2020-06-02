<?php

require_once './model/DB.php';

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

$query = $writeDB->prepare("DELETE FROM `contacts` WHERE arr < DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 2 MONTH)");
$query->execute();

$query = $writeDB->prepare("DELETE FROM `sessions` WHERE refresh_token_expiry < CURRENT_TIMESTAMP()");
$query->execute();
