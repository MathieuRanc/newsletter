<?php
$title = 'Cahier des charges | LMLC Communication';
$css = 'specifications';
include('../components/header.php');
?>

<div class="page">
  <?php require('../components/sidebar.php'); ?>

  <main>
    <h1>Cahier des charges</h1>
    <div>
      <div>
        <!-- redirect to a page to create a new project -->
        <a href="create.php">Créer un nouveau projet</a>
      </div>
      <!-- create sortable table using data of project table in database -->
      <table class="sortable">
        <thead>
          <tr>
            <th>Nom du projet</th>
            <th>Description</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require('../components/config.php');

          $query = $conn->query('SELECT * FROM projects ORDER BY id DESC');
          while ($row = $query->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row['name'] ?></td>
              <td><?php echo $row['description'] ?></td>
              <td><?php echo $row['status'] ?></td>
              <td>
                <a href="edit.php?id=<?php echo $row['id'] ?>">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="delete.php?id=<?php echo $row['id'] ?>">
                  <i class="fa-solid fa-trash"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </main>
</div>

<?php require('../components/footer.php') ?>