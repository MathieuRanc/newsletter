<?php
require dirname(__DIR__, 1) . '/components/config.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

if (isset($_POST['update'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $description = str_replace('\r\n', '<br>', $description);
  $activity = mysqli_real_escape_string($conn, $_POST['activity']);
  $activity = str_replace('\r\n', '<br>', $activity);
  $objectif = mysqli_real_escape_string($conn, $_POST['objectif']);
  $objectif = str_replace('\r\n', '<br>', $objectif);
  $status = mysqli_real_escape_string($conn, $_POST['status']);

  $query = "UPDATE cdc SET name='$name', description='$description', activity='$activity', objectif='$objectif', status='$status' WHERE id='$id'";
  if (mysqli_query($conn, $query)) {
    // refresh the page
    header('Location: /edit.php?id=' . $id);
  }
}

// update project by id if modify input is clicked and id is set in url query string 
if (isset($_POST['modify']) && isset($_POST['type']) && isset($_POST['design']) && isset($_POST['translate']) && isset($_POST['payment']) && isset($_POST['accounts']) && isset($_POST['hosting']) && isset($_POST['content']) && isset($_POST['maintenance'])) {
  // same but secure
  $type = mysqli_real_escape_string($conn, $_POST['type']);
  $code = mysqli_real_escape_string($conn, $_POST['code']);
  $charter = isset($_POST['charter']) ? implode(',', $_POST['charter']) : null;
  $design = mysqli_real_escape_string($conn, $_POST['design']);
  $translate = mysqli_real_escape_string($conn, $_POST['translate']);
  $payment = mysqli_real_escape_string($conn, $_POST['payment']);
  $accounts = mysqli_real_escape_string($conn, $_POST['accounts']);
  $fonctionnalites = isset($_POST['fonctionnalites']) ? implode(',', $_POST['fonctionnalites']) : null;
  $pages = isset($_POST['pages']) ? implode(',', $_POST['pages']) : null;
  $hosting = mysqli_real_escape_string($conn, $_POST['hosting']);
  $seo = isset($_POST['seo']) ? implode(',', $_POST['seo']) : null;
  $content = mysqli_real_escape_string($conn, $_POST['content']);
  $stats = isset($_POST['stats']) ? implode(',', $_POST['stats']) : null;
  $maintenance = mysqli_real_escape_string($conn, $_POST['maintenance']);

  $query = "UPDATE cdc SET type='$type', code='$code', charter='$charter', design='$design', translate='$translate', payment='$payment', accounts='$accounts', fonctionnalites='$fonctionnalites', pages='$pages', hosting='$hosting', seo='$seo', content='$content', stats='$stats', maintenance='$maintenance' WHERE id='$id'";
  if (mysqli_query($conn, $query)) {
    // refresh the page
    // header('Location: /edit.php?id=' . $id);
  }
}

// title with project name
//find project name in database with id
$query = $conn->query("SELECT * FROM cdc WHERE id='$id'");
$row = $query->fetch_assoc();

$name = isset($row['name']) ? mysqli_real_escape_string($conn, $row['name']) : null;
$status = isset($row['status']) ? mysqli_real_escape_string($conn, $row['status']) : null;
$description = isset($row['description']) ? mysqli_real_escape_string($conn, $row['description']) : '';
$description = str_replace('<br>', '
', $description);
$description = str_replace("\'", "'", $description);
$activity = isset($row['activity']) ? mysqli_real_escape_string($conn, $row['activity']) : '';
$activity = str_replace('<br>', '
', $activity);
$activity = str_replace("\'", "'", $activity);
$objectif = isset($row['objectif']) ? mysqli_real_escape_string($conn, $row['objectif']) : '';
$objectif = str_replace('<br>', '
', $objectif);
$objectif = str_replace("\'", "'", $objectif);

$type = isset($row['type']) ? mysqli_real_escape_string($conn, $row['type']) : null;
$code = isset($row['code']) ? mysqli_real_escape_string($conn, $row['code']) : null;
$charter = isset($row['charter']) ? explode(',', $row['charter']) : array();
$design = isset($row['design']) ? mysqli_real_escape_string($conn, $row['design']) : null;
$translate = isset($row['translate']) ? mysqli_real_escape_string($conn, $row['translate']) : null;
$payment = isset($row['payment']) ? mysqli_real_escape_string($conn, $row['payment']) : null;
$accounts = isset($row['accounts']) ? mysqli_real_escape_string($conn, $row['accounts']) : null;
$fonctionnalites = isset($row['fonctionnalites']) ? explode(',', $row['fonctionnalites']) : array();
$pages = isset($row['pages']) ? explode(',', $row['pages']) : array();
$hosting = isset($row['hosting']) ? mysqli_real_escape_string($conn, $row['hosting']) : null;
$seo = isset($row['seo']) ? explode(',', $row['seo']) : array();
$content = isset($row['content']) ? mysqli_real_escape_string($conn, $row['content']) : null;
$stats = isset($row['stats']) ? explode(',', $row['stats']) : array();
$maintenance = isset($row['maintenance']) ? mysqli_real_escape_string($conn, $row['maintenance']) : null;

require(dirname(__DIR__, 1) . '/components/estimations.php');
$times = timeWebsite($row);

$title = $row['name'] . ' | LMLC Communication';
$css = "edit";
include dirname(__DIR__, 1) . '/components/header.php';
?>

<div class="page">
  <?php require dirname(__DIR__, 1) . '/components/sidebar.php'; ?>
  <main>
    <h1><?php echo $row['name']; ?></h1>

    <p><?php echo $times['hours'] ?></p>

    <div>
      <a href="/view.php?id=<?php echo $id; ?>" download>
        <i class="fas fa-download"></i> Télécharger le cahier des charges
      </a>
    </div>
    <!-- Create a textarea to edit the fields of cdc -->
    <form action="edit.php?id=<?php echo $id; ?>" method="post" class="infos">
      <div>
        <div>
          <label for="name">Nom du projet</label>
          <input type="text" name="name" id="name" value="<?php echo $name; ?>">
        </div>
        <div>
          <label for="status">Statut</label>
          <select name="status" id="status">
            <!-- display only option if not current in database -->
            <option value="<?php echo $status ?>" selected><?php echo $status ?></option>
            <?php if ($status != "Brouillon") { ?>
              <option value="Brouillon">Brouillon</option>
            <?php } ?>
            <?php if ($status != "En cours") { ?>
              <option value="En cours">En cours</option>
            <?php } ?>
            <?php if ($status != "Terminé") { ?>
              <option value="Terminé">Terminé</option>
            <?php } ?>
          </select>
        </div>
        <div>
          <label for="description">Description du projet</label>
          <textarea name="description" id="description"><?php echo $description; ?></textarea>
        </div>
        <div>
          <label for="activity">Description de l'activitée du client</label>
          <textarea name="activity" id="activity"><?php echo $activity; ?></textarea>
        </div>
        <div>
          <label for="objectif">Objectif du projet</label>
          <textarea rows="10" name="objectif" id="objectif" placeholder="Précisez quels sont les objectifs de votre site internet en étant le plus précis possible,
gagner en visibilité et en notoriété,
conquérir des parts de marché,
être simplement présent pour appuyer votre force commerciale,
vendre des produits ou des services en ligne,
informer vos clients, partenaires, fournisseurs…"><?php echo $objectif; ?></textarea>
        </div>
        <input type="submit" name="update" value="Mettre à jour">
      </div>
    </form>
    <form action="edit.php?id=<?php echo $id; ?>" method="post">
      <h2>Caractéristiques du projet <input type="submit" name="modify" value="Mettre à jour"></h2>
      <h3>Type</h3>
      <div class="horizontal">
        <div>
          <input type="radio" name="type" id="e-commerce" value="e-commerce" <?php echo $type == 'e-commerce' ? 'checked' : '' ?>>
          <label for="e-commerce">E-commerce</label>
        </div>
        <div>
          <input type="radio" name="type" id="vitrine" value="vitrine" <?php echo $type == 'vitrine' ? 'checked' : '' ?>>
          <label for="vitrine">Site vitrine</label>
        </div>
        <div>
          <input type="radio" name="type" id="refonte" value="refonte" <?php echo $type == 'refonte' ? 'checked' : '' ?>>
          <label for="refonte">Refonte de site existant</label>
        </div>
        <div>
          <input type="radio" name="type" id="mobile" value="mobile" <?php echo $type == 'mobile' ? 'checked' : '' ?>>
          <label for="mobile">Application mobile</label>
        </div>
        <!-- <div>
          <input type="radio" name="type" id="logo" value="logo" <?php echo $type == 'logo' ? 'checked' : '' ?>>
          <label for="logo">Logo</label>
        </div>
        <div>
          <input type="radio" name="type" id="graphical-charter" value="charte" <?php echo $type == 'charte' ? 'checked' : '' ?>>
          <label for="graphical-charter">Charte graphique</label>
        </div> -->
      </div>
      <h3>Codage</h3>
      <div>
        <div>
          <input type="radio" name="code" id="wordpress" value="wordpress" <?php echo $code == 'wordpress' ? 'checked' : '' ?>>
          <label for="wordpress">Site simplifié codé en Wordpress</label>
        </div>
        <div>
          <input type="radio" name="code" id="handmade" value="code" <?php echo $code == 'code' ? 'checked' : '' ?>>
          <label for="handmade">Site très performant entièrement codé à la main</label>
        </div>
      </div>
      <h3>Charte graphique</h3>
      <div>
        <div>
          <input type="checkbox" name="charter[]" id="charter-logo" value="logo" <?php echo in_array('logo', $charter) ? 'checked' : '' ?>>
          <label for="charter-logo">Logo</label>
        </div>
        <div>
          <input type="checkbox" name="charter[]" id="charter-colors" value="couleurs" <?php echo in_array('couleurs', $charter) ? 'checked' : '' ?>>
          <label for="charter-colors">Couleurs</label>
        </div>
        <div>
          <input type="checkbox" name="charter[]" id="charter-fonts" value="polices" <?php echo in_array('polices', $charter) ? 'checked' : '' ?>>
          <label for="charter-fonts">Polices</label>
        </div>
      </div>
      <h3>Design</h3>
      <div>
        <div>
          <input type="radio" name="design" id="simple" value="simple" <?php echo $design == 'simple' ? 'checked' : '' ?>>
          <label for="simple">Un design standard, simple et efficace</label>
        </div>
        <div>
          <input type="radio" name="design" id="classic" value="classique" <?php echo $design == 'classique' ? 'checked' : '' ?>>
          <label for="classic">Un design soigné réalisé à partir de vos propres maquettes</label>
        </div>
        <div>
          <input type="radio" name="design" id="advanced" value="advanced" <?php echo $design == 'advanced' ? 'checked' : '' ?>>
          <label for="advanced">Un design haut de gamme entièrement sur mesure</label>
        </div>
      </div>
      <h3>Traduction du site</h3>
      <div class="horizontal">
        <div>
          <input type="radio" name="translate" id="yes-translation" value="oui" <?php echo $translate == 'oui' ? 'checked' : '' ?>>
          <label for="yes-translation">Oui</label>
        </div>
        <div>
          <input type="radio" name="translate" id="no-translation" value="non" <?php echo $translate == 'non' ? 'checked' : '' ?>>
          <label for="no-translation">Non</label>
        </div>
      </div>
      <h3>Paiement en ligne</h3>
      <div>
        <div>
          <input type="radio" name="payment" id="cb-paypal" value="cb-paypal" <?php echo $payment == 'cb-paypal' ? 'checked' : '' ?>>
          <label for="cb-paypal">Oui des paiements simples par CB / Paypal</label>
        </div>
        <div>
          <input type="radio" name="payment" id="abonnements" value="abonnements" <?php echo $payment == 'abonnements' ? 'checked' : '' ?>>
          <label for="abonnements">Oui des paiements récurrents pour des abonnements</label>
        </div>
        <div>
          <input type="radio" name="payment" id="no-payments" value="non" <?php echo $payment == 'non' ? 'checked' : '' ?>>
          <label for="no-payments">Non</label>
        </div>
      </div>
      <h3>Comptes clients</h3>
      <div class="horizontal">
        <div>
          <input type="radio" name="accounts" id="yes-accounts" value="oui" <?php echo $accounts == 'oui' ? 'checked' : '' ?>>
          <label for="yes-accounts">Oui</label>
        </div>
        <div>
          <input type="radio" name="accounts" id="no-accounts" value="non" <?php echo $accounts == 'non' ? 'checked' : '' ?>>
          <label for="no-accounts">Non</label>
        </div>
      </div>
      <h3>Fonctionnalitées</h3>
      <div>
        <div>
          <input type="checkbox" name="fonctionnalites[]" id="blog" value="blog" <?php echo in_array('blog', $fonctionnalites) ? 'checked' : '' ?>>
          <label for="blog">Blog</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites[]" id="simple-animations" value="a-simples" <?php echo in_array('a-simples', $fonctionnalites) ? 'checked' : '' ?>>
          <label for="simple-animations">Animations simples (ex : apparition de textes, effets au survolage de la souris)</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites[]" id="complex-animations" value="a-complexes" <?php echo in_array('a-complexes', $fonctionnalites) ? 'checked' : '' ?>>
          <label for="complex-animations">Animations complexes (ex : effets de scroll, parallax, images vectorielles animées)</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites[]" id="social-networks" value="social" <?php echo in_array('social', $fonctionnalites) ? 'checked' : '' ?>>
          <label for="social-networks">Intégration des réseaux sociaux</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites[]" id="newsletter" value="newsletter" <?php echo in_array('newsletter', $fonctionnalites) ? 'checked' : '' ?>>
          <label for="newsletter">Inscription newsletter</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites[]" id="research" value="recherche" <?php echo in_array('recherche', $fonctionnalites) ? 'checked' : '' ?>>
          <label for="research">Moteur de recherche interne</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites[]" id="meeting" value="rdv" <?php echo in_array('rdv', $fonctionnalites) ? 'checked' : '' ?>>
          <label for="meeting">Module de prise de RDV</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites[]" id="devis" value="devis" <?php echo in_array('devis', $fonctionnalites) ? 'checked' : '' ?>>
          <label for="devis">Module de demande de devis</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites[]" id="facture" value="factures" <?php echo in_array('factures', $fonctionnalites) ? 'checked' : '' ?>>
          <label for="facture">Gestion des factures</label>
        </div>
        <div>
          <input type="checkbox" name="fonctionnalites[]" id="crm-erp" value="crm-erp" <?php echo in_array('crm-erp', $fonctionnalites) ? 'checked' : '' ?>>
          <label for="crm-erp">Intégration CRM / ERP</label>
        </div>
      </div>
      <h3>Pages</h3>
      <div>
        <div>
          <input type="checkbox" name="pages[]" id="page-home" value="accueil" <?php echo in_array('accueil', $pages) ? 'checked' : '' ?>>
          <label for="page-home">Accueil</label>
        </div>
        <div>
          <input type="checkbox" name="pages[]" id="page-equipe" value="equipe" <?php echo in_array('equipe', $pages) ? 'checked' : '' ?>>
          <label for="page-equipe">Équipe</label>
        </div>
        <div>
          <input type="checkbox" name="pages[]" id="page-about-us" value="a-propos" <?php echo in_array('a-propos', $pages) ? 'checked' : '' ?>>
          <label for="page-about-us">À propos</label>
        </div>
        <div>
          <input type="checkbox" name="pages[]" id="page-whoami" value="whoami" <?php echo in_array('whoami', $pages) ? 'checked' : '' ?>>
          <label for="page-whoami">Qui sommes nous ?</label>
        </div>
        <div>
          <input type="checkbox" name="pages[]" id="page-portfolio" value="portfolio" <?php echo in_array('portfolio', $pages) ? 'checked' : '' ?>>
          <label for="page-portfolio">Portfolio</label>
        </div>
        <div>
          <input type="checkbox" name="pages[]" id="page-faq" value="faq" <?php echo in_array('faq', $pages) ? 'checked' : '' ?>>
          <label for="page-faq">FAQ</label>
        </div>
        <div>
          <input type="checkbox" name="pages[]" id="page-contact" value="contact" <?php echo in_array('contact', $pages) ? 'checked' : '' ?>>
          <label for="page-contact">Contact</label>
        </div>
      </div>
      <h3>Hébergement</h3>
      <div>
        <div>
          <input type="radio" name="hosting" id="no-hosting" value="non" <?php echo $hosting == 'non' ? 'checked' : '' ?>>
          <label for="no-hosting">Je compte m'en occuper moi-même</label>
        </div>
        <div>
          <input type="radio" name="hosting" id="stardart" value="standart" <?php echo $hosting == 'standart' ? 'checked' : '' ?>>
          <label for="stardart">Je souhaite un hébergement standard</label>
        </div>
        <div>
          <input type="radio" name="hosting" id="premium" value="premium" <?php echo $hosting == 'premium' ? 'checked' : '' ?>>
          <label for="premium">Je souhaite un hébergement premium (pour un site à fort trafic)</label>
        </div>
      </div>
      <h3>SEO</h3>
      <div>
        <div>
          <input type="checkbox" name="seo[]" id="seo-keywords" value="mots-cles" <?php echo in_array('mots-cles', $seo) ? 'checked' : '' ?>>
          <label for="seo-keywords">3 mots clés par page</label>
        </div>
        <div>
          <input type="checkbox" name="seo[]" id="seo-content" value="contenu" <?php echo in_array('contenu', $seo) ? 'checked' : '' ?>>
          <label for="seo-content">Création de textes bien référencés, de qualité</label>
        </div>
        <div>
          <input type="checkbox" name="seo[]" id="seo-monthly" value="mois" <?php echo in_array('mois', $seo) ? 'checked' : '' ?>>
          <label for="seo-monthly">Création d'articles bien référencés, de qualité chaque mois</label>
        </div>
        <div>
          <input type="checkbox" name="seo[]" id="seo-weekly" value="semaines" <?php echo in_array('semaines', $seo) ? 'checked' : '' ?>>
          <label for="seo-weekly">Création d'articles bien référencés, de qualité chaque semaine</label>
        </div>
        <div>
          <input type="checkbox" name="seo[]" id="seo-social" value="social" <?php echo in_array('social', $seo) ? 'checked' : '' ?>>
          <label for="seo-social">Image du lien du site personnalisée sur les réseaux sociaux</label>
        </div>
        <div>
          <input type="checkbox" name="seo[]" id="seo-sitemap" value="sitemap" <?php echo in_array('sitemap', $seo) ? 'checked' : '' ?>>
          <label for="seo-sitemap">Sitemap</label>
        </div>
        <div>
          <input type="checkbox" name="seo[]" id="seo-paid" value="payant" <?php echo in_array('payant', $seo) ? 'checked' : '' ?>>
          <label for="seo-paid">Référencement payant pour avoir une forte visibilitée rapidement</label>
        </div>
      </div>
      <h3>Contenu</h3>
      <div>
        <div>
          <input type="radio" name="content" id="content-client" value="client" <?php echo $content == 'client' ? 'checked' : '' ?>>
          <label for="content-client">Fourni par le client</label>
        </div>
        <div>
          <input type="radio" name="content" id="content-agency" value="agence" <?php echo $content == 'agence' ? 'checked' : '' ?>>
          <label for="content-agency">Créé par l'agence</label>
        </div>
      </div>
      <h3>Suivi des statistiques</h3>
      <div>
        <div>
          <input type="checkbox" name="stats[]" id="stats-pos" value="position" <?php echo in_array('position', $stats) ? 'checked' : '' ?>>
          <label for="stats-pos">Position dans les recherches</label>
        </div>
        <div>
          <input type="checkbox" name="stats[]" id="stats-clics" value="clics" <?php echo in_array('clics', $stats) ? 'checked' : '' ?>>
          <label for="stats-clics">Nombre de clics par jour</label>
        </div>
        <div>
          <input type="checkbox" name="stats[]" id="stats-validity" value="validitee" <?php echo in_array('validitee', $stats) ? 'checked' : '' ?>>
          <label for="stats-validity">Validité de l'ensemble des pages du site</label>
        </div>
        <div>
          <input type="checkbox" name="stats[]" id="stats-ergonomie" value="ergonomie" <?php echo in_array('ergonomie', $stats) ? 'checked' : '' ?>>
          <label for="stats-ergonomie">Ergonomie mobile</label>
        </div>
        <div>
          <input type="checkbox" name="stats[]" id="stats-security" value="securitée" <?php echo in_array('securitée', $stats) ? 'checked' : '' ?>>
          <label for="stats-security">Problèmes de sécurité</label>
        </div>
        <div>
          <input type="checkbox" name="stats[]" id="stats-upgrades" value="ameliorations" <?php echo in_array('ameliorations', $stats) ? 'checked' : '' ?>>
          <label for="stats-upgrades">Améliorations suggérées</label>
        </div>
      </div>
      <h3>Maintenance annuelle</h3>
      <div>
        <div>
          <input type="radio" name="maintenance" id="maintenance-no" value="non" <?php echo $maintenance == 'non' ? 'checked' : '' ?>>
          <label for="maintenance-no">Non</label>
        </div>
        <div>
          <input type="radio" name="maintenance" id="maintenance-essential" value="essentielle" <?php echo $maintenance == 'essentielle' ? 'checked' : '' ?>>
          <label for="maintenance-essential">Essentielle (renouvellement des services d'hébergement)</label>
        </div>
        <div>
          <input type="radio" name="maintenance" id="maintenance-premium" value="premium" <?php echo $maintenance == 'premium' ? 'checked' : '' ?>>
          <label for="maintenance-premium">Premium (inclut des correctifs et des modifications)</label>
        </div>
      </div>
      <!-- Save modifications -->
      <input type="submit" name="modify" value="Mettre à jour">
    </form>
  </main>
</div>

<?php require dirname(__DIR__, 1) . '/components/footer.php'; ?>