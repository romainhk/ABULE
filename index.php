<?php
session_start();
setlocale(LC_TIME, 'fr_FR', 'fra', 'french');
date_default_timezone_set('Europe/Paris');
require('db.php');
require('fonctions.php');

/*
 * Passage de paramètres GET
 */
$page = 'Accueil';
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = strtr($_GET['page'], "_", " ");
} else if (isset($_GET['action'])) {
    $page = 'Admin';
}
$action = 'lire';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

/* 
 * Sélection des feuilles de style à utiliser
 * Messages d'avertissements
 */
$avertissements = array(); //Avertissements/Erreurs à reporter à l'usager
$styles = array( "style", "lightbox" ); //Les styles css à utiliser
$browser = get_browser($_SERVER["HTTP_USER_AGENT"], FALSE);
if ($browser->cssversion > 2) {
    array_push($styles, "style3");
    $horloge = '';
} else {
    #array_push($styles, "style2");
    if ($browser->cssversion <= 1) {
        array_push($avertissements, 
            "Votre navigateur web (".$browser->browser.' '.$browser->version.") est trop ancien.");
    }
}
if (!$browser->javascript) {
    array_push($avertissements, 
        "Le javascript n'est pas activé ; certains éléments s'afficheront mal ou pas du tout.");
    if (isset($_SESSION['login'])) {
        array_push($avertissements, 
            "Le javascript est indispensable pour le mode administrateur.");
    }
}
$horloge_flash = (strstr($_SERVER['HTTP_ACCEPT'], 'application/x-shockwave-flash')) ? true : false;

/*
 * Contenu html
 */
# Styles
$les_styles = "";
foreach ($styles as $s) {
    $les_styles = $les_styles."    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/$s.css\" />\n";
}
# Messages d'erreur
$les_erreurs = "";
if (count($avertissements) > 0) {
    foreach ($avertissements as $av) {
        $les_erreurs = $les_erreurs.str_repeat(" ",8).'<img src="images/important.png" alt="'
            .$av.'" style="height:31px;" />'."\n";
    }
}

///////////////////////////////   Contenu Html  /////////////////////////////////////////
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
  <head>
    <title>L´ABULE<?php echo " · $page"; ?></title>
    <meta http-equiv="Content-language" content="fr" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="Author" content="Steeve et Romain" />
    <meta name="Copyright" content="L'A.B.U.L.E." />
    <meta name="Description" content="Site de L'A.B.U.L.E., Association de Biologie de l'Université du Littoral pour l'Écologie" />
    <meta name="Keywords" lang="fr" content="association, biologie, calais, écologie, université, ULCO, université du littoral" />
    <meta name="Keywords" lang="en" content="association, biology, calais, ecology, university, ULCO, université du littoral" />
    <meta name="Rev" content="labulecalais@gmail.com" />
    <meta name="Revisit-after" content="17 days" />
    <meta name="Robots" content="all, follow, index" />
<?php echo $les_styles; ?>
    <link rel="icon" type="image/png" href="favicon.png" />
    <script type="text/javascript" src="js/general.js"></script>
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
    <script type="text/javascript" src="js/lightbox.js"></script>
  </head>

  <body onload="horloge()">
  <div style="margin:0 4%">
    <div class="banniere">
        <div class="superpose">
            <div class="bannieregauche">
                <img src="images/cote_bambou.png" alt="" height="200" />
            </div>
            <div class="bannieredroite">
                <img src="images/cote_bambou.png" alt="" height="200" />
            </div>
        </div>
        <img src="images/logo.png" alt="Logo de l'ABULE" height="200" width="250" style="text-align:center;" />
    </div><!--
## Menu gauche
    -->
    <div class="menu" style="float:left;">
		<span style="height:180px;display:block;"></span>
        <?php #PHP
require('menu.php'); ?>
<!--
        <h2><a href="?page=Accueil">Accueil</a></h2>
        <h2><a href="">Présentation de l´Association</a></h2>
        <h2>Événements</h2>
        <ul>
            <li><a href="http://www.archive.org">Passé</a></li>
            <li><a href="">À venir</a></li>
        </ul>
        <h2>Nos services</h2>
        <ul>
            <li><a href="">Bourse aux livres</a></li>
            <li><a href="">Liste de stage</a></li>
        </ul>
        <h2><a href="">À découvrir</a></h2>
        <h2><a href="?page=Liens">Liens</a></h2>
-->
    </div><!--
## Menu droit
    -->
    <div class="menu" style="float:right;">
        <?php #PHP
## Horloge
if ($horloge_flash) {
	echo '<span style="height:43px;display:block;"></span>'."\n";
    echo '  <div style="margin:1ex auto; width:140px; height:150px;">';
    echo '  <object type="application/x-shockwave-flash" data="http://www.clocklink.com/clocks/0018b-green.swf?TimeZone=France_Paris" width="140" height="150">'."\n";
    echo '    <param name="wmode" value="transparent" />';
    echo '  </object>'."\n".'  </div>';
} else {
    echo '<span id="horloge"></span>';
}
?>
        <ul>
            <li><a href="?action=contacter">Contact</a></li>
            <li><a href="/forum">Forum</a></li>
        </ul>
        <?php #PHP
$c = charger_rss('http://linuxfr.org/backend/~patrick_g/journal/rss20.rss', 3);
if ($c) {
    echo '<h2>News rss</h2>'."\n";
    echo $c;
}
?>
        <?php #PHP
require("membres.php"); ?>
    </div>
    <div class="bord">
        <div class="corps">
        <?php #PHP
require("actions.php"); ?>
        </div>
    </div><!--
## Pied de page : © et messages d'erreur
    -->
    <div class="pied">
        <a href="?action=copyright">Copyright</a> - <a href="?action=contacter">Contactez-nous</a>
        <a href="mailto:labulecalais@gmail.com"><img src="images/mail.png" alt="mailto" /></a>
    </div>
    <div style="text-align:center;">
        <a href="http://validator.w3.org/check?uri=referer"><img
            style="border:0; width:88px; height:31px"
            src="http://www.w3.org/Icons/valid-xhtml10"
            alt="Valid XHTML 1.0 Strict" /></a>
        <a href="http://jigsaw.w3.org/css-validator/check/referer"><img
            style="border:0; width:88px; height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
            alt="CSS Valide !" /></a>
        <?php #PHP
echo $les_erreurs; ?>
    </div>
  </div>
  </body>
</html>
