<?php
/*
 * Gestion des actions disponibles pour l'index et inclusion du corps
 */
if (strcmp($action, 'lire') and isset($_SESSION['login'])) {
    switch ($action) {
    case 'modifier':
    case 'ajouter':
        require('admin_add_mod.php');
        break;
    case 'lister':
    case 'supprimer':
        require('admin_liste_suppr.php');
        break;
    case 'logout':
        // Fermeture de la session
        $_SESSION = array();
        session_destroy();
        echo '<script language="javascript">setTimeout("document.location.href=\'?page='.$page.'\'", 1);</script>';
        break;
    default:
        break;
    }
} else {
    # Pas d'action : simple chargement du contenu
    if (isset($_SESSION['login'])) {
        echo "<span class=\"modifier\"><a href=\"?page=$page&action=modifier\">Modifier</a></span>\n";
    }
    $c = bdd_charger($db, $page);
    if ($c) {
        echo $c;
    } else {
        echo "<p>Impossible de charger la page « $page ». Redirection en cours...</p>\n";
        echo '<script language="javascript">setTimeout("document.location.href=\'?page=Accueil\'", 500);</script>';
    }
}
?>