<?php

require_once './model/DB.php';

try {
  $writeDB = DB::connectWriteDB();
} catch (PDOException $e) {
  error_log("Exception: " . $e->getMessage(), 0);
}

$query = $writeDB->prepare("DELETE FROM `contacts` WHERE arr < DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 28 DAY)");
$query->execute();

$query = $writeDB->prepare("DELETE FROM `sessions` WHERE refresh_token_expiry < CURRENT_TIMESTAMP()");
$query->execute();
