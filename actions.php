<?php
/*
 * Gestion des actions disponibles pour l'index et inclusion du corps
 */
require_once('fonctions.php');

function lien_archives() {
    global $db;
    $r  = "<table class=\"archive\">\n<tr>";
    $r .= "<th scope=\"row\">Archives :</th>\n";
    $archives = bdd_les_annees_en_archive($db);
    foreach ($archives as $a) {
        $r .= "<td><a onclick=\"demander_archives(lire_archives, $a);\">$a</a></td><td>&#x2022;</td>\n";
    }
    $r .= "<td><a href=\"index.php?page=Passé\">Retour</a></td>\n";
    return $r."</tr></table>\n";
}

if (isset($_SESSION['message'])) {
    # Messages en attente
    echo message('Avertissement : '.$_SESSION['message']);
    unset($_SESSION['message']);
}
if (strcmp($action, 'lire') and isset($_SESSION['login'])) {
    # Actions nécessitant un log-in
    switch ($action) {
    case 'modifier':
    case 'ajouter':
        require('edition.php');
        break;
    case 'maintenance':
    case 'deplacer':
        require('maintenance.php');
        break;
    case 'lister':
    case 'uploader':
    case 'listerup':
    case 'changer_mdp':
    case 'admin':
    case 'contacter':
    case 'news':
        require("actions/$action.php");
        break;
    case 'aide_html':
    case 'copyright':
        require("$action.html");
        break;
    case 'logout':  // Fermeture de la session
        $_SESSION = array();
        session_destroy();
        redirection($page);
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
        require("actions/contacter.php");
        break;
    }
} else {
    # Pas d'action : simple chargement du contenu
    if (isset($_SESSION['login'])) {
        echo lien_modifier($page);
    }
    $c = bdd_charger($db, $page);
    if ($c && is_string($c)) {
        echo $c;
        $index_bd = 1;
        if (!strcmp($page, 'Passé')) {
            echo lien_archives();
        }
        if (bdd_get($db, 'niveau', $page) == 2) {
            $filles = menu_les_fils($db, $page);
            if (count($filles) > 0) {
                # Ajouter aussi les pages filles
                echo pages_filles($filles);
            }
        }
    } else {
        echo message("Impossible de charger la page « $page ». Redirection en cours...", 2);
        redirection('Accueil', 1000);
    }
}
?>
