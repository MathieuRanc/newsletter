<?php
$title = "Réglages | LMLC Communication";
$css = "settings";
require('../components/header.php');
?>

<div class="page">
  <?php require('../components/sidebar.php'); ?>

  <main>
    <h1>Réglages</h1>
    <!-- <h2>Thème</h2>
  <button onclick="changeTheme('light')">Mode clair</button>
  <button onclick="changeTheme('dark')">Mode sombre</button>

  <script>
    function changeTheme(theme) {
      document.cookie = "theme=" + theme + "; path=/";
      location.reload();
    }
  </script> -->

    <h2>Changer de mot de passe</h2>
    <form action="settings.php" method="post">
      <div>
        <label for="old-password">Ancien mot de passe</label>
        <input type="password" name="old-password" id="old-password" placeholder="Ancien mot de passe" autocomplete="current-password" required aria-required>
      </div>
      <div>
        <label for="new-password">Nouveau mot de passe</label>
        <input type="password" name="new-password" id="new-password" placeholder="Nouveau mot de passe" autocomplete="new-password" required aria-required>
      </div>
      <div>
        <label for="password-confirm">Confirmer le nouveau mot de passe</label>
        <input type="password" name="confirm-new-password" id="confirm-new-password" placeholder="Confirmer le nouveau mot de passe" autocomplete="new-password" required aria-required>
      </div>
      <input type="submit" name="submit" value="Modifier le mot de passe">

      <?php
      if (
        isset($_POST['old-password']) &&
        isset($_POST['new-password']) &&
        isset($_POST['confirm-new-password'])
        && $_POST['new-password'] == $_POST['confirm-new-password']
      ) {
        require('../components/config.php');

        $password = mysqli_real_escape_string($conn, $_POST['old-password']);
        $newPassword = mysqli_real_escape_string($conn, $_POST['new-password']);
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // check if the old password is correct
        $query = "SELECT password FROM users WHERE username='$_SESSION[user]'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
          $sql = "UPDATE users SET password='$newPassword' WHERE username='$_SESSION[user]'";
          $result = $conn->query($sql);
          echo '<p class="success">Mot de passe modifié</p>';
        } else {
          echo '<p class="error">Mot de passe incorrect</p>';
        }
      } else {
        if (isset($_POST['old-password']) && isset($_POST['new-password']) && isset($_POST['confirm-new-password'])) {
          echo '<p class="error">Les mots de passe ne correspondent pas</p>';
        }
      }
      ?>
    </form>
  </main>
</div>

<?php require('../components/footer.php'); ?>