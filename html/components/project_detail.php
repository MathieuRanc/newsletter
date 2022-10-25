<div class="project_detail">
  <!-- hidden div -->
  <div style="display: none;" class="infos">
    <?php echo json_encode($row) ?>
  </div>
  <a href="/projects">Retour aux projets</a>
  <br>
  <br>
  <div class="info">
    <img class="main" src="<?php echo $row['image'] ?>" alt="">
    <div>
      <h2>
        <?php echo $row['name'] ?>
        <span class="tag">
          <?php echo $row['state'] ?>
        </span>
      </h2>
    </div>
  </div>
  <h2>Fichiers partagés avec moi</h2>
  <div class="wrapper">
    <?php
    require dirname(__DIR__, 1) . '/components/config.php';

    $sql = "SELECT * FROM files WHERE project='1'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      require dirname(__DIR__, 1) . '/components/file.php';
    } ?>
  </div>
</div>