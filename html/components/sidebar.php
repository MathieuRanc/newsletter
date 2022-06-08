<a href="/" class="logo-mobile"><img src="../assets/images/download.svg" alt=""></a>
<input type="checkbox" name="burger" id="burger">
<label for="burger">
  <span></span>
  <span></span>
</label>
<nav>
  <div>
    <a href="/" class="logo"><img src="../assets/images/download.svg" alt=""></a>
    <p>Bonjour <?php echo $_SESSION['name'] ?></p>
    <div>
      <a class="<?php echo in_array($_SERVER['REQUEST_URI'], array('/')) ? 'router-link-active' : '' ?>" href="/"><i class="fa-solid fa-house"></i>Tableau de bord</a>
      <a class="<?php echo in_array($_SERVER['REQUEST_URI'], array('/newsletter.php')) ? 'router-link-active' : '' ?>" href="/newsletter.php"><i class="fa-solid fa-paper-plane"></i>Newsletter</a>
      <a class="<?php echo in_array($_SERVER['REQUEST_URI'], array('/specifications.php', '/create.php', '/edit.php')) ? 'router-link-active' : '' ?>" href="/specifications.php"><i class="fa-solid fa-clipboard-list"></i></i>Cahier des charges</a>
      <a class="<?php echo in_array($_SERVER['REQUEST_URI'], array('/settings.php')) ? 'router-link-active' : '' ?>" href="/settings.php"><i class="fa-solid fa-gear"></i>Réglages</a>
      <a class="<?php echo in_array($_SERVER['REQUEST_URI'], array('/stats.php')) ? 'router-link-active' : '' ?>" href="/stats.php"><i class="fa-solid fa-chart-line"></i>Stastistiques</a>
    </div>
  </div>
  <a class="logout" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Déconnexion</a>
</nav>