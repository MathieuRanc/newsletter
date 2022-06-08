<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
}
$file = $_FILES['upload'];

$fileName = $file['name'];
$fileTmpName = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileType = $file['type'];

$fileExt = explode('.', $fileName);
$fileActualExt = strtolower(end($fileExt));

$allowed = array('jpg', 'jpeg', 'png');

if (in_array($fileActualExt, $allowed)) {
  if ($fileError === 0) {
    if ($fileSize < 2000000) {
      $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
      $fileDestination = 'uploads/' . $fileNameNew;
      move_uploaded_file($fileTmpName, $fileDestination);
    }
  }
}

header('Location: newsletter.php');
