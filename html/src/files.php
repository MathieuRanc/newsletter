<?php

$title = 'Fichiers | LMLC Communication';
$css = 'files';
require(dirname(__DIR__, 1) . '/components/header.php');
?>
<script type="text/javascript" src="./assets/js/plupload/plupload.full.min.js"></script>
<script type="text/javascript" src="./assets/js/plupload.js" defer></script>
<script type="text/javascript" src="./assets/js/clipboard.js" defer></script>
<script type="text/javascript" src="./assets/js/share.js" defer></script>

<!-- <script type="text/javascript" src="./assets/js/plupload/moxie.js"></script>
<script type="text/javascript" src="./assets/js/plupload/plupload.dev.js"></script> -->

<div class="page">
  <?php require(dirname(__DIR__, 1) . '/components/sidebar.php'); ?>

  <main>
    <h1>Fichiers</h1>
    <h2>Ajouter des fichiers</h2>
    <div id="filelist"></div>
    <div id="container">
      <a id="pickfiles" href="javascript:;">Choisir des fichiers</a>
      <a id="uploadfiles" href="javascript:;">Téléverser les fichiers</a>
    </div>
    <br />
    <pre id="console"></pre>

    <h2>Mes fichiers</h2>
    <div class="wrapper">
      <?php
      require dirname(__DIR__, 1) . '/components/config.php';

      $sql = "SELECT * FROM files WHERE owner='$_SESSION[user]'";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
        require dirname(__DIR__, 1) . '/components/file.php';
      } ?>
    </div>
    <h2>Fichiers partagés avec moi</h2>
    <div class="wrapper">
      <?php
      require dirname(__DIR__, 1) . '/components/config.php';

      $sql = "SELECT * FROM files WHERE guests LIKE '%$_SESSION[user]%'";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
        require dirname(__DIR__, 1) . '/components/file.php';
      } ?>
    </div>
  </main>
  <!-- create edit menu for files when selected -->
  <?php require dirname(__DIR__, 1) . '/components/menu.php' ?>
</div>

<?php require(dirname(__DIR__, 1) . '/components/footer.php'); ?>