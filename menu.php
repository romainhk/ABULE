<?php
require_once('db.php');
generer_menu($db);

if (file_exists('menu.html')) {
    //require('menu.html');
} else {
    // TODO générer le menu
}

if (isset($_SESSION['login'])) {
    echo '<h2>Admin</h2>';
    echo '<ul><li><a href="?page=\&action=lister">Liste des pages</a></li>';
    echo '<li><a href="?page=\&action=ajouter">Ajouter</a></li>';
    echo '<li><a href="?page=\&action=supprimer">Supprimer</a></li>';
    echo '<li><a href="?page=\&action=uploader">Upload</a></li>';
    echo '<li><a href="?page=\&action=listup">Liste des fichiers</a></li></ul>';
}
?>
