<?php

require_once '../model/Config.php';
require_once '../model/DB.php';
require_once '../model/Location.php';
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

if (!isset($_GET['id'])) {
  $response = new Response();
  $response->setHttpStatusCode(400);
  $response->setSuccess(false);
  $response->addMessage("Error: request did not contain an account id.");
  $response->send();
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $location = new Location();
  $location->setID($_GET['id']);

  $query_id = $location->getID();
  $query = $writeDB->prepare("SELECT * FROM `follow_ons` WHERE account_id=:id ORDER BY id DESC LIMIT 1");
  $query->bindParam(':id', $query_id, PDO::PARAM_STR);
  $query->execute();

  $row_count = $query->rowCount();
  if ($row_count === 0) {
    $response = new Response();
    $response->setHttpStatusCode(404);
    $response->setSuccess(false);
    $response->addMessage("Error: No current follow-thru link found.");
    $response->send();
    exit();
  }

  $row = $query->fetch(PDO::FETCH_ASSOC);
  $location->followOn()->setID($row['id']);
  $location->followOn()->setType($row['type']);
  $location->followOn()->setText($row['text']);
  $location->followOn()->setImg($row['img']);
  $location->followOn()->setURL($row['url']);
  ($row['expiry'] !== null) ? $location->followOn()->setExpiry($row['expiry']) : false;

  $response_data = [
    "text" => $location->followOn()->getText(),
    "img" => $location->followOn()->getImg(),
    "url" => $location->followOn()->getURL(),
    "expiry" => $location->followOn()->getExpiry()
  ];

  $response = new Response();
  $response->setHttpStatusCode(200);
  $response->setSuccess(true);
  $response->setData($response_data);
  $response->send();
  exit();

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (strpos($_SERVER['CONTENT_TYPE'], 'multipart/form-data') === false) {
    $response = new Response();
    $response->setHttpStatusCode(400);
    $response->setSuccess(false);
    $response->addMessage("Error: request body must be multipart/form-data to enable handling of image files.");
    $response->send();
    exit();
  }

  $location = new Location();
  $location->setID($_GET['id']);
  $query_id = $location->getID();

  if (!(array_key_exists('type', $_POST) &&
  array_key_exists('text', $_POST) &&
  array_key_exists('url', $_POST) &&
  array_key_exists('expiry', $_POST))) {
    $response = new Response();
    $response->setHttpStatusCode(400);
    $response->setSuccess(false);
    (!array_key_exists('type', $_POST) ? $response->addMessage("Error: request body does not contain a follow-thru type.") : false);
    (!array_key_exists('text', $_POST) ? $response->addMessage("Error: request body does not contain a text heading.") : false);
    (!array_key_exists('url', $_POST) ? $response->addMessage("Error: request body does not contain a link URL.") : false);
    (!array_key_exists('expiry', $_POST) ? $response->addMessage("Error: request body does not contain an expiry date.") : false);
    $response->send();
    exit();
  }

  if (isset($_FILES["imgFile"])) {

    if ($_FILES["imgFile"]["size"] > 500000) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: Logo image size exceeds 500kB.");
      $response->send();
      exit();
    }

    $target_file = "../../images/followon-" . $location->getID() . "." . strtolower(pathinfo($_FILES["imgFile"]["name"], PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["imgFile"]["tmp_name"]);
    if($check !== false) {
      if (!move_uploaded_file($_FILES["imgFile"]["tmp_name"], $target_file)) {
        $response = new Response();
        $response->setHttpStatusCode(500);
        $response->setSuccess(false);
        $response->addMessage("Error: unknown issue while uploading image file.");
        $response->send();
        exit();
      }
    }
  }

  include('./authenticate.php');

  $query_id = $location->getID();
  $query = $writeDB->prepare("SELECT * FROM follow_ons WHERE account_id=:id ORDER BY id DESC LIMIT 1");
  $query->bindParam(':id', $query_id, PDO::PARAM_STR);
  $query->execute();

  $row_count = $query->rowCount();
  if ($row_count > 0) {
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $location->followOn()->setType($row['type']);
    $location->followOn()->setText($row['text']);
    $location->followOn()->setImg($row['img']);
    $location->followOn()->setURL($row['url']);
    $location->followOn()->setExpiry($row['expiry']);
  }

  $location->followOn()->setType($_POST['type']);
  $location->followOn()->setText($_POST['text']);
  (isset($target_file) ? $location->followOn()->setImg(substr($target_file, 13)) : false);
  $location->followOn()->setURL($_POST['url']);
  $location->followOn()->setExpiry($_POST['expiry']);
  
  $query_type = $location->followOn()->getType();
  $query_text = $location->followOn()->getText();
  $query_img = $location->followOn()->getImg();
  $query_url = $location->followOn()->getURL();
  $query_expiry = (is_null($location->followOn()->getExpiry()) ? null : $location->followOn()->getExpiry() . " 23:59:59");
  $query = $writeDB->prepare("INSERT INTO follow_ons (account_id, `type`, `text`, img, `url`, expiry) VALUES (:id, :ty, :te, :im, :ur, :ex)");
  $query->bindParam(':id', $query_id, PDO::PARAM_STR);
  $query->bindParam(':ty', $query_type, PDO::PARAM_INT);
  $query->bindParam(':te', $query_text, PDO::PARAM_STR);
  $query->bindParam(':im', $query_img, PDO::PARAM_STR);
  $query->bindParam(':ur', $query_url, PDO::PARAM_STR);
  $query->bindParam(':ex', $query_expiry, PDO::PARAM_STR);
  $query->execute();

  $row_count = $query->rowCount();
  if ($row_count === 0) {
    $response = new Response();
    $response->setHttpStatusCode(500);
    $response->setSuccess(false);
    $response->addMessage("Error: database error during follow-thru creation.");
    $response->send();
    exit();
  }

  $response_data = [
    "type" => $query_type,
    "text" => $query_text,
    "img" => $query_img,
    "url" => $query_url,
    "expiry" => $query_expiry
  ];
  $response = new Response();
  $response->setHttpStatusCode(201);
  $response->setSuccess(true);
  $response->addMessage("Follow-thru successfully created.");
  $response->setData($response_data);
  $response->send();
  exit();

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

  $location = new Location();
  $location->setID($_GET['id']);
  $query_id = $location->getID();

  include('./authenticate.php');

  $query = $writeDB->prepare("SELECT COUNT(*) AS cnt FROM follow_ons WHERE account_id=:id");
  $query->bindParam(':id', $query_id, PDO::PARAM_STR);
  $query->execute();

  $row_count = $query->rowCount();
  if ($row_count === 0) {
    $response = new Response();
    $response->setHttpStatusCode(500);
    $response->setSuccess(false);
    $response->addMessage("Error: database error while deleting follow-thru.");
    $response->send();
    exit();
  }

  $row = $query->fetch(PDO::FETCH_ASSOC);
  $row_check = $row['cnt'];

  $query = $writeDB->prepare("DELETE FROM follow_ons WHERE account_id=:id");
  $query->bindParam(':id', $query_id, PDO::PARAM_STR);
  $query->execute();

  $row_count = $query->rowCount();
  if ($row_count === $row_check) {
    $response = new Response();
    $response->setHttpStatusCode(500);
    $response->setSuccess(false);
    $response->addMessage("Error: database error while deleting follow-thru.");
    $response->send();
    exit();
  }

  $response = new Response();
  $response->setHttpStatusCode(200);
  $response->setSuccess(true);
  $response->addMessage("Follow-thru successfully erased.");
  $response->send();
  exit();
  
} else {
  $response = new Response();
  $response->setHttpStatusCode(405);
  $response->setSuccess(false);
  $response->addMessage("Error: request method not permitted on the user endpoint.");
  $response->send();
  exit();
}