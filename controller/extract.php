<?php

require_once '../model/Config.php';
require_once '../model/DB.php';
require_once '../model/Extract.php';
require_once '../model/Response.php';
require_once '../model/Visitor.php';

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
  $response->addMessage("Error: Account id not sent.");
  $response->send();
  exit();
}

if (!isset($_GET['data'])) {
  $response = new Response();
  $response->setHttpStatusCode(400);
  $response->setSuccess(false);
  $response->addMessage("Error: Account id not sent.");
  $response->send();
  exit();
}
$data = str_replace(" ", "+", $_GET['data']);

if ($_SERVER['CONTENT_TYPE'] !== 'application/json') {
  $response = new Response();
  $response->setHttpStatusCode(400);
  $response->setSuccess(false);
  $response->addMessage("Error: content type header not set to JSON.");
  $response->send();
  exit();
}

include('./authenticate.php');

try {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $raw_post_data = file_get_contents('php://input');
    if (!$json_data = json_decode($raw_post_data)) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: request body is not valid JSON.");
      $response->send();
      exit();
    }

    if (!isset($json_data->authName, $json_data->password) || strlen($json_data->authName) === 0  || strlen($json_data->password) === 0) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      (!isset($json_data->authName) || strlen($json_data->authName) === 0 ? $response->addMessage("Error: request body does not contain a valid authorised contact name.") : false);
      (!isset($json_data->password) || strlen($json_data->password) === 0 ? $response->addMessage("Error: request body does not contain a valid password.") : false);
      $response->send();
      exit();
    }

    $extract = new Extract();
    $extract->location->setID(intval($_GET['id']));
    $extract->location->setAuthContact($json_data->authName);
    if (!$extract->detectMode($data)) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Could not detect data extract request type.");
      $response->send();
      exit();
    }

    $query_id = $extract->location->getID();
    $query_auth_name = $extract->location->getAuthorisedContact();
    $query = $writeDB->prepare("SELECT `auth`, `email` FROM `accounts` WHERE `id`=:id AND `auth_contact`=:a");
    $query->bindParam(":id", $query_id, PDO::PARAM_STR);
    $query->bindParam(":a", $query_auth_name, PDO::PARAM_STR);
    $query->execute();

    $rowCount = $query->rowCount();
    if ($rowCount === 0) {
        $response = new Response();
        $response->setHttpStatusCode(401);
        $response->setSuccess(false);
        $response->addMessage("Error: authorised contact name entered not found.");
        $response->send();
        exit();
    }

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $extract->location->setEmailAddress($row['email']);
    if (!password_verify($json_data->password, $row['auth'])) {
      $response = new Response();
      $response->setHttpStatusCode(401);
      $response->setSuccess(false);
      $response->addMessage("Error: password verification failed.");
      $response->send();
      exit();
    }

    if ($extract->getMode() === Extract::MODE_PHONE) {
      $visitor = new Visitor();
      $visitor->setPhoneNumber($data);

      $query_phone = $visitor->getPhoneNumber();
      $query = $writeDB->prepare("SELECT a.id as id, a.business_name as `location`, COUNT(c.phone) as `count` FROM accounts a, contacts c WHERE c.phone = :ph AND a.id = c.account_id GROUP BY `location`");
      $query->bindParam(":ph", $query_phone, PDO::PARAM_STR);
      $query->execute();

      $row_count = $query->rowCount();
      if ($row_count === 0) {
        $response = new Response();
        $response->setHttpStatusCode(200);
        $response->setSuccess(true);
        $response->addMessage("Visitor has no records in previous 28 day period.");
        $response->send();
        exit();
      } else {
        $vistor_at_location = false;
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          if (intval($row['id']) === $extract->location->getID()) $vistor_at_location = true;
        }
        $response = new Response();
        $response->setHttpStatusCode(200);
        $response->setSuccess(true);
        $response->setData([
          "atLocation" => $vistor_at_location,
          "atOtherLocation" => ($vistor_at_location && $row_count > 1 || !$vistor_at_location && $row_count > 0)
        ]);
        $response->send();
        exit();
      }
    } elseif ($extract->getMode() === Extract::MODE_DATE) {
      $query_date = $extract->getDate();
      $query = $writeDB->prepare("SELECT `name`, `phone`, `arr`, `dep` FROM contacts WHERE account_id =:id AND DATE(arr)=DATE(:d)");
      $query->bindParam(":id", $query_id, PDO::PARAM_STR);
      $query->bindParam(":d", $query_date, PDO::PARAM_STR);
      $query->execute();

      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $extract->addRow($row['name'], $row['phone'], $row['arr'], strval($row['dep']));
      }

      if (!Config::Mailer([
        "type" => "extract",
        "email" => $extract->location->getEmailAddress(),
        "contact_name" => $extract->location->getAuthorisedContact(),
        "csv_data" => $extract->export()
      ])) {
        $response = new Response();
        $response->setHttpStatusCode(500);
        $response->setSuccess(false);
        $response->addMessage("Email could not be prepared for sending.");
        $response->send();
        exit();
      }

      $response = new Response();
      $response->setHttpStatusCode(200);
      $response->setSuccess(true);
      $response->addMessage("Request received successfully.");
      $response->addMessage("Data: {$data}");
      $response->send();
      exit();
    } else {
      $response = new Response();
      $response->setHttpStatusCode(401);
      $response->setSuccess(false);
      $response->addMessage("Error: extraction request type not identified.");
      $response->send();
      exit();
    }
  } else {
    $response = new Response();
    $response->setHttpStatusCode(405);
    $response->setSuccess(false);
    $response->addMessage("Error: request method not permitted on the extract endpoint.");
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
  $response->addMessage("Data: {$data} - length: " . strlen($data));
  $response->addMessage("Mode: " . $extract->getMode());
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
