<?php
require '../components/config.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);
// select project by id
$query = $conn->query("SELECT * FROM cdc WHERE id='$id'");
$row = $query->fetch_assoc();
$title = $row['name'] . ' | LMLC Communication';
$css = "edit";

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
}
if (!isset($_COOKIE['theme'])) {
  setcookie('theme', 'light', time() + (86400 * 30), "/");
}

$name = isset($row['name']) ? mysqli_real_escape_string($conn, $row['name']) : null;
$status = isset($row['status']) ? mysqli_real_escape_string($conn, $row['status']) : null;
$description = isset($row['description']) ? mysqli_real_escape_string($conn, $row['description']) : null;

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

ob_start();
?>
<style type="text/css">
  .footer {
    width: 100%;
    text-align: right;
  }

  h1,
  h2,
  h3 {
    color: #0d10d1;
    letter-spacing: 10px;
  }

  .h1_main {
    position: absolute;
    top: 140mm;
    text-align: center;
    width: 100%;
  }

  .standard_main {
    text-align: center;
    width: 100%;
  }

  img {
    width: 20mm
  }

  .p {
    width: 195mm;
    text-align: justify;
  }
</style>
<page backimg="./assets/images/background.jpg">
  <page_footer>
    <div class="footer">
      <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] ?>/assets/images/logo.png" />
    </div>
  </page_footer>
  <bookmark title="Chapter 1" level="0"></bookmark>
  <h1 class="h1_main"><?php echo $row['name'] ?></h1>
  <div class="standard_main">
    <?php echo $row['description'] ?>
  </div>
</page>
<page>
  <page_footer>
    <div class="footer">
      <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] ?>/assets/images/logo.png" />
    </div>
  </page_footer>
  <bookmark title="Chapter 1" level="0"></bookmark>
  <div class="main">
    <h1>Pr&eacute;face</h1>
    <div class="standard">
      <h2>Type</h2>
      <?php echo $type ?>
      <h2>Code</h2>
      <?php echo $code ?>
      <h2>Charter</h2>
      <?php echo implode(', ', $charter) ?>
      <h2>Design</h2>
      <?php echo $design ?>
      <h2>Translate</h2>
      <?php echo $translate ?>
      <h2>Payment</h2>
      <?php echo $payment ?>
      <h2>Accounts</h2>
      <?php echo $accounts ?>
      <h2>Fonctionnalites</h2>
      <?php echo implode(', ', $fonctionnalites) ?>
      <h2>Pages</h2>
      <?php echo implode(', ', $pages) ?>
      <h2>Hosting</h2>
      <?php echo $hosting ?>
      <h2>SEO</h2>
      <?php echo implode(', ', $seo) ?>
      <h2>Content</h2>
      <?php echo $content ?>
      <h2>Stats</h2>
      <?php echo implode(', ', $stats) ?>
      <h2>Maintenance</h2>
      <?php echo $maintenance ?>
    </div>
  </div>
</page>
<page pageset="old" backtop="7mm" backbottom="20mm" backleft="10mm" backright="10mm">
  <div class="main">
    <bookmark title="Cahier des charges" level="0"></bookmark>
    <h1>Cahier des charges</h1>
    <bookmark title="présentation de votre entreprise" level="1"></bookmark>
    <h2>1. <?php echo $row['name'] ?></h2>
    <bookmark title="1.1. Activités" level="2"></bookmark>
    <h3>1.1. Activités</h3>
    <div class="p"><?php echo $row['activity'] ?></div>
    <div class="p"><b>Agence 360, digitale native et créative, nous sommes spécialisés en branding, digital et production. Notre ADN est le goût du beau et le sens du détail.</b></div>
    <div class="p">Agence nomade, nous n’avons pas de frontière. Nous sommes ouverts à toutes les nouvelles solutions et innovations de la communication. Nous aimons aussi bien travailler au niveau national, international que régional. Nous revendiquons la flexibilité, la fluidité et l’agilité en alliant des experts et des talents dans chacun de leurs domaines.</div>
    <bookmark title="2. Activités" level="2"></bookmark>
    <h2>2. présentation du projet de création</h2>
    <h3 id="2-1-objectifs-de-la-cr-ation-de-votre-site-internet">2.1. Objectifs de la création de votre site internet</h3>
    <p><?php echo $row['objectif'] ?></p>
    <h2 id="2-2-caract-ristiques-et-tendue-des-services-ou-produits-pr-sent-s">2.2. Caractéristiques et étendue des services ou produits présentés</h2>
    <div class="p">Donnez les caractéristiques de chacun de vos produits ou services, ceux à mettre en avant… Plus les produits sont décrits, plus il sera facile par la suite de produire le contenu textuel du site internet.</div>
    <h3 id="a-produits">a) Produits</h3>
    <div class="p">Listez et détaillez vos produits et précisez comment vous souhaitez les mettre en valeur.</div>
    <h3 id="b-services">b) Services</h3>
    <div class="p">Listez et détaillez vos services en précisant comment vous souhaitez les présenter.</div>
    <h3 id="2-3-votre-cible-client">2.3. Votre cible client</h3>
    <div class="p">Précisez à qui s’adresse vos produits et services, certaines méthodes comme celle des personas permettent de créer des profils clients types et de mieux définir sa cible client.</div>
    <h3 id="2-4-r-le-de-chacun-dans-la-cr-ation-de-votre-site-internet">2.4. RÔLE DE CHACUN DANS LA CRÉATION DE VOTRE SITE INTERNET</h3>
    <div class="p">Il est toujours indispensable de définir le qui fait quoi dans tout projet, la réussite de la création d’un site internet passe aussi par une définition des rôles de chacun. Estimez le temps que vous pouvez accorder à la création du site et à son animation.</div>
    <h3 id="2-5-votre-r-le-exemple-">2.5. Rôle du client</h3>
    <ul>
      <li>Valider les maquettes (graphisme, ergonomie, couleur, contenu),</li>
      <li>transmettre les codes d’accès FTP, les codes d’accès à la base de données…</li>
      <li>valider le cahier des charges,</li>
      <li>veiller au respect des délais pour la transmission du contenu (texte, images, photos, vidéo …).</li>
    </ul>
    <h3 id="2-6-r-le-de-votre-agence-web-exemple-">2.6. Rôle de votre agence web (exemple)</h3>
    <ul>
      <li>Assister et conseiller la société pendant la phase de création du cahier des charges,</li>
      <li>proposer des mots clés pertinents à mettre en avant dans le contenu,</li>
      <li>concevoir et réaliser la refonte du site Internet conformément au cahier des charges,</li>
      <li>respecter les délais définis dans un échéancier validé conjointement,</li>
      <li>former un ou plusieurs collaborateurs de votre entreprise sur la console d’administration permettant de mettre à jour et d’ajouter le contenu texte et image du site internet.</li>
    </ul>
    <h3 id="2-7-contenu-caract-ristiques-de-votre-site-internet">2.7. CONTENU &amp; CARACTÉRISTIQUES DE VOTRE SITE INTERNET</h3>
    <h3 id="2-8-contenu-et-rendu-visuel-de-votre-site-internet">2.8. Contenu et rendu visuel de votre site Internet</h3>
    <div class="p">Décrivez en quelques lignes le contenu fourni en terme de quantité, de formats…</div>
    <h3 id="a-images-photos-vid-os-pdf-">a) Images, photos, vidéos, PDF…</h3>
    <h3 id="b-contenu-texte-typo">b) Contenu texte, typo</h3>
    <h3 id="c-couleurs-ambiances-design-identit-visuelle">c) Couleurs, ambiances, design, identité visuelle</h3>
    <h3 id="2-9-estimation-du-volume-du-contenu">2.9. Estimation du volume du contenu</h3>
    <div class="p">L’estimation du volume du contenu permet de donner une idée du nombre de page à créer et de l’arborescence à construire.</div>
    <h3 id="2-10-maquettes-des-pages-de-votre-site-internet">2.10. Maquettes des pages de votre site internet</h3>
    <div class="p">Décrivez ou dessinez à main levée les différentes maquettes de votre site, en commençant par la page d’accueil si vous avez déjà une idée précise du Webdesign de votre site internet.</div>
    <div class="p">Maquettes complémentaires pour la présentation de :</div>
    <ul>
      <li>Vos produits et services,</li>
      <li>votre actualité,</li>
      <li>votre entreprise,</li>
      <li>un formulaire de contact personnalisé…</li>
    </ul>
    <div class="p">Les maquettes réalisées sur Photoshop permettent aussi en parti de valider l’arborescence et la navigation dans votre site internet par la présence des menus.</div>
    <h3 id="2-11-contenu-arborescence-et-navigation-de-votre-site-internet">2.11. Contenu, arborescence et navigation de votre site Internet</h3>
    <div class="p">Vous pouvez dessiner l’arborescence (sitemap) de votre site internet, vous pouvez utiliser des logiciels de mind mapping pour vous aider ou tout simplement nous contacter.</div>
    <div class="p">cahier des charges ergonomie site web</div>
    <h3 id="2-12-h-bergement-nom-de-domaine-adresse-mail">2.12. Hébergement, nom de domaine &amp; adresse mail</h3>
    <div class="p">Vous pouvez gérer ou sous traiter l’hébergement de votre site internet, dans le deux cas, l’hébergement doit être adapté au site et ses caractéristiques doivent être connues.</div>
    <h3 id="a-nom-de-domaine">a) Nom de domaine</h3>
    <div class="p">Précisez ici votre nom de domaine, et si vous n’en avez pas, n’hésitez pas à lire cet article sur les noms de domaine.</div>
    <h3 id="b-adresse-mail">b) Adresse mail</h3>
    <div class="p">Listez simplement vos adresses mails.</div>
    <h3 id="2-13-r-f-rencement-pour-les-moteurs-de-recherche">2.13. Référencement pour les moteurs de recherche</h3>
    <div class="p">Le choix des mots clés est important pour le référencement naturel de vote site internet.</div>
    <div class="p">Dans votre recherche de mots clés, votre intuition sera toujours la première phase d’exploration avant d’utiliser d’autres techniques.</div>
    <div class="p">L’ approche intuitive consiste à se placer dans la tête d’un internaute lambda tapant sa requête dans un moteur pour trouver vos produits et services, listez tous les termes s’approchant de près ou faisant référence à votre activité ou produit (synonymes, variantes, repères géographiques, temporalité, concurrents, constructeurs…).</div>
    <div class="p">Le choix de vos mots clés doit également prendre en compte leur fréquence d’utilisation ainsi que la concurrence sur ces mêmes mots clés.</div>
    <div class="p">cahier des charges et contenus pour seo</div>
    <h3 id="2-14-principales-caract-ristiques-techniques-de-votre-site-internet">2.14. Principales caractéristiques techniques de votre site internet</h3>
    <div class="p">Vous trouverez ci-dessous une liste non exhaustive de caractéristiques pour un site internet :</div>
    <ul>
      <li>Utilisation du gestionnaire d’un gestionnaire de contenu (CMS) de type WordPress ou Typo 3 par exemple,</li>
      <li>design auto-adaptatif ou encore responsive, (le site s’adapte à toutes les résolutions d’écran),</li>
      <li>utilisation des micro-données pour les coordonnées de la société et des informations sur les produits,</li>
      <li>couplage du site avec un profil Google+.</li>
      <li>développement et personnalisation de la console d’administration du gestionnaire de contenu permettant la modification et l’ajout de contenu très simplement,</li>
      <li>création possible d’un nombre illimité de pages,</li>
      <li>optimisation du SEO,</li>
      <li>liaison aux réseaux sociaux Google+, Facebook, Viadeo…</li>
      <li>installation d’un module pour l’envoi de Newsletter…</li>
    </ul>
    <h3 id="2-15-mise-jour-de-votre-site-internet">2.15. Mise à jour de votre site internet</h3>
    <div class="p">Précisez si vous souhaitez ou non mettre à jour et alimenter vous même votre site internet.</div>
    <h3 id="2-16-statistiques-de-connexion">2.16. Statistiques de connexion</h3>
    <div class="p">Demandez à avoir l’accès aux statistiques de fréquentation de votre site Internet avec Google Analytics ou tout autre outil statistique. Pour avoir accès à Analytics, vous devrez vous créer une adresse mail en @gmail.com.</div>
    <div class="p">Vous aurez alors accès aux statistiques suivantes :</div>
    <ul>
      <li>Le nombre de visiteurs uniques,</li>
      <li>le nombre total de sessions,</li>
      <li>les mots clés tapés par les internautes sur Google pour atteindre votre site,</li>
      <li>les moteurs, annuaires et sites référents,</li>
      <li>les pages les plus, et les moins visitées,</li>
      <li>la provenance géographique des visiteurs,</li>
      <li>les jours et tranches horaires des visites,</li>
      <li>les navigateurs utilisés par les visiteurs,</li>
      <li>les terminaux utilisés (ordinateur de bureau, tablette, smartphone),</li>
      <li>les taux de conversion d’objectifs prédéfinis…</li>
      <li>tableau de bord google analytics</li>
    </ul>
    <h2 id="3-options-possibles">3. OPTIONS POSSIBLES</h2>
    <div class="p">Listez ici les fonctionnalités particulières comme un développement bilingue de votre site ou un module de paiement par exemple.</div>
    <h2 id="4-livrable-de-votre-site-internet">4 LIVRABLE DE VOTRE SITE INTERNET</h2>
    <div class="p">Les pièces à fournir par l’agence web pendant et après la réalisation du site seront les suivantes :</div>
    <ul>
      <li>L’arborescence du site (l’arborescence peut être définie par les maquettes Photoshop)</li>
      <li>Le planning de réalisation avec un engagement sur des échéances dont la date de mise en ligne du site internet,</li>
      <li>Les fichiers informatiques (pages HTML, graphismes, base de données, programmes…),</li>
      <li>Un cahier des charges décrivant le site, son fonctionnement et son hébergement,</li>
      <li>Les versions du code HTML et CSS utilisées,</li>
      <li>La liste des navigateurs compatibles,</li>
      <li>Les copies d’écrans des déclarations annuaires (les déclarations dans les annuaires seront à définir en fonction de votre activité),</li>
      <li>L’identifiant et le mot de passe pour accéder à votre console d’administration.</li>
    </ul>
    <h2 id="5-engagements">5. ENGAGEMENTS</h2>
    <div class="p">Votre société et l’agence web s’engagent au respect mutuel du contenu de ce cahier des charges, avec la date et la signature de chacun, il devient alors un document contractuel.</div>
    <div class="p">Le cahier de charges fonctionnel peut inclure d’autres composantes liées à la création de votre site internet, la rédaction web par exemple, la création ou la modification d’une identité visuelle, la rédaction des mentions légales, la promotion du site internet, …</div>
    <div class="p"><strong>À chaque projet de site sur-mesure, un cahier des charges sur mesure !</strong></div>
    <h2 id="pour-conclure-sur-le-cahier-des-charges">Pour conclure sur le cahier des charges</h2>
    <div class="p"><strong>Un cahier des charges correctement rédigé est l’une des clés de la réussite de votre projet web</strong>, n’hésitez pas à passer le temps nécessaire pour le bâtir. Vous pouvez également vous faire accompagner par une agence web pour sa rédaction.</div>

  </div>
</page>
<?php
$content = ob_get_clean();

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(7, 7, 7, 7));
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->setDefaultFont('helvetica');
$html2pdf->pdf->SetTitle($row['name']);
$html2pdf->pdf->SetSubject($row['description']);
$html2pdf->writeHTML($content);
$html2pdf->output();
?>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo isset($title) ? $title : 'Newsletter | LMLC Communication' ?></title>


  <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>

</html>
<!-- <html lang="fr" class="<?php echo isset($_COOKIE['theme']) ? htmlspecialchars($_COOKIE['theme']) : 'light' ?>">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo isset($title) ? $title : 'Newsletter | LMLC Communication' ?></title>


  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/fonts.css">
</head> -->