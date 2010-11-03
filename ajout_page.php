<?php
/*
 * Traitement du formulaire d'ajout de page
 */
require_once('db.php');
require('fonctions.php');

if (isset($_POST['nom']) and strcmp($_POST['nom'], '')) {
    $nom = $_POST['nom'];
} else {
    echo "Nom de page inconnu<br/>\n";
    break;
}
$contenu = "";
if (isset($_POST['contenu'])) {
    $contenu = $_POST['contenu'];
}

$req = 'SELECT COUNT(nom) FROM page WHERE nom="'.$nom.'"';
$ret = mysql_query($req, $db);
if ($ret) {
    $f = mysql_fetch_row($ret);
    if ($f[0] == 0) {
        echo "Ajout de la page $nom avec : ".htmlentities($contenu).".<br/>\n";
        bdd_sauvegarder($db, $nom, $contenu);
    } else {
        echo "La page existe déjà<br/>\n";
        break;
    }
} else {
    echo "Problème lors de l'ajout<br/>\n";
    break;
}

echo "L'ajout s'est bien passé<br/>\n";
?>
