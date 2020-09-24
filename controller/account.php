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

    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {

      include('authenticate.php');

      $location = new Location();
      $location->setID(intval($_GET['id']));

      $query_id = $location->getID();
      $query = $writeDB->prepare("SELECT `business_name`, `auth_contact`, `avatar`, `phone`, `street_address`, `suburb`, `state`, `postcode`, `email`, `checklist_select_all` FROM `accounts` WHERE id=:id");
      $query->bindParam(':id', $query_id, PDO::PARAM_STR);
      $query->execute();

      $row_count = $query->rowCount();
      if ($row_count === 0) {
        $response = new Response();
        $response->setHttpStatusCode(409);
        $response->setSuccess(false);
        $response->addMessage("Error: venue account not found.");
        $response->send();
        exit();
      }

      $row = $query->fetch(PDO::FETCH_ASSOC);
      $location->setName($row['business_name']);
      $location->setAuthContact($row['auth_contact']);
      $location->setAvatar($row['avatar']);
      $location->setPhoneNumber($row['phone']);
      $location->address()->setStreetAddress($row['street_address']);
      $location->address()->setSuburb($row['suburb']);
      $location->address()->setState($row['state']);
      $location->address()->setPostCode($row['postcode']);
      $location->setEmailAddress($row['email']);
      $location->checklist()->selectAll($row['checklist_select_all']);

      $query = $writeDB->prepare("SELECT `statement` FROM `checklist` WHERE account_id=:id");
      $query->bindParam(':id', $query_id, PDO::PARAM_STR);
      $query->execute();

      $row_count = $query->rowCount();
      if ($row_count > 0)
        while ($row = $query->fetch(PDO::FETCH_ASSOC))
          $location->checklist()->addStatement($row['statement']);

      $response_data = [
        'name' => $location->getName(),
        'authContact' => $location->getAuthorisedContact(),
        'logo' => $location->getAvatar(),
        'phone' => $location->getPhoneNumber(),
        'streetAddress' => $location->address()->getStreetAddress(),
        'suburb' => $location->address()->getSuburb(),
        'state' => $location->address()->getState(),
        'postcode' => $location->address()->getPostcode(),
        'email' => $location->getEmailAddress(),
        'selectAll' => $location->checklist()->canSelectAll(),
        'statements' => $location->checklist()->toArray()
      ];

      $response = new Response();
      $response->setHttpStatusCode(200);
      $response->setSuccess(true);
      $response->setData($response_data);
      $response->send();
      Config::RegisterAPIAccess($query_id, "account");
      exit();
    } else {

      $location = new Location();
      $location->setID(intval($_GET['id']));

      $query_id = $location->getID();
      $query = $writeDB->prepare("SELECT `business_name`, `avatar`, `checklist_select_all` FROM `accounts` WHERE id=:id");
      $query->bindParam(':id', $query_id, PDO::PARAM_STR);
      $query->execute();

      $row_count = $query->rowCount();
      if ($row_count === 0) {
        $response = new Response();
        $response->setHttpStatusCode(409);
        $response->setSuccess(false);
        $response->addMessage("Error: venue account not found.");
        $response->send();
        Config::RegisterAPIAccess($query_id, "account");

        exit();
      }

      $row = $query->fetch(PDO::FETCH_ASSOC);
      $location->setName($row['business_name']);
      $location->setAvatar($row['avatar']);
      $location->checklist()->selectAll($row['checklist_select_all']);

      $query = $writeDB->prepare("SELECT `statement` FROM `checklist` WHERE account_id=:id");
      $query->bindParam(':id', $query_id, PDO::PARAM_STR);
      $query->execute();

      $row_count = $query->rowCount();
      if ($row_count > 0)
        while ($row = $query->fetch(PDO::FETCH_ASSOC))
          $location->checklist()->addStatement($row['statement']);

      $response_data = [
        'name' => $location->getName(),
        'logo' => $location->getAvatar(),
        'checklist' => $location->checklist()->count(),
        'selectAll' => $location->checklist()->canSelectAll(),
        'statements' => $location->checklist()->toArray()
      ];

      $response = new Response();
      $response->setHttpStatusCode(200);
      $response->setSuccess(true);
      $response->setData($response_data);
      $response->send();
      Config::RegisterAPIAccess($query_id, "account");
      exit();
    }
  } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['CONTENT_TYPE'] === 'application/json') {

    $raw_post_data = file_get_contents('php://input');

    if (!$json_data = json_decode($raw_post_data)) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: request body is not valid JSON.");
      $response->send();
      exit();
    }

    if (!isset($json_data->businessName, $json_data->authContact, $json_data->email, $json_data->phone, $json_data->streetAddress, $json_data->suburb, $json_data->state, $json_data->postcode, $json_data->password)) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      (!isset($json_data->businessName) ? $response->addMessage("Error: request body does not contain a business name.") : false);
      (!isset($json_data->authContact) ? $response->addMessage("Error: request body does not contain an authorised contact.") : false);
      (!isset($json_data->email) ? $response->addMessage("Error: request body does not contain an email address.") : false);
      (!isset($json_data->phone) ? $response->addMessage("Error: request body does not contain a contact phone number.") : false);
      (!isset($json_data->streetAddress) ? $response->addMessage("Error: request body does not contain a street address.") : false);
      (!isset($json_data->suburb) ? $response->addMessage("Error: request body does not contain a suburb name.") : false);
      (!isset($json_data->state) ? $response->addMessage("Error: request body does not contain a state name.") : false);
      (!isset($json_data->postcode) ? $response->addMessage("Error: request body does not contain a postcode.") : false);
      (!isset($json_data->password) ? $response->addMessage("Error: request body does not contain a password.") : false);
      $response->send();
      exit();
    }

    $location = new Location();
    $location->setID();
    $location->setName(trim($json_data->businessName));
    $location->setAuthContact(trim($json_data->authContact));
    if (isset($json_data->avatar)) $location->setAvatar(trim($json_data->avatar));
    $location->setPhoneNumber(trim($json_data->phone));
    $location->address()->setStreetAddress(trim($json_data->streetAddress));
    $location->address()->setSuburb(trim($json_data->suburb));
    $location->address()->setState(trim($json_data->state));
    $location->address()->setPostCode(trim($json_data->postcode));
    $location->setEmailAddress(trim($json_data->email));
    if (isset($json_data->abn)) $location->setABN(trim($json_data->abn));

    $query_email = $location->getEmailAddress();
    $query = $writeDB->prepare("SELECT `id` FROM `accounts` WHERE `email` = :email");
    $query->bindParam(':email', $query_email, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count > 0) {
      $response = new Response();
      $response->setHttpStatusCode(409);
      $response->setSuccess(false);
      $response->addMessage("Error: email address already listed within the database.");
      $response->send();
      exit();
    }

    $passwordHash = password_hash($json_data->password, PASSWORD_DEFAULT);

    $query_id = $location->getID();
    $query_abn = $location->getABN();
    $query_contact = $location->getAuthorisedContact();
    $query_avatar = $location->getAvatar();
    $query_name = $location->getName();
    $query_email = $location->getEmailAddress();
    $query_phone = $location->getPhoneNumber();
    $query_postcode = $location->address()->getPostcode();
    $query_state = $location->address()->getState();
    $query_address = $location->address()->getStreetAddress();
    $query_suburb = $location->address()->getSuburb();
    $query = $writeDB->prepare("INSERT INTO `accounts`
      (id, ABN, auth, auth_contact, avatar, business_name, email, phone, postcode, `state`, street_address, suburb) VALUES
      (:id, :abn, :auth, :authContact, :avatar, :business, :email, :phone, :postcode, :state, :address, :suburb)");
    $query->bindParam(':id', $query_id, PDO::PARAM_STR);
    $query->bindParam(':abn', $query_abn, PDO::PARAM_STR);
    $query->bindParam(':auth', $passwordHash, PDO::PARAM_STR);
    $query->bindParam(':authContact', $query_contact, PDO::PARAM_STR);
    $query->bindParam(':avatar', $query_avatar, PDO::PARAM_STR);
    $query->bindParam(':business', $query_name, PDO::PARAM_STR);
    $query->bindParam(':email', $query_email, PDO::PARAM_STR);
    $query->bindParam(':phone', $query_phone, PDO::PARAM_STR);
    $query->bindParam(':postcode', $query_postcode, PDO::PARAM_STR);
    $query->bindParam(':state', $query_state, PDO::PARAM_STR);
    $query->bindParam(':address', $query_address, PDO::PARAM_STR);
    $query->bindParam(':suburb', $query_suburb, PDO::PARAM_STR);
    $query->execute();

    $row_count = $query->rowCount();
    if ($row_count === 0) {
      $response = new Response();
      $response->setHttpStatusCode(500);
      $response->setSuccess(false);
      $response->addMessage("Error: database error during user creation.");
      $response->send();
      exit();
    }

    $response_data = [];
    $response_data['id'] = $query_id;
    $response_data['name'] = $query_name;
    $response_data['authorisedContact'] = $query_contact;
    $response_data['contactPhone'] = $query_phone;
    $response_data['contactEmail'] = $query_email;

    include('register_mail.php');

    $response = new Response();
    $response->setHttpStatusCode(201);
    $response->setSuccess(true);
    $response->addMessage("Account successfully created.");
    $response->setData($response_data);
    $response->send();
    exit();
  } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'], 'multipart/form-data') !== false) {

    include('authenticate.php');

    $location = new Location();
    $location->setID(intval($_GET['id']));

    if ($_FILES["logo"]["size"] > 500000) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: Logo image size exceeds 500kB.");
      $response->send();
      exit();
    }

    $target_file = "../../images/logo-" . $location->getID() . "." . strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
    if ($check !== false) {

      if (!move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
        $response = new Response();
        $response->setHttpStatusCode(500);
        $response->setSuccess(false);
        $response->addMessage("Error: unknown issue while uploading logo.");
        $response->send();
        exit();
      }

      $query_logo = substr($target_file, 13);
      $query_id = $location->getID();
      $query = $writeDB->prepare("UPDATE `accounts` SET `avatar` = :logo WHERE id=:id");
      $query->bindParam(':logo', $query_logo, PDO::PARAM_STR);
      $query->bindParam(':id', $query_id, PDO::PARAM_STR);
      $query->execute();

      $row_count = $query->rowCount();
      if ($row_count === 0) {
        $response = new Response();
        $response->setHttpStatusCode(404);
        $response->setSuccess(false);
        $response->addMessage("Error: venue account not found.");
        $response->send();
        Config::RegisterAPIAccess($query_id, "account");
        exit();
      }

      $response = new Response();
      $response->setHttpStatusCode(200);
      $response->setSuccess(true);
      $response->addMessage("Logo successfully updated.");
      $response->send();
      Config::RegisterAPIAccess($query_id, "account");
      exit();
    } else {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: Logo image data in unexpected format.");
      $response->addMessage("Filetype: " . $_FILES["logo"]["tmp_name"]);
      $response->setData(json_encode(["data" => $raw_post_data]));
      $response->send();
      Config::RegisterAPIAccess($query_id, "account");
      exit();
    }
  } elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH') {

    if (!isset($_GET['id'])) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: request did not contain an account id.");
      $response->send();
      exit();
    }

    include('authenticate.php');

    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {

      $raw_post_data = file_get_contents('php://input');

      if (!$json_data = json_decode($raw_post_data)) {
        $response = new Response();
        $response->setHttpStatusCode(400);
        $response->setSuccess(false);
        $response->addMessage("Error: request body is not valid JSON.");
        $response->send();
        exit();
      }

      if (isset($json_data->password)) {

        if (!isset($json_data->password, $json_data->newPassword)) {
          $response = new Response();
          $response->setHttpStatusCode(400);
          $response->setSuccess(false);
          (!isset($json_data->password) ? $response->addMessage("Error: request body does not contain an original password.") : false);
          (!isset($json_data->newPassword) ? $response->addMessage("Error: request body does not contain a new password.") : false);
          $response->send();
          exit();
        }

        $query_id = $_GET['id'];
        $password = $json_data->password;
        $query_auth = password_hash($json_data->newPassword, PASSWORD_DEFAULT);
        $query = $writeDB->prepare("SELECT auth FROM accounts WHERE id = :id");
        $query->bindParam(':id', $query_id, PDO::PARAM_STR);
        $query->execute();

        $row_count = $query->rowCount();
        if ($row_count === 0) {
          $response = new Response();
          $response->setHttpStatusCode(404);
          $response->setSuccess(false);
          $response->addMessage("Error: account not found.");
          $response->send();
          exit();
        }

        $row = $query->fetch(PDO::FETCH_ASSOC);
        if (!password_verify($password, $row['auth'])) {
          $response = new Response();
          $response->setHttpStatusCode(401);
          $response->setSuccess(false);
          $response->addMessage("Error: original password is incorrect.");
          $response->send();
          Config::RegisterAPIAccess($query_id, "account");
          exit();
        }

        $query = $writeDB->prepare("UPDATE accounts SET `auth`=:auth WHERE id=:id");
        $query->bindParam(":id", $query_id, PDO::PARAM_STR);
        $query->bindParam(":auth", $query_auth, PDO::PARAM_STR);
        $query->execute();

        $row_count = $query->rowCount();
        if ($row_count === 0) {
          $response = new Response();
          $response->setHttpStatusCode(500);
          $response->setSuccess(false);
          $response->addMessage("Error: Password not updated.");
          $response->send();
          exit();
        }
      } else {

        if (!isset($json_data->businessName, $json_data->authContact, $json_data->email, $json_data->phone, $json_data->streetAddress, $json_data->suburb, $json_data->state, $json_data->postcode)) {
          $response = new Response();
          $response->setHttpStatusCode(400);
          $response->setSuccess(false);
          (!isset($json_data->businessName) ? $response->addMessage("Error: request body does not contain a business name.") : false);
          (!isset($json_data->authContact) ? $response->addMessage("Error: request body does not contain an authorised contact.") : false);
          (!isset($json_data->email) ? $response->addMessage("Error: request body does not contain an email address.") : false);
          (!isset($json_data->phone) ? $response->addMessage("Error: request body does not contain a contact phone number.") : false);
          (!isset($json_data->streetAddress) ? $response->addMessage("Error: request body does not contain a street address.") : false);
          (!isset($json_data->suburb) ? $response->addMessage("Error: request body does not contain a suburb name.") : false);
          (!isset($json_data->state) ? $response->addMessage("Error: request body does not contain a state name.") : false);
          (!isset($json_data->postcode) ? $response->addMessage("Error: request body does not contain a postcode.") : false);
          $response->send();
          exit();
        }

        $location = new Location();
        $location->setID($_GET['id']);
        $location->setName(trim($json_data->businessName));
        $location->setAuthContact(trim($json_data->authContact));
        $location->setPhoneNumber(trim($json_data->phone));
        $location->address()->setStreetAddress(trim($json_data->streetAddress));
        $location->address()->setSuburb(trim($json_data->suburb));
        $location->address()->setState(trim($json_data->state));
        $location->address()->setPostCode(trim($json_data->postcode));
        $location->setEmailAddress(trim($json_data->email));
        if (isset($json_data->abn)) $location->setABN(trim($json_data->abn));

        $query_id = $location->getID();
        $query_abn = $location->getABN();
        $query_contact = $location->getAuthorisedContact();
        $query_name = $location->getName();
        $query_email = $location->getEmailAddress();
        $query_phone = $location->getPhoneNumber();
        $query_postcode = $location->address()->getPostcode();
        $query_state = $location->address()->getState();
        $query_address = $location->address()->getStreetAddress();
        $query_suburb = $location->address()->getSuburb();
        $query = $writeDB->prepare("UPDATE `accounts` SET ABN=:abn, auth_contact=:authContact, business_name=:business, email=:email,
        phone=:phone, postcode=:postcode, `state`=:state, street_address=:address, suburb=:suburb WHERE id=:id");
        $query->bindParam(':id', $query_id, PDO::PARAM_STR);
        $query->bindParam(':abn', $query_abn, PDO::PARAM_STR);
        $query->bindParam(':authContact', $query_contact, PDO::PARAM_STR);
        $query->bindParam(':business', $query_name, PDO::PARAM_STR);
        $query->bindParam(':email', $query_email, PDO::PARAM_STR);
        $query->bindParam(':phone', $query_phone, PDO::PARAM_STR);
        $query->bindParam(':postcode', $query_postcode, PDO::PARAM_STR);
        $query->bindParam(':state', $query_state, PDO::PARAM_STR);
        $query->bindParam(':address', $query_address, PDO::PARAM_STR);
        $query->bindParam(':suburb', $query_suburb, PDO::PARAM_STR);
        $query->execute();

        $row_count = $query->rowCount();
        if ($row_count === 0) {
          $response = new Response();
          $response->setHttpStatusCode(404);
          $response->setSuccess(false);
          $response->addMessage("Error: account not found.");
          $response->send();
          exit();
        }

        $response_data = [];
        $response_data['id'] = $query_id;
        $response_data['name'] = $query_name;
        $response_data['authorisedContact'] = $query_contact;
        $response_data['contactPhone'] = $query_phone;
        $response_data['contactEmail'] = $query_email;
      }

      $response = new Response();
      $response->setHttpStatusCode(200);
      $response->setSuccess(true);
      $response->addMessage("Account successfully updated.");
      $response->setData($response_data);
      $response->send();
      Config::RegisterAPIAccess($query_id, "account");
      exit();
    } else {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: Invalid content type header sent.");
      $response->send();
      exit();
    }

  } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    
    if (!isset($_GET['id'])) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Error: request did not contain an account id.");
      $response->send();
      exit();
    }

    include('authenticate.php');

    $location = new Location();
    $location->setID($_GET['id']);
    $query_id = $location->getID();
    $query = $writeDB->prepare("DELETE FROM `accounts` WHERE id=:id");
    $query->bindParam(':id', $query_id, PDO::PARAM_STR);
    $query->execute();

    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(true);
    $response->addMessage("Account successfully deleted.");
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
