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
  $response->addMessage("Error: request did not contain an account id.");
  $response->send();
  exit();
}

try {
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $location = new Location();
    $location->setID($_GET['id']);

    $query_id = $location->getID();
    $query = $writeDB->prepare("SELECT * FROM `follow_ons` WHERE account_id=:id ORDER BY id DESC");
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

    $response_data = [];

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $location->followOn()->setID($row['id']);
      $location->followOn()->setType($row['type']);
      $location->followOn()->setText($row['text']);
      $location->followOn()->setURL($row['url']);
      $location->followOn()->setStart($row['start']);
      $location->followOn()->setExpiry($row['expiry']);

      $response_data[] = [
        "id" => $location->followOn()->getID(),
        "type" => $location->followOn()->getType(),
        "text" => $location->followOn()->getText(),
        "url" => $location->followOn()->getURL(),
        "start" => $location->followOn()->getStart(),
        "expiry" => $location->followOn()->getExpiry()
      ];
    }

    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(true);
    $response->setData($response_data);
    $response->send();
    Config::RegisterAPIAccess($location->getID(), 'followon');
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

    if (!(array_key_exists('text', $_POST) &&
      array_key_exists('url', $_POST))) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      (!array_key_exists('text', $_POST) ? $response->addMessage("Error: request body does not contain a text heading.") : false);
      (!array_key_exists('url', $_POST) ? $response->addMessage("Error: request body does not contain a link URL.") : false);
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

      $check = getimagesize($_FILES["imgFile"]["tmp_name"]);
      if (!$check) {
        $response = new Response();
        $response->setHttpStatusCode(400);
        $response->setSuccess(false);
        $response->addMessage("Error: invalid or corrupt image file received.");
        $response->send();
        exit();
      }

      $image = $_FILES['imgFile']['tmp_name'];
      $img_stream = fopen($image, 'rb');
      $img_mime = mime_content_type($image);
    }

    include('./authenticate.php');

    $query_id = $location->getID();

    (isset($_POST['type']) ? $location->followOn()->setType($_POST['type']) : false);
    $location->followOn()->setText($_POST['text']);
    $location->followOn()->setURL($_POST['url']);
    (isset($_POST['start']) ? $location->followOn()->setStart($_POST['start']) : false);
    (isset($_POST['expiry']) ? $location->followOn()->setExpiry($_POST['expiry']) : false);

    $query_type = $location->followOn()->getType();
    $query_text = $location->followOn()->getText();
    $query_img = (isset($img_stream) ? $img_stream : null);
    $query_mime = (isset($img_mime) ? $img_mime : "");
    $query_url = $location->followOn()->getURL();
    $query_start = $location->followOn()->getStart() . " 00:00:00";
    $query_expiry = $location->followOn()->getExpiry() . " 23:59:59";
    $query = $writeDB->prepare("INSERT INTO follow_ons (account_id, `type`, `text`, img, `url`, `start`, `expiry`) VALUES (:id, :ty, :te, :im, :ur, :st, :ex)");
    $query->bindParam(':id', $query_id, PDO::PARAM_STR);
    $query->bindParam(':ty', $query_type, PDO::PARAM_INT);
    $query->bindParam(':te', $query_text, PDO::PARAM_STR);
    $query->bindParam(':im', $query_img, PDO::PARAM_LOB);
    $query->bindParam(':ur', $query_url, PDO::PARAM_STR);
    $query->bindParam(':st', $query_start, PDO::PARAM_STR);
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

    $id = $writeDB->lastInsertId();

    $response_data = [
      "id" => $id,
      "type" => $query_type,
      "text" => $query_text,
      "url" => $query_url,
      "start" => $query_start,
      "expiry" => $query_expiry
    ];
    $response = new Response();
    $response->setHttpStatusCode(201);
    $response->setSuccess(true);
    $response->addMessage("Follow-thru successfully created.");
    $response->setData($response_data);
    $response->send();
    Config::RegisterAPIAccess($location->getID(), 'followon');
    exit();
  } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    include('./authenticate.php');

    $location = new Location();
    $location->setID($_accountID);
    $location->followOn()->setID($_GET['id']);
    $query_id = $location->getID();
    $query_fid = $location->followOn()->getID();

    $query = $writeDB->prepare("DELETE FROM follow_ons WHERE id=:fid AND account_id=:aid");
    $query->bindParam(':fid', $query_fid, PDO::PARAM_STR);
    $query->bindParam(':aid', $query_id, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(404);
      $response->setSuccess(false);
      $response->addMessage("Error: account / follow thru pair not found.");
      $response->send();
      exit();
    }

    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(true);
    $response->addMessage("Follow-thru successfully erased.");
    $response->send();
    Config::RegisterAPIAccess($location->getID(), 'followon');
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
