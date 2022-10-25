<?php
$title = 'Newsletter | LMLC Communication';
$css = 'newsletter';
include('../components/header.php');
include('../components/config.php');
?>
<div class="page">
  <?php require('../components/sidebar.php'); ?>

  <main>
    <h1>Outil d'envoi de newsletter LMLC Communication</h1>

    <h2>Téléverser une nouvelle image</h2>
    <form class="upload" action="<?php echo $_ENV['HOSTNAME'] ?>upload.php" method="post" enctype="multipart/form-data">
      <div class="drop-down">
        <label for="upload">Téléversez un fichier (2 MB max)</label>
        <input type="file" name="upload" id="upload">
      </div>
      <input type="submit" value="Upload" name="submit">
    </form>

    <hr>

    <h2>Envoyer une newsletter</h2>
    <form class="newsletter" action="send.php" method="post" enctype="multipart/form-data">
      <div>
        <label for="from">Nom d'envoi</label>
        <input type="text" name="name" id="name" value="Aubrun Homme" placeholder="Name" required aria-required>
      </div>

      <div>
        <label for="from">De</label>
        <select name="from" id="from" required aria-required>
          <option value="newsletter@lmlccommunication.fr">newsletter@lmlccommunication.fr</option>
        </select>
      </div>

      <div>
        <label for="subject">Objet</label>
        <input type="text" name="subject" id="subject" value="Joyeux anniversaire" placeholder="Subject" required aria-required>
      </div>

      <div>
        <label for="text">Texte</label>
        <textarea name="text" id="text" rows="4" placeholder="Text" required aria-required>Aubrun a le plaisir de vous offrir -25% sur l'article de votre choix.</textarea>
      </div>

      <div>
        <label for="from">Emails de test</label>
        <textarea type="text" name="test" id="test" rows="4" placeholder="Test">leo@lmlccommunication.fr , mathieu@lmlccommunication.fr</textarea>
      </div>

      <div>
        <label for="bcc">Cci</label>
        <input type="file" accept=".csv" name="bcc" id="bcc" required aria-required>
      </div>


      <div>
        <label for="image">Visuel</label>
        <div class="images_wrapper">
          <?php
          $scan = scandir('uploads');
          if (count($scan) - 2 > 0) {
            $id = 1;
            foreach ($scan as $file) {
              if (!is_dir("uploads/$file")) { ?>
                <input type="radio" name="image" value="<?php echo $file ?>" id="image<?php echo $id ?>" required aria-required>
                <label for="image<?php echo $id ?>"><img src="uploads/<?php echo $file ?>" alt=""></label>
          <?php
                $id++;
              }
            }
          } else {
            echo '<p>Vous devez téléverser une nouvelle image pour envoyer une newsletter</p>';
          }
          ?>
        </div>
        <input type="submit" value="Envoyer la newsletter">
      </div>
    </form>
  </main>
</div>

<?php require('../components/footer.php') ?>