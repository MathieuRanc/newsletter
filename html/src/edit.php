<?php
require '../components/config.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

if (isset($_POST['update'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $status = mysqli_real_escape_string($conn, $_POST['status']);

  $query = "UPDATE projects SET name='$name', description='$description', status='$status' WHERE id='$id'";
  if (mysqli_query($conn, $query)) {
    // refresh the page
    header('Location: /edit.php?id=' . $id);
  }
}

// update project by id if modify input is clicked and id is set in url query string 
if (isset($_POST['modify'])) {
  // same but secure
  $type = mysqli_real_escape_string($conn, $_POST['type']);
  $design = mysqli_real_escape_string($conn, $_POST['design']);
  $translate = mysqli_real_escape_string($conn, $_POST['translate']);
  $payment = mysqli_real_escape_string($conn, $_POST['payment']);
  $accounts = mysqli_real_escape_string($conn, $_POST['accounts']);
  $fonctionnalites = mysqli_real_escape_string($conn, $_POST['fonctionnalites']);
  $pages = mysqli_real_escape_string($conn, $_POST['pages']);
  $hosting = mysqli_real_escape_string($conn, $_POST['hosting']);

  $query = "UPDATE projects SET type='$type', design='$design', translate='$translate', payment='$payment', accounts='$accounts', fonctionnalites='$fonctionnalites', pages='$pages', hosting='$hosting' WHERE id='$id'";
  if (mysqli_query($conn, $query)) {
    // refresh the page
    header('Location: /edit.php?id=' . $id);
  }
}

// title with project name
//find project name in database with id
$query = $conn->query("SELECT * FROM projects WHERE id='$id'");
$row = $query->fetch_assoc();
$title = $row['name'] . ' | LMLC Communication';
$css = "edit";
include '../components/header.php';
?>

<div class="page">
  <?php require '../components/sidebar.php'; ?>
  <main>
    <h1><?php echo $row['name']; ?></h1>

    <div>
      <a href="/specifications/<?php echo $row['specifications']; ?>" download>
        <i class="fas fa-download"></i> Télécharger le cahier des charges
      </a>
    </div>
    <!-- Create a textarea to edit the fields of projects -->
    <form action="edit.php?id=<?php echo $row['id']; ?>" method="post" class="infos">
      <div>
        <div>
          <label for="name">Nom du projet</label>
          <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>">
        </div>
        <div>
          <label for="status">Statut</label>
          <select name="status" id="status">
            <!-- display only option if not current in database -->
            <option value="<?php echo $row['status'] ?>" selected><?php echo $row['status'] ?></option>
            <?php if ($row['status'] != "Brouillon") { ?>
              <option value="Brouillon">Brouillon</option>
            <?php } ?>
            <?php if ($row['status'] != "En cours") { ?>
              <option value="En cours">En cours</option>
            <?php } ?>
            <?php if ($row['status'] != "Terminé") { ?>
              <option value="Terminé">Terminé</option>
            <?php } ?>
          </select>
        </div>
        <div>
          <label for="description">Description</label>
          <textarea name="description" id="description"><?php echo $row['description']; ?></textarea>
        </div>
        <input type="submit" name="update" value="Mettre à jour">
      </div>
    </form>
    <form action="edit.php?id=<?php echo $row['id']; ?>" method="post">
      <h2>Caractéristiques du projet <input type="submit" value="Mettre à jour"></h2>
      <h3>Type</h3>
      <div class="horizontal">
        <div>
          <input type="radio" name="type" id="e-commerce" value="E-commerce" <?php echo $row['type'] == 'E-commerce' ? 'checked' : '' ?>>
          <label for="e-commerce">E-commerce</label>
        </div>
        <div>
          <input type="radio" name="type" id="vitrine" value="Site vitrine" <?php echo $row['type'] == 'Site vitrine' ? 'checked' : '' ?>>
          <label for="vitrine">Site vitrine</label>
        </div>
        <div>
          <input type="radio" name="type" id="logo" value="Logo" <?php echo $row['type'] == 'Logo' ? 'checked' : '' ?>>
          <label for="logo">Logo</label>
        </div>
        <div>
          <input type="radio" name="type" id="graphical-charter" value="Charte graphique" <?php echo $row['type'] == 'Charte graphique' ? 'checked' : '' ?>>
          <label for="graphical-charter">Charte graphique</label>
        </div>
        <!-- autre -->
        <!-- <div>
          <input type="radio" name="type" id="other" value="Autre">
          <label for="other">Autre <input type="text" name="type" id="text_other"></label>
        </div> -->
      </div>
      <h3>Design</h3>
      <div>
        <div>
          <input type="radio" name="design" id="simple" value="Simple" <?php echo $row['design'] == 'Simple' ? 'checked' : '' ?>>
          <label for="simple">Un design standard, simple et efficace</label>
        </div>
        <div>
          <input type="radio" name="design" id="classic" value="Classique" <?php echo $row['design'] == 'Classique' ? 'checked' : '' ?>>
          <label for="classic">Un design soigné réalisé à partir de vos propres maquettes</label>
        </div>
        <div>
          <input type="radio" name="design" id="advanced" value="Advanced" <?php echo $row['design'] == 'Advanced' ? 'checked' : '' ?>>
          <label for="advanced">Un design haut de gamme entièrement sur mesure</label>
        </div>
      </div>
      <h3>Traduction du site</h3>
      <div class="horizontal">
        <div>
          <input type="radio" name="translate" id="yes-translation" value="Oui" <?php echo $row['translate'] == 'Oui' ? 'checked' : '' ?>>
          <label for="yes-translation">Oui</label>
        </div>
        <div>
          <input type="radio" name="translate" id="no-translation" value="Non" <?php echo $row['translate'] == 'Non' ? 'checked' : '' ?>>
          <label for="no-translation">Non</label>
        </div>
      </div>
      <h3>Paiement en ligne</h3>
      <div>
        <div>
          <input type="radio" name="payment" id="cb-paypal" value="CB/Paypal" <?php echo $row['payment'] == 'CB/Paypal' ? 'checked' : '' ?>>
          <label for="cb-paypal">Oui des paiements simples par CB / Paypal</label>
        </div>
        <div>
          <input type="radio" name="payment" id="abonnements" value="Abonnements" <?php echo $row['payment'] == 'Abonnements' ? 'checked' : '' ?>>
          <label for="abonnements">Oui des paiements récurrents pour des abonnements</label>
        </div>
        <div>
          <input type="radio" name="payment" id="no-payments" value="Non" <?php echo $row['payment'] == 'Non' ? 'checked' : '' ?>>
          <label for="no-payments">Non</label>
        </div>
      </div>
      <h3>Comptes clients</h3>
      <div class="horizontal">
        <div>
          <input type="radio" name="accounts" id="yes-accounts" value="Oui" <?php echo $row['accounts'] == 'Oui' ? 'checked' : '' ?>>
          <label for="yes-accounts">Oui</label>
        </div>
        <div>
          <input type="radio" name="accounts" id="no-accounts" value="Non" <?php echo $row['accounts'] == 'Non' ? 'checked' : '' ?>>
          <label for="no-accounts">Non</label>
        </div>
      </div>
      <h3>Fonctionnalitées</h3>
      <div>
        <div>
          <input type="checkbox" name="fonctionnalites" id="blog" value="Blog" <?php echo $row['fonctionnalites'] == 'Blog' ? 'checked' : '' ?>>
          <label for="blog">Blog</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites" id="social-networks" value="Réseaux sociaux" <?php echo $row['fonctionnalites'] == 'Réseaux sociaux' ? 'checked' : '' ?>>
          <label for="social-networks">Intégration des réseaux sociaux</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites" id="newsletter" value="Newsletter" <?php echo $row['fonctionnalites'] == 'Newsletter' ? 'checked' : '' ?>>
          <label for="newsletter">Inscription newsletter</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites" id="research" value="Recherche" <?php echo $row['fonctionnalites'] == 'Recherche' ? 'checked' : '' ?>>
          <label for="research">Moteur de recherche interne</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites" id="meeting" value="RDV" <?php echo $row['fonctionnalites'] == 'RDV' ? 'checked' : '' ?>>
          <label for="meeting">Module de prise de RDV</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites" id="devis" value="Devis" <?php echo $row['fonctionnalites'] == 'Devis' ? 'checked' : '' ?>>
          <label for="devis">Module de demande de devis</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites" id="facture" value="Factures" <?php echo $row['fonctionnalites'] == 'Factures' ? 'checked' : '' ?>>
          <label for="facture">Gestion des factures</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites" id="crm-erp" value="CRM/ERP" <?php echo $row['fonctionnalites'] == 'CRM/ERP' ? 'checked' : '' ?>>
          <label for="crm-erp">Intégration CRM / ERP</label>
        </div>
      </div>
      <h3>Pages</h3>
      <div>
        <div>
          <input type="checkbox" name="pages" id="page-equipe" value="Équipe" <?php echo $row['pages'] == 'Équipe' ? 'checked' : '' ?>>
          <label for="page-equipe">Équipe</label>
        </div>
      </div>
      <h3>Hébergement</h3>
      <div>
        <div>
          <input type="radio" name="hosting" id="no-hosting" value="Non" <?php echo $row['hosting'] == 'Non' ? 'checked' : '' ?>>
          <label for="no-hosting">Je compte m'en occuper moi-même</label>
        </div>
        <div>
          <input type="radio" name="hosting" id="stardart" value="Standart" <?php echo $row['hosting'] == 'Standart' ? 'checked' : '' ?>>
          <label for="stardart">Je souhaite un hébergement standard</label>
        </div>
        <div>
          <input type="radio" name="hosting" id="premium" value="Premium" <?php echo $row['hosting'] == 'Premium' ? 'checked' : '' ?>>
          <label for="premium">Je souhaite un hébergement premium (pour un site à fort trafic)</label>
        </div>
      </div>
      <!-- Save modifications -->
      <input type="submit" name="modify" value="Mettre à jour">
    </form>
  </main>
</div>

<?php require '../components/footer.php'; ?>