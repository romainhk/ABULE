<?php
/*
 * ### Lister upload
 * Lister les fichiers présent sur le serveur
 */
$les_fichiers = array();
$dossier_up = 'uploads/';
foreach (scandir($dossier_up) as $sd) {
    if (!preg_match('/^\./', $sd) and !preg_match('/.html$/', $sd)) {
        array_push($les_fichiers, $sd);
    }
}

if (isset($_POST['json']) and $_POST['json']=='ok') {
    // Browser léger en ajax (intégré à l'éditeur)
    header('Content-Type: text/json'); 

    echo json_encode($les_fichiers);
} else {
    // Browser complet
    echo '<h1>Fichiers uploadés sur le serveur</h1><ul>';
    foreach ($les_fichiers as $lf) {
        echo "<li>$dossier_up<a href=\"$dossier_up$lf\">$lf</a></li>";
    }
    echo '</ul>';
}
?>
