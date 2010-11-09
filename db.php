<?php
/*
 * Connexion à la base de données
 */
$mycnf = parse_ini_file("mycnf");
$db = mysql_connect($mycnf['host'], $mycnf['user'], $mycnf['password']);
if (!$db) {
    die('Imposible de se connecter à la base : '.mysql_error($db));
}

mysql_select_db('site_abule', $db);
mysql_query('SET NAMES UTF8', $db);


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

// Donne la liste des pages connues
function bdd_lister($db) {
    $r = array();
    $req = 'SELECT nom FROM page';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    while($row = mysql_fetch_array($ret)) {
    //TODO tri alphabétique sans casse
       array_push($r, $row[0]);
    }
    return $r;
}

// Supprimer un page
function bdd_supprimer($db, $nom) {
    $req = 'DELETE FROM page WHERE nom="'.$nom.'"';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
}
?>
