<?php
// insert project into database from post request
if (isset($_POST['create'])) {
  require(dirname(__DIR__, 1) . '/components/config.php');
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $status = mysqli_real_escape_string($conn, $_POST['status']);

  $query = "INSERT INTO cdc (name, description, status) VALUES ('$name', '$description', '$status')";
  if (mysqli_query($conn, $query)) {
    // refresh the page
    header('Location: specifications.php');
  }
}

$title = 'LMLC Communication';
$css = 'create';
include(dirname(__DIR__, 1) . '/components/header.php');
?>

<div class="page">
  <!-- create a new project -->
  <?php require(dirname(__DIR__, 1) . '/components/sidebar.php'); ?>
  <main>
    <h1>Créer un nouveau projet</h1>
    <div>
      <!-- create a new project -->
      <form action="create.php" method="post">
        <div>
          <label for="name">Nom du projet</label>
          <input type="text" name="name" id="name" required>
        </div>
        <div>
          <label for="description">Description</label>
          <textarea name="description" id="description" required></textarea>
        </div>
        <div>
          <label for="status">Statut</label>
          <select name="status" id="status" required>
            <option value="Brouillon">Brouillon</option>
            <option value="En cours">En cours</option>
            <option value="Terminé">Terminé</option>
          </select>
        </div>
        <div>
          <button type="submit" name="create">Créer</button>
        </div>
    </div>
  </main>
</div>

<?php require dirname(__DIR__, 1) . '/components/footer.php'; ?>