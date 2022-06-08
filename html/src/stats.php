<?php
$title = 'Statistiques | LMLC Communication';
$css = 'stats';
include('../components/header.php');
?>

<div class="page">
  <?php require('../components/sidebar.php'); ?>

  <main>
    <h1>Stastistiques</h1>
    <table>
      <thead>
        <tr>
          <th>Image</th>
          <th>Nom d'envoi</th>
          <th>Nombre d'emails envoyés</th>
          <th>Nombre d'emails ouverts</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require('../components/config.php');

        $query = $conn->query('SELECT * FROM stats ORDER BY date DESC');
        while ($row = $query->fetch_assoc()) { ?>
          <tr>
            <td>
              <a href="<?php echo $row['image'] ?>">
                <img src="<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>">
              </a>
            </td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['sent'] ?></td>
            <td><?php echo $row['received'] ?></td>
            <td><?php echo $row['date'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </main>
</div>

<?php require('../components/footer.php') ?>