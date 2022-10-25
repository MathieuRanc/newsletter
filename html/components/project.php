<a class="project" href="?name=<?php echo $row['slug'] ?>">
  <!-- hidden div -->
  <div style="display: none;" class="infos">
    <?php echo json_encode($row) ?>
  </div>
  <img src="<?php echo $row['image'] ?>" alt="">
  <?php echo $row['name'] ?>
</a>