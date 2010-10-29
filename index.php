<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<?php
# BDD
$mycnf = parse_ini_file("mycnf");
$db = mysql_connect($mycnf['host'], $mycnf['user'], $mycnf['password']);
if (!$db) {
    die('Imposible de se connecter : ' . mysql_error($db));
}
mysql_select_db('site_abule', $db);

function sauvegarder($nom, $contenu) {
    /* Ajoute une page dans la BDD */
    $req = 'INSERT INTO page (nom, contenu) VALUES ("'+$nom+'", "'+$contenu+'")';
    $ret = mysql_query($req, $db)
        or die("<br/>Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    //TODO update, valeur de retour
}

function charger($nom) {
    /* Récupérer une page depuis la BDD */
    //TODO sql, affichage
}

/* Choix des feuilles de style à utiliser
 */
$browser = get_browser(NULL, FALSE);
if ($browser->cssversion > 2) {
    $styleprime = "style3";
} else {
    //TODO créer style2
    $styleprime = "style2";
    if ($browser->cssversion <= 1) {
        echo "Votre navigateur web est trop ancien";
    }
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
  <head>
    <title>L´ABULE</title>
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
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $styleprime; ?>.css" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <script src="javascript.js" type="text/javascript"></script>
  </head>

  <body onLoad="horloge()">
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
        <h2><a href="index.html">Accueil</a></h2>
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
        <h2><a href="">Liens</a></h2>
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
            <!-- Injecter le contenu de la base à partir d'ici -->
            <h1>Présentation de l´Association</h1>
            <p>L´ABULE est une association étudiante qui a pour objectif d´animer
            les départements de Biologie, Géologie et Environnement de l´Université
            du Littoral. ses membres cherchent également à promouvoir des actions écologiques
            visant à sensibiliser le public et tous les acteurs de l´université.</p>
            <p>Plus concrétement, l´ABULE c´est aussi plusieurs projets :</p>
            <ul>
                <li>Journée d´intégration, soirées à thème, sorties, ...</li>
                <li>Aides aux étudiants : bourse aux livres, réseau d´anciens
                étudiants, photocopies, ...</li>
                <li>Conférences / expositions / sorties sur l´écologie</li>
                <li>Collectes, rédactions de tracts, actions de
                sensibilisation, projets, ... pour l´environnement</li>
            </ul>
            <p>
            <img src="images/imagetest.jpg" alt="imagedetest" />
            Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
            <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
            <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.</p>
            <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>
            <p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        </div>
    </div>
    <div class="pied">
        Copyright - "Contactez-nous" : labulecalais@gmail.com
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
  </div>
  </body>
</html>
