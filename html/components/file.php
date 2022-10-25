<div class="file">
  <!-- hidden div -->
  <div style="display: none;" class="infos">
    <?php echo json_encode($row) ?>
  </div>
  <div class="tags">
    <span class="tag">
      <?php if ($row['type'] === 'video') { ?>
        <i class="fa-solid fa-video"></i>
      <?php } elseif ($row['type'] === 'pdf') { ?>
        <i class="fa-solid fa-file-pdf"></i>
      <?php } elseif ($row['type'] === 'image') { ?>
        <i class="fa-solid fa-image"></i>
      <?php } elseif ($row['type'] === 'zip') { ?>
        <i class="fa-solid fa-file-archive"></i>
      <?php } elseif ($row['type'] === 'audio') { ?>
        <i class="fa-solid fa-file-audio"></i>
      <?php } elseif ($row['type'] === 'text') { ?>
        <i class="fa-solid fa-file-text"></i>
      <?php } elseif ($row['type'] === 'code') { ?>
        <i class="fa-solid fa-file-code"></i>
      <?php } elseif ($row['type'] === 'excel') { ?>
        <i class="fa-solid fa-file-excel"></i>
      <?php } elseif ($row['type'] === 'word') { ?>
        <i class="fa-solid fa-file-word"></i>
      <?php } elseif ($row['type'] === 'powerpoint') { ?>
        <i class="fa-solid fa-file-powerpoint"></i>
      <?php } elseif ($row['type'] === 'web') { ?>
        <i class="fa-solid fa-file-code"></i>
      <?php } elseif ($row['type'] === 'file') { ?>
        <i class="fa-solid fa-file"></i>
      <?php } ?>

    </span>
    <span class="tag">
      <?php
      if ($row['size'] > pow(1024, 3)) {
        echo round($row['size'] / pow(1024, 3)) . 'Gb';
      } elseif ($row['size'] > pow(1024, 2)) {
        echo round($row['size'] / pow(1024, 2)) . 'Mb';
      } elseif ($row['size'] > 1024) {
        echo round($row['size'] / 1024) . 'Kb';
      } else {
        echo round($row['size']) . 'bytes';
      }
      ?>
    </span>
    <?php if ($row['guests'] != '') { ?>
      <span class="tag">
        <i class="fa-solid fa-users"></i>
      </span>
    <?php } ?>
  </div>
  <?php if ($row['type'] === 'video') { ?>
    <video src="<?php echo $_ENV['HOSTNAME'] . $row['location'] ?>"></video>
  <?php } elseif ($row['type'] === 'pdf') { ?>
    <iframe src="<?php echo $_ENV['HOSTNAME'] . $row['location'] ?>#toolbar=0&navpanes=0">
    </iframe>
  <?php } elseif ($row['type'] === 'image') { ?>
    <img src="<?php echo $_ENV['HOSTNAME'] . $row['thumbnail'] ?>">
  <?php } elseif ($row['type'] === 'zip') { ?>
    <img src="<?php echo $_ENV['HOSTNAME'] . $row['thumbnail'] ?>">
  <?php } elseif ($row['type'] === 'audio') { ?>
    <audio src="<?php echo $_ENV['HOSTNAME'] . $row['location'] ?>" controls></audio>
  <?php } elseif ($row['type'] === 'text') { ?>
    <iframe src="<?php echo $_ENV['HOSTNAME'] . $row['location'] ?>#toolbar=0&navpanes=0">
    </iframe>
  <?php } elseif ($row['type'] === 'code') { ?>
    <iframe src="<?php echo $_ENV['HOSTNAME'] . $row['location'] ?>#toolbar=0&navpanes=0">
    </iframe>
  <?php } elseif ($row['type'] === 'excel') { ?>
    <iframe src="<?php echo $_ENV['HOSTNAME'] . $row['location'] ?>#toolbar=0&navpanes=0">
    </iframe>
  <?php } elseif ($row['type'] === 'word') { ?>
    <iframe src="<?php echo $_ENV['HOSTNAME'] . $row['location'] ?>#toolbar=0&navpanes=0">
    </iframe>
  <?php } elseif ($row['type'] === 'powerpoint') { ?>
    <iframe src="<?php echo $_ENV['HOSTNAME'] . $row['location'] ?>#toolbar=0&navpanes=0">
    </iframe>
  <?php } elseif ($row['type'] === 'web') { ?>
    <iframe src="<?php echo $_ENV['HOSTNAME'] . $row['location'] ?>#toolbar=0&navpanes=0">
    </iframe>
  <?php } elseif ($row['type'] === 'file') { ?>
    <iframe src="<?php echo $_ENV['HOSTNAME'] . $row['location'] ?>#toolbar=0&navpanes=0">
    </iframe>
  <?php } ?>
  <div class="infos">
    <span><?php echo $row['name'] ?></span>
    <div>
      <button onclick="copyClipboard(this)"><i class="fa-solid fa-link"></i></button>
      <a href="<?php echo $row['location'] ?>" download="<?php echo $row['name'] ?>"><i class="fas fa-download"></i></a>
    </div>
  </div>
</div>