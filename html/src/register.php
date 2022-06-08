<?php
$title = 'Register | LMLC Communication';
// session_start();
// if (isset($_POST['username']) && isset($_POST['password'])) {
//   $username = $_POST['username'];
//   $password = $_POST['password'];
//   $password = password_hash($password, PASSWORD_DEFAULT);
//   $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
//   require('../components/config.php');
//   if ($conn->query($sql) === TRUE) {
//     $_SERVER['user'] = $username;
//     header('Location: /');
//   } else {
//     echo '<p class="error">Error: ' . $sql . '</p>';
//   }
// }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php isset($title) ? $title : 'Register | LMLC Communication' ?></title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <?php if (isset($css)) { ?>
    <link rel="stylesheet" href="../assets/css/<?php echo $css; ?>.css">
  <?php } ?>
</head>

<body>

  <form action="register.php" method="post">
    <?php
    if (isset($_POST['username']) && isset($_POST['password'])) {
      echo '<p class="error">Identifiants incorrects</p>';
    }
    ?>
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password" autocomplete="new-password">
    <input type="password" name="password2" placeholder="Confirm password" autocomplete="new-password">
    <input type="submit" name="submit" value="Login">
  </form>