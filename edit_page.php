<?php
/*
 * Traitement du formulaire d'ajout/de modification d'une page
 */
require_once('db.php');
require_once('fonctions.php');

session_start();
# Paramètres
if (isset($_POST['nom']) and strcmp($_POST['nom'], '')) {
    $nom = stripslashes(urldecode($_POST['nom']));
} else {
    $_SESSION['message'] = "Nom de page inconnu";
    redirection('Accueil', 1);
    exit(1);
}
$contenu = "";
if (isset($_POST['contenu'])) {
    $contenu = $_POST['contenu'];
}
$pere = "";
if (isset($_POST['pere'])) {
    $pere = stripslashes(urldecode($_POST['pere']));
}
$ordre = "";
if (isset($_POST['ordre'])) {
    $ordre = intval($_POST['ordre']);
    if (!is_int($ordre) or $ordre > 100 or $ordre < 1) {
        $ordre = 1;
    }
}
$forcer = False;
if (isset($_POST['modifier'])) {
    $forcer = True;
}

# Traitement
$contenu = preg_replace('/(<a href=\"[^>]+) rel=\"lightbox\"(>\s*<img )/', '$1$2', $contenu);
$contenu = preg_replace('/(<a href=\"[^>]+)(>\s*<img )/', '$1 rel="lightbox"$2', $contenu);
$r = bdd_sauvegarder($db, $nom, $pere, $ordre, $contenu, $forcer);
if ($r) {
    $_SESSION['message'] = $r;
}

redirection($nom, 1);
?>
<html>
<body style="background-color:#85af43;"></body>
</html>
