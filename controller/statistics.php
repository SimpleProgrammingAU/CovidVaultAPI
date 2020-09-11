<?php

require_once '../model/Config.php';
require_once '../model/DB.php';
require_once '../model/Statistics.php';
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
      $response->addMessage("Error: request did not contain an account id.");
      $response->send();
      exit();
    }

    include('authenticate.php');

    $statistics = new Statistics();
    $statistics->location()->setID(intval($_GET['id']));

    $query_id = $statistics->location()->getID();
    $query = $writeDB->prepare("SELECT weekday(arr) as `id`, COUNT(DISTINCT DATE(`arr`)) as F, COUNT(*) as `N` FROM `contacts` WHERE account_id = :id GROUP BY weekday(arr)");
    $query->bindParam(':id', $query_id, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count > 0) {
      $statistics->importDay($query->fetchAll(PDO::FETCH_ASSOC));
    }

    $query = $writeDB->prepare("SELECT HOUR(arr) as `id`, COUNT(*) AS `N` FROM `contacts` WHERE account_id = :id GROUP BY hour(arr)");
    $query->bindParam(':id', $query_id, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count > 0) {
      $statistics->importHour($query->fetchAll(PDO::FETCH_ASSOC));
    }

    $query = $writeDB->prepare("SELECT (SUM( CASE WHEN n > 1 THEN n ELSE 0 END) / SUM(n)) AS `p` FROM (SELECT `phone`, COUNT(`phone`) AS `n` FROM `contacts` WHERE `account_id` = :id GROUP BY `phone`) AS temp");
    $query->bindParam(':id', $query_id, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count > 0) {
      $statistics->setReturn($query->fetch(PDO::FETCH_ASSOC)['p']);
    }

    $query = $writeDB->prepare("SELECT COUNT(*) AS `n` FROM `contacts` WHERE `account_id` = :id AND DATE(`arr`) = DATE(NOW())");
    $query->bindParam(':id', $query_id, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count > 0) {
      $statistics->setToday($query->fetch(PDO::FETCH_ASSOC)['n']);
    }

    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(true);
    $response->setData([
      "byDay" => $statistics->getTimeStats(Statistics::DAY),
      "byHour" => $statistics->getTimeStats(Statistics::HOUR),
      "return" => $statistics->getReturnStats(),
      "today" => $statistics->getTodayCount()
    ]);
    $response->send();
    exit();

  } else {
    $response = new Response();
    $response->setHttpStatusCode(405);
    $response->setSuccess(false);
    $response->addMessage("Error: request method not permitted on the statistics endpoint.");
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
