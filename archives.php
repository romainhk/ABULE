<?php
header("Content-Type: text/plain");
require('db.php');

$r = "<div id=\"filles\">\n";
if (isset($_GET['annee']) and !empty($_GET['annee'])) {
    $annee = $_GET['annee'];
    $archives = bdd_les_archives($db, $annee);
    $index_bd = 1;
    $r .= "<h3>Archives de l'année $annee</h3>\n";
    foreach ($archives as $a) {
        $nom   = $a['nom'];
        $cont  = $a['contenu'];
        $r .= '<div class="boite" id="boite_'.$index_bd.'"><div class="boite_titre">'.stripslashes($nom).'</div><div class="boite_contenu" id="contenu_'.$index_bd.'">';
        $r .= $cont.'</div></div>'."\n";
        $index_bd++;
    }
}
echo $r."</div>\n";
?>
