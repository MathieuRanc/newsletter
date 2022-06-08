<?php
session_start();
if (isset($_POST['code'])) {
  $_SESSION['code'] = $_POST['code'];
}
if (!isset($_SESSION['tmp_user']) || !isset($_SESSION['code'])) {
  header("Location: /login.php");
}

require('../components/config.php');
// check if code correspond to tmp_password in database and if it's still valid
$sql = "SELECT * FROM users WHERE email='$_SESSION[tmp_user]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if (password_verify($_SESSION['code'], $row['tmp_password'])) {
    if (strtotime($row['tmp_password_expires']) > time()) {
      if (isset($_POST['new-password']) && isset($_POST['confirm-new-password']) && $_POST['new-password'] == $_POST['confirm-new-password']) {
        $newPassword = mysqli_real_escape_string($conn, $_POST['new-password']);
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password='$newPassword', tmp_password=NULL, tmp_password_expires=NULL WHERE email='$_SESSION[tmp_user]'";
        $conn->query($sql);
        session_destroy();
        header("Location: /login.php");
      }
    } else {
      // delete tmp_password and tmp_password_expires from database
      $sql = "UPDATE users SET tmp_password=NULL, tmp_password_expires=NULL WHERE email='$_SESSION[tmp_user]'";
      $result = $conn->query($sql);
      unset($_SESSION['tmp_user'], $_SESSION['code']);
      header("Location: /forgot.php");
    }
  } else {
    unset($_SESSION['code']);
    header("Location: /forgot.php");
  }
}
$title = "Réinitialisation du mot de passe | LMLC Communication";
$css = "new-password";
require('../components/header.php');
?>

<main>
  <h1>Réinitialisation du mot de passe</h1>

  <form action="reset-password.php" method="post">
    <div>
      <label for="new-password">Nouveau mot de passe</label>
      <input type="password" name="new-password" id="new-password" placeholder="Nouveau mot de passe">
    </div>
    <div>
      <label for="confirm-new-password">Confirmation du mot de passe</label>
      <input type="password" name="confirm-new-password" id="confirm-new-password" placeholder="Confirmer le mot de passe">
    </div>
    <input type="submit" name="submit" value="Réinitialiser le mot de passe">
    <?php if (isset($_POST['new-password']) && isset($_POST['confirm-new-password'])) { ?>
      <p class="error">Les mots de passe ne correspondent pas</p>
    <?php } ?>
</main>

<?php require('../components/footer.php') ?>