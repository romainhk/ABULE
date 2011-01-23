<?php
if (!file_exists('uploads/menu.html')) {
    require_once('db.php');
    // TODO générer le menu
    generer_menu($db);
}
require('uploads/menu.html');

if (isset($_SESSION['login'])) {
    echo '<h2>Admin</h2>';
    echo '<ul><li><a href="?page=\&action=lister">Liste des pages</a></li>';
    echo '<li><a href="?page=\&action=ajouter">Ajouter</a></li>';
    echo '<li><a href="?page=\&action=supprimer">Supprimer</a></li>';
    echo '<li><a href="?page=\&action=uploader">Upload</a></li>';
    echo '<li><a href="?page=\&action=listup">Liste des fichiers</a></li></ul>';
}
?>
