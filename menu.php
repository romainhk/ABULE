<?php
if (!file_exists('uploads/menu.html')) {
    require_once('db.php');
    menu_regenerer($db);
}
require('uploads/menu.html');

if (isset($_SESSION['login'])) {
    if ($_SESSION['admin'] == 1) {
        echo '<h2><a href="?page=&action=admin">Admin*</a></h2>';
    } else {
        echo '<h2>Admin</h2>'."\n";
    }
    echo '<ul>';
    echo '<li><a href="?page=&action=ajouter">Ajouter</a></li>';
    echo '<li><a href="?page=&action=supprimer">Supprimer</a></li>';
    echo '<li><a href="?page=&action=renommer">Renommer</a></li>';
    echo '<li><a href="?page=&action=archiver">Archiver</a></li>';
    echo '<li><a href="?page=&action=lister">Liste des pages</a></li>';
    echo '<li><a href="?page=&action=news">News</a></li>';
    echo '<li><a href="?page=&action=uploader">Upload</a></li>';
    echo '<li><a href="?page=&action=listerup">Liste des fichiers</a></li>';
    echo "</ul>\n";
}
?>
