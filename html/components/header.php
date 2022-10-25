<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$guest = array('/login.php', '/register.php', '/send.php', '/forgot.php', '/reset-password.php');

if (!isset($_SESSION['user']) && !in_array($_SERVER['REQUEST_URI'], $guest)) {
  header("Location: login.php");
}
if (!isset($_COOKIE['theme'])) {
  setcookie('theme', 'light', time() + (86400 * 30), "/");
}
?>

<!DOCTYPE html>
<html lang="fr" class="<?php echo isset($_COOKIE['theme']) ? htmlspecialchars($_COOKIE['theme']) : 'light' ?>">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo isset($title) ? $title : 'Newsletter | LMLC Communication' ?></title>


  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <link rel="stylesheet" href="assets/css/footer.css">
  <link rel="stylesheet" href="assets/css/fonts.css">
  <?php if (isset($css)) { ?>
    <link rel="stylesheet" href="assets/css/<?php echo $css; ?>.css">
  <?php } ?>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" crossorigin="anonymous">
</head>

<body>