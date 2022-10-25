<?php

if (!(isset($_POST['name']) && isset($_POST['from']) && isset($_FILES['bcc']) && isset($_POST['subject']) && isset($_POST['text']) && isset($_POST['image']))) {
  header('Location: /');
}

$title = 'Aperçu | LMLC Communication';
$css = 'send';
require('../components/header.php');

$name = htmlspecialchars($_POST['name']);
$from = htmlspecialchars($_POST['from']);
$bcc = htmlspecialchars($_FILES['bcc']['name']);
$subject = htmlspecialchars($_POST['subject']);
$text = htmlspecialchars($_POST['text']);
$image = htmlspecialchars($_POST['image']);
?>

<div class="page">
  <?php require('../components/sidebar.php'); ?>

  <main>
    <h1>Aperçu du message envoyé</h1>
    <div>À : <?php echo $name . ' &lt;' . $from . '&gt;' ?></div>
    <div>Objet : <?php echo $subject ?></div>
    <div>Texte : <?php echo $text ?></div>
    <div>De : <?php echo $name . ' &lt;' . $from . '&gt;' ?></div>
    <div>
      Cci :
      <?php
      $csv = file_get_contents($_FILES["bcc"]["tmp_name"]);
      $csv = explode("\n", $csv);
      $bcc = '';
      if ($_POST['test']) {
        $bcc .= $_POST['test'] . ' , ';
      }
      $bcc .= join(' , ', $csv);
      echo $bcc;
      ?>
    </div>
    <div>
      Image :<br>
      <img src="uploads/<?php echo $image ?>" alt="">
    </div>
  </main>
</div>


<?php
$count = count($csv);

require('../components/config.php');

// insert values into database
$query = "INSERT INTO stats (name, sent, image) VALUES ('$name', '$count', '$image')";
$result = $conn->query($query);
var_dump($result);
$id = $conn->insert_id;
var_dump($id);

$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' . $name . ' <' . $from . ">\r\n" . 'Bcc: ' . $bcc;

$message = '<html><body>';
$message .= '<img src="https://' . $_SERVER['HTTP_HOST'] . "/uploads/$image\" />";
$message .= '<img class="hidden" src="https://' . $_SERVER['HTTP_HOST'] . "/received.php?id=$id\" />";
$message .= "<p>$text</p>";
$message .= '</body>';
$message .= '<style>img {width:100%;}p,.hidden{position:absolute;opacity:0;}</style>';
$message .= '</html>';

mail($name . ' <' . $from . '>', $subject, $message, $headers);

require('../components/footer.php');
?>