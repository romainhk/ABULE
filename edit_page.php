<?php
/*
 * Traitement du formulaire d'ajout/de modification d'une page
 */
//TODO faire pour que les valeurs de retour "fonctionnent", s'affichent à la place de la page d'origine (ajax ?)
require_once('db.php');
require_once('fonctions.php');

# Paramètres
if (isset($_POST['nom']) and strcmp($_POST['nom'], '')) {
    $nom = $_POST['nom'];
} else {
    die("Nom de page inconnu");
}
$contenu = "";
if (isset($_POST['contenu'])) {
    $contenu = $_POST['contenu'];
}
$pere = "";
if (isset($_POST['pere'])) {
    $pere = $_POST['pere'];
}
$ordre = "";
if (isset($_POST['ordre'])) {
    $ordre = $_POST['ordre'];
}
$forcer = False;
if (isset($_POST['modifier'])) {
    $forcer = True;
}

# Traitement
$req = 'SELECT COUNT(nom) FROM page WHERE nom="'.$nom.'"';
$ret = mysql_query($req, $db);
if ($ret) {
    $f = mysql_fetch_row($ret);
    if ($f[0] == 0 or $forcer) {
        // Liens lightbox
        $contenu = preg_replace('/(<a href=\"[^>]+) rel=\"lightbox\"(>\s*<img )/', '$1$2', $contenu);
        $contenu = preg_replace('/(<a href=\"[^>]+)(>\s*<img )/', '$1 rel="lightbox"$2', $contenu);

        echo "Ajout de la page $nom avec : ".htmlentities($contenu).".<br/>\n";
        $r = bdd_sauvegarder($db, $nom, $pere, $ordre, $contenu, $forcer);
        if ($r) {
            die($r);
        }
    } else {
        die("La page existe déjà");
    }
} else {
    die("Problème lors de l'ajout");
}

# L'ajout s'est bien passé
redirection($nom, 100);
?>
