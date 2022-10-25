<?php
$title = 'LMLC Communication | Projets';
$css = 'projects';
include(dirname(__DIR__, 2) . '/components/header.php');
?>
<script type="text/javascript" src="./assets/js/clipboard.js" defer></script>
<script type="text/javascript" src="./assets/js/share.js" defer></script>

<div class="page">
  <?php require(dirname(__DIR__, 2) . '/components/sidebar.php'); ?>

  <main>
    <h1>Projets LMLC Communication</h1>
    <?php if (!isset($_GET['name'])) { ?>
      <h2>Projets</h2>
      <div class="wrapper_projects">
        <?php
        require dirname(__DIR__, 2) . '/components/config.php';

        $sql = "SELECT * FROM projects";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
          require dirname(__DIR__, 2) . '/components/project.php';
        } ?>
      </div>
    <?php } else {
      require dirname(__DIR__, 2) . '/components/config.php';
      $slug = $conn->real_escape_string($_GET['name']);
      $sql = "SELECT * FROM projects WHERE slug='$slug'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      require dirname(__DIR__, 2) . '/components/project_detail.php';
    } ?>
  </main>
  <?php
  require dirname(__DIR__, 2) . '/components/menu.php';
  ?>

</div>

<?php require(dirname(__DIR__, 2) . '/components/footer.php') ?>