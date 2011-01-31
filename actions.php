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
        require("$action.php");
        break;
    case 'aide_html':
    case 'copyright':
        require("$action.html");
        break;
    case 'listerup':
        require('browser.php');
        break;
    default:
        break;
    }
} else if (!strcmp($action, 'copyright')) {
    # Pages sans besoin d'être loggé
    require("copyright.html");
} else {
    # Pas d'action : simple chargement du contenu
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['login'])) {
        echo "<span class=\"modifier\"><a href=\"?page=$page&action=modifier\">Modifier</a></span>\n";
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
