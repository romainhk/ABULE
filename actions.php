<?php
/*
 * Gestion des actions disponibles pour l'index et inclusion du corps
 */
require_once('fonctions.php');
if (strcmp($action, 'lire') and isset($_SESSION['login'])) {
    # Actions nécessitant un log-in
    switch ($action) {
    case 'modifier':
    case 'ajouter':
        require('admin_add_mod.php');
        break;
    case 'lister':
    case 'supprimer':
    case 'renommer':
    case 'deplacer':
        require('admin_liste_suppr.php');
        break;
    case 'logout':
        // Fermeture de la session
        $_SESSION = array();
        session_destroy();
        redirection($page);
        break;
    case 'uploader':
    case 'changer_mdp':
    case 'admin':
    case 'contacter':
    case 'news':
        require("$action.php");
        break;
    case 'listerup':
        require('browser.php');
        break;
    case 'aide_html':
    case 'copyright':
        require("$action.html");
        break;
    default:
        break;
    }
} else if (strcmp($action, 'lire')) {
    # Actions aussi possible sans besoin d'être loggé
    switch ($action) {
    case 'copyright':
        require("copyright.html");
        break;
    case 'contacter':
        require("contacter.php");
        break;
    }
} else {
    # Pas d'action : simple chargement du contenu
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['login'])) {
        echo "<div class=\"modifier\"><a href=\"?page=$page&action=deplacer\">Déplacer</a><br />";
        echo "<a href=\"?page=$page&action=modifier\">Modifier</a></div>\n";
    }
    $c = bdd_charger($db, $page);
    if ($c) {
        echo $c;
    } else {
        echo "<p>Impossible de charger la page « $page ». Redirection en cours...</p>\n";
        redirection('Accueil', 500);
    }
}
?>
