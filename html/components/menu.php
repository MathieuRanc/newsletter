<!-- change guests element in database if form in sumbited -->

<div class="edit-menu" style="display: none;">
  <button onclick="closeMenu()">fermer</button>
  <h3>Infos sur le fichier</h3>
  <div id="file-preview"></div>
  <div class="modify">
    <input type="text" name="name" id="name">
    <button class="edit-menu-item">
      <i class="fas fa-trash-alt"></i>
      <span>Supprimer</span>
    </button>
    <h3>Fichier partagé avec</h3>
    <form id="share" action="/update_file.php" method="post">
      <span>Partager avec :</span>
      <!-- get user list in database except current user -->
      <?php
      $sql = "SELECT * FROM users WHERE username!='$_SESSION[user]'";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) { ?>
        <div class="edit-menu-item-content">
          <input type="checkbox" name="guests[]" value="<?php echo $row['username'] ?>" id="<?php echo $row['username'] ?>">
          <label for="<?php echo $row['username'] ?>">
            <!-- php if -->
            <?php if ($row['genre'] == 'M') { ?>
            <?php } else { ?>
            <?php } ?>
            <?php echo $row['name'] ?>
          </label>
        </div>
      <?php } ?>
      <!-- hidden input with the file id in cookies with javascript -->
      <input type="hidden" name="id" value="" id="file_id">
      <input type="submit" value="Partager">
    </form>
  </div>
</div>