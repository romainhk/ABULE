<?php
/*
 * Lister et sélectionner un fichier binaire
 */
header('Content-Type: text/json'); 

$les_fichiers = array();
foreach (scandir('uploads/') as $sd) {
    if (!preg_match('/^\./', $sd) and !preg_match('/^index/', $sd)) {
        array_push($les_fichiers, $sd);
    }
}

echo json_encode($les_fichiers);
?>
