<?php
$title = "Mot de passer oublié | LMLC Communication";
$css = "forgot";
require(dirname(__DIR__, 1) . '/components/header.php');
?>

<main>
  <div class="image"></div>
  <div class="forgot">
    <h1>Mot de passe oublié</h1>
    <?php if (!isset($_POST['email'])) { ?>
      <form action="forgot.php" method="post">
        <input type="email" name="email" placeholder="email" required aria-required>
        <input type="submit" name="submit" value="Réinitialiser le mot de passe">
      </form>
      <?php } else {
      require(dirname(__DIR__, 1) . '/components/config.php');

      $email = mysqli_real_escape_string($conn, $_POST['email']);

      $sql = "SELECT * FROM users WHERE email='$email'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $_SESSION['tmp_user'] = $email;
        $row = $result->fetch_assoc();
        // generate temporary password for user
        $password = substr(md5(uniqid(rand(), true)), 0, 8);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // update user's tmp_password and expires fields in database with new password and expiration date in the future (1 hour)
        $sql = "UPDATE users SET tmp_password='$hashed_password', tmp_password_expires=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email='$email'";
        $result = $conn->query($sql);
        $to = $email;
        $subject = "Réinitialisation du mot de passe";
        $message = "Bonjour,\n\nVous avez demandé la réinitialisation de votre mot de passe.\n\nVotre nouveau mot de passe est: $password\n\nVotre mot de passe expirera dans une heure.\n\nCordialement,\n\nL'équipe de LMLC Communication";
        $headers = "From: LMLC Communication <no-reply@lmlccommunication.fr>\r\n";
        mail($to, $subject, $message, $headers); ?>
        <div>
          <p>Entrez le code qui vous a été envoyé par email</p>
          <form action="reset-password.php" method="post">
            <input type="text" name="code" placeholder="Code" required aria-required autocomplete="one-time-code">
            <input type="submit" name="submit" value="Réinitialiser le mot de passe">
          </form>
        </div>
      <?php } else { ?>
        <div>
          <p>Cette adresse email n'est pas enregistrée.</p>
          <a href="/login.php">Retour à l'accueil</a>
        </div>
    <?php }
    } ?>
  </div>
</main>

<?php require(dirname(__DIR__, 1) . '/components/footer.php') ?>