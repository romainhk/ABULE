<?php
/*
 * Gestion des actions disponibles pour l'index et inclusion du corps
 */
require_once('fonctions.php');

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
    if (isset($_SESSION['login'])) {
        echo lien_modifier($page);
    }
    $c = bdd_charger($db, $page);
    if (is_string($c)) {
        echo $c;
        if (bdd_get($db, 'niveau', $page) == 2) {
            $filles = menu_les_fils($db, $page);
            if (count($filles) > 0) {
                # Ajouter aussi les pages filles
                $index = 1;
                foreach ($filles as $f) {
                    $nom = stripslashes($f['nom']);
                    $d = bdd_charger($db, $nom);
                    if (is_string($d)) {
                        echo '<div class="boite" id="boite_'.$index.'"><div class="boite_titre">'.$nom.'</div><div class="boite_contenu" id="contenu_'.$index.'">';
                        if (isset($_SESSION['login'])) {
                            echo lien_modifier($nom);
                        }
                        echo $d.'</div></div>'."\n";
                        $index++;
                    } else {
                        echo message("Impossible de charger la sous-page « $page »");
                    }
                }
            }
        }
    } else {
        echo message("Impossible de charger la page « $page ». Redirection en cours...");
        redirection('Accueil', 500);
    }
}
?>
