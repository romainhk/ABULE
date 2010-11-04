<?php
/*
 * Fonction d'accès sur la BDD
 */

// Ajoute une page dans la BDD
function bdd_sauvegarder($db, $nom, $contenu, $forcer=FALSE) {
    // $forcer permet de forcer la mise à jour si la page existe déjà
    $contenu = preg_replace("/<?php.*?>/", '', $contenu);
    $san_contenu = htmlspecialchars($contenu);

    $req = 'INSERT INTO page (nom, contenu) VALUES ("'.$nom.'", "'.$san_contenu.'")';
    $ret = mysql_query($req, $db);
    if (!$ret) {
        if (mysql_errno($db) == 1062 and $forcer) { # la page existe dégà
            bdd_modifier($db, $nom, $san_contenu);
        } else {
            return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db);
        }
    }
    return FALSE;
}

// Modifier une page dans la BDD
function bdd_modifier($db, $nom, $contenu) {
    $req = 'UPDATE page SET contenu="'.$contenu.'" WHERE nom="'.$nom.'"';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
}

// Récupérer une page depuis la BDD
function bdd_charger($db, $nom) {
    $req = 'SELECT contenu FROM page WHERE nom="'.$nom.'"';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    $f = mysql_fetch_row($ret);
    if (isset($f[0])) {
        return htmlspecialchars_decode($f[0]);
    } else {
        return FALSE;
    }
}
?>
