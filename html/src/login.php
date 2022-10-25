<?php
$title = 'Login | LMLC Communication';
$css = 'login';
if (isset($_POST['username']) && isset($_POST['password'])) {
  require(dirname(__DIR__, 1) . '/components/config.php');

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    session_start();
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['user'] = $username;
      $_SESSION['name'] = $row['name'];
      header('Location: /');
    } elseif (
      isset($row['tmp_password']) &&
      isset($row['tmp_password_expires']) &&
      password_verify($password, $row['tmp_password']) &&
      strtotime($row['tmp_password_expires']) > time()
    ) {
      $_SESSION['tmp_user'] = $username;
      header('Location: new-password.php');
    }
  }
}
?>

<?php require(dirname(__DIR__, 1) . '/components/header.php') ?>

<main>
  <div class="image"></div>
  <div class="login">
    <h1>Identifiez-vous</h1>
    <form action="login.php" method="post">
      <?php
      if (isset($_POST['username']) && isset($_POST['password'])) {
        echo '<p class="error">Identifiants incorrects</p>';
      }
      ?>
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <a href="/forgot.php">Mot de passe oublié ?</a>
      <input type="submit" name="submit" value="Login">
    </form>
    <div></div>
  </div>
</main>

<?php require(dirname(__DIR__, 1) . '/components/footer.php'); ?>