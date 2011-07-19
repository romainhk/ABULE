<?php
/*
 * Gestion des actions disponibles pour l'index et inclusion du corps
 */
require_once('fonctions.php');

function archives() { # Lire les archives
    global $db;
    echo "<h1>Archive des événements</h1>\n";
    $index = 1;
    $archives = bdd_les_archives($db);
    $lannee = 0;
    foreach ($archives as $a) {
        $nom   = $a['nom'];
        $annee = $a['annee'];
        $cont  = $a['contenu'];
        if ($annee != $lannee) { 
            echo "<h3>Annee $annee</h3>\n";
            $lannee = $annee;
        }
        echo '<div class="boite" id="boite_'.$index.'"><div class="boite_titre">'.stripslashes($nom).'</div><div class="boite_contenu" id="contenu_'.$index.'">';
        echo $cont.'</div></div>'."\n";
        $index++;
    }
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
    case 'lister':
    case 'uploader':
    case 'listerup':
    case 'changer_mdp':
    case 'admin':
    case 'contacter':
    case 'news':
        require("actions/$action.php");
        break;
    case 'maintenance':
    case 'deplacer':
        require('maintenance.php');
        break;
    case 'aide_html':
    case 'copyright':
        require("$action.html");
        break;
    case 'archives':
        archives();
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
    case 'archives':
        archives();
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
    if (is_string($c)) {
        echo $c;
        if (bdd_get($db, 'niveau', $page) == 2) {
            $filles = menu_les_fils($db, $page);
            if (count($filles) > 0) {
                # Ajouter aussi les pages filles
                $index = 1;
                foreach ($filles as $f) {
                    $nom = $f['nom'];
                    $d = bdd_charger($db, $nom);
                    if (is_string($d)) {
                        echo '<div class="boite" id="boite_'.$index.'"><div class="boite_titre">'.stripslashes($nom).'</div><div class="boite_contenu" id="contenu_'.$index.'">';
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
