<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<?php
//header('Content-type: text/html; charset=utf-8');
/*
 * BDD
 */
$mycnf = parse_ini_file("mycnf");
$db = mysql_connect($mycnf['host'], $mycnf['user'], $mycnf['password']);
if (!$db) {
    die('Imposible de se connecter à la base : ' . mysql_error($db));
}
mysql_select_db('site_abule', $db);
mysql_query('SET NAMES UTF8', $db);

require('fonctions.php');

/*
 * Passage de paramètres GET
 */
$page = 'index';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

//TODO inclure un menu.php ici qui génèrera le menu

/* 
 * Sélection des feuilles de style à utiliser
 * Messages d'avertissements
 */
$avertissements = array(); //Avertissements/Erreurs à reporter à l'usager
//TODO un tableau de styles ?
$browser = get_browser($_SERVER["HTTP_USER_AGENT"], FALSE);
if ($browser->cssversion > 2) {
    $styleprime = "style3";
} else {
    $styleprime = "style2";
    if ($browser->cssversion <= 1) {
        array_push($avertissements, 
            "Votre navigateur web (".$browser->browser.'-'.$browser->version.") est trop ancien.");
    }
}
if (!$browser->javascript) {
    array_push($avertissements, 
        "Le javascript n'est pas activé ; certains éléments ne s'afficheront mal/pas.");
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
  <head>
    <title>L´ABULE<?php if(strcmp($page, 'index')) echo " · $page"; ?></title>
    <meta http-equiv="Content-language" content="fr" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="Author" content="Steeve et Romain" />
    <meta name="Copyright" content="L'ABULE" />
    <meta name="Description" content="Site de l'ABULE, association de biologie de l'université du littoral pour l'écologie" />
    <meta name="Keywords" lang="fr" content="association, biologie, calais, écologie, université" />
    <meta name="Keywords" lang="en" content="association, biology, calais, ecology, university" />
    <meta name="Rev" content="labulecalais@gmail.com" />
    <meta name="Revisit-after" content="17 days" />
    <meta name="Robots" content="all, follow, index" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/<?php echo $styleprime; ?>.css" />
    <link rel="stylesheet" type="text/css" href="css/lightbox.css" media="screen" />
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
    </div>
    <div class="menu" style="float:left;">
		<span style="height:180px;display:block;"></span>
        <h2><a href="?page=index">Accueil</a></h2>
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
        <h2><a href="?page=Admin">Admin</a></h2><!-- A n'afficher que si une session ouverte -->
    </div>
    <div class="menu" style="float:right;">
		<span style="height:43px;display:block;"></span>
        <div style="margin:1ex auto; width:140px; height:150px;">
            <object type="application/x-shockwave-flash" data="http://www.clocklink.com/clocks/0018b-green.swf?TimeZone=France_Paris" width="140" height="150">
            <param name="wmode" value="transparent" />
            </object>
        </div>
        <span id="horloge"></span>
        <ul>
            <li><a href="">Contact</a></li>
            <li><a href="">Forum</a></li>
            <li><a href="">News rss</a></li>
        </ul>
    </div>
    <div class="bord">
        <div class="corps">
<?php 
# Contenu
$c = bdd_charger($db, $page);
if ($c) echo $c;
?>
        </div>
    </div>
    <div class="pied">
        <a href="">Copyright</a> - "Contactez-nous" : labulecalais@gmail.com
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
    </div>
    <?php
# Messages d'erreur
//TODO faire une vrai mise en page (icone que l'on survole pour voir le mess ?)
if (count($avertissements)>0) {
    echo '<ul class="avertissement">';
    foreach ($avertissements as $a) {
        echo "\t<li>$a</li>\n";
    }
    echo "</ul>";
}
    ?>
  </div>
  </body>
</html>
