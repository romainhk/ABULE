<?php
/*
 * Fonction d'accès sur la BDD
 */
function sauvegarder($db, $nom, $contenu) {
    /* Ajoute une page dans la BDD */
    $req = 'INSERT INTO page (nom, contenu) VALUES ("'.$nom.'", "'.$contenu.'")';
    $ret = mysql_query($req, $db);
    if (!$ret) {
        if (mysql_errno($db) == 1062) { # la page existe dégà
            modifier($db, $nom, $contenu);
        } else {
            return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db);
        }
    }
    return FALSE;
}

function modifier($db, $nom, $contenu) {
    /* Modifier une page dans la BDD */
    $req = 'UPDATE page SET contenu="'.$contenu.'" WHERE nom="'.$nom.'"';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
}

function charger($db, $nom) {
    /* Récupérer une page depuis la BDD */
    $req = 'SELECT contenu FROM page WHERE nom="'.$nom.'"';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    $f = mysql_fetch_row($ret);
    if (isset($f[0])) {
        return $f[0];
    } else {
        return FALSE;
    }
}
?>
