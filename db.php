<?php
/*
 * Connexion à la base de données
 */
define("MENU_JOCKER", ";;");	// Séparateur utilisé dans la colonne page.fils
define("MENU_SEUL", "***");	    // Indicateur utilisé dans la colonne page.fils pour dire qu'un père n'a pas de fils
$mycnf = parse_ini_file("../mycnf");
$db = mysql_connect($mycnf['host'], $mycnf['user'], $mycnf['password']);
unset($mycnf);
if (!$db) {
    die('Imposible de se connecter à la base : '.mysql_error($db));
}

mysql_select_db('site_abule', $db);
mysql_query('SET NAMES UTF8', $db);

/*
 * Fonction d'accès sur la BDD     #######################
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
    // TODO : mettre à jour le menu dans la bdd
    generer_menu($db);
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

// Supprime une page
function bdd_supprimer($db, $nom) {
    if (strcmp($nom, '')) {
        $req = 'DELETE FROM page WHERE nom="'.$nom.'"';
        $ret = mysql_query($req, $db)
           or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    } else die("Aucune page sélectionnée");
    // TODO : mettre à jour le menu dans la bdd
    generer_menu($db);
}

/*
 * Gestion du Menu     #######################
 */
// Liste des éléments pères du menu
function menu_les_peres($db) {
    $pere = array();
    $req = 'SELECT nom, ordre FROM page WHERE fils IS NOT NULL ORDER BY ordre ASC';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    while ($row = mysql_fetch_array($ret)) {
        array_push($pere, $row['nom']);
    }
    return $pere;
}

// Mettre à jour le menu.html
function generer_menu($db) {
    $elems = array();
    $les_peres = menu_les_peres($db);
    $req = 'SELECT nom, fils, ordre FROM page ORDER BY nom, ordre';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    while ($row = mysql_fetch_assoc($ret)) {
        $elems[$row['nom']] = explode(MENU_JOCKER, $row['fils']);
    }
    $menu = '';
    foreach ($les_peres as $lp) {
        if (strcmp($elems[$lp][0], MENU_SEUL)) {
            $menu .= '<h2>'.$lp."</h2>\n<ul>";
            $menu .= '<ul>';
            foreach ($elems[$lp] as $fs) {
                $menu .= '<li><a href=?page="'.$fs.'">'.$fs."</a></li>\n";
            }
            $menu .= "</ul>\n";
        } else {
            $menu .= '<h2><a href="?page='.$lp.'">'.$lp."</a></h2>\n";
        }
    }
    //print_r($menu);

    // Écriture
/*
    $fmenu = fopen('menu.html', 'w');
    fputs($fmenu, $f);
    fclose($fmenu);
 */
}
?>
