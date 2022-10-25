<?php
if (isset($_POST['id'])) {
  session_start();
  if (!isset($_SESSION['user'])) {
    header("Location: login.php");
  }
  require dirname(__DIR__, 1) . '/components/config.php';
  // secure input guests and id
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  if (isset($_POST['guests'])) {
    $guests = mysqli_real_escape_string($conn, implode(',', $_POST['guests']));
  } else {
    $guests = '';
  }
  // update guests in database
  $sql = "UPDATE files SET guests = '$guests' WHERE id = '$id' AND owner = '$_SESSION[user]'";
  $conn->query($sql);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
