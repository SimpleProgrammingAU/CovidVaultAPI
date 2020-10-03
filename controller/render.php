<?php

require_once '../model/DB.php';

try {
  $readDB = DB::connectReadDB();
} catch (PDOException $e) {
  error_log("Exception: " . $e->getMessage(), 0);
  exit();
}

if (!isset($_GET['id'])) {
  exit();
}

if (!isset($_GET['type'])) {
  exit();
}

if ($_GET['type'] === 'account') {
  $query = $readDB->prepare("SELECT `avatar`, `avatar_mime` FROM accounts WHERE id = :id");
  $query_id = $_GET['id'];
  $query->bindParam(':id', $query_id, PDO::PARAM_STR);
  $query->execute();
  if ($query->rowCount() === 0) exit();
  $row = $query->fetch(PDO::FETCH_ASSOC);
  $image = $row['avatar'];
  $mime = $row['avatar_mime'];
} else {
  $query = $readDB->prepare("SELECT img, img_mime FROM follow_ons WHERE id = :id");
  $query_id = $_GET['id'];
  $query->bindParam(':id', $query_id, PDO::PARAM_STR);
  $query->execute();
  if ($query->rowCount() === 0) exit();
  $row = $query->fetch(PDO::FETCH_ASSOC);
  $image = $row['img'];
  $mime = $row['img_mime'];
}

header("Content-Type:$mime");
echo $image;
