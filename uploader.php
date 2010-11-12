<?php
/*
 * Uploader un fichier dans la bdd
 */
require_once('db.php');

// Ajoute un fichier à la BDD
/*
function bdd_ajouter_fichier($db, $nom, $data) {
    $req = 'INSERT INTO fichier (nom, data) VALUES ("'.$nom.'", "'.$data.'")';
    $ret = mysql_query($req, $db);
    if (!$ret) {
        if (mysql_errno($db) == 1062) { # la page existe dégà
            $req = 'UPDATE fichier SET data="'.$contenu.'" WHERE nom="'.$nom.'"';
            $ret = mysql_query($req, $db)
                or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
            return $ret;
        } else {
            return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db);
        }
    }
    return FALSE;
}
 */

$upload = $_FILES['upload'];
$nom = $upload['name'];
$type = $upload['type'];
$taille = $upload['size']/1024; //ko
$tmp_name = $upload['tmp_name'];
$erreur = $upload['error'];

if ($erreur == UPLOAD_ERR_OK) {
    if (move_uploaded_file($tmp_name, getcwd().'/uploads/'.$nom)) {
        echo "Upload réussi!";
    } else {
        echo "Erreur lors de l'upload : move_uploaded_file";
    }
} else {
    echo "Erreur lors de l'upload : $erreur";
}
?>
