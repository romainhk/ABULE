<?php
/*
 * Connexion à la base de données
 */
define("MENU_JOCKER", ";;");	// Séparateur utilisé dans la colonne page.fils
define("MENU_SEUL", "***");	    // Indicateur utilisé dans la colonne page.fils pour dire qu'un père n'a pas de fils
$les_champs = array( 'fils', 'ordre', 'contenu' );   // Les champs accessibles de la table "page"
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
function bdd_sauvegarder($db, $nom, $pere, $ordre, $contenu, $forcer=FALSE) {
    // $forcer permet de forcer la mise à jour si la page existe déjà
    $contenu = preg_replace("/<?php.*?>/", '', $contenu);
    $san_contenu = htmlspecialchars($contenu);

    if (strcmp($pere, MENU_SEUL)) {
        $fils = 'NULL';
    } else { 
        $fils = '"'.MENU_SEUL.'"';
    }
    $req = 'INSERT INTO page (nom, fils, ordre, contenu) VALUES ("'.$nom.'", '.$fils.', "'.$ordre.'", "'.$san_contenu.'")';
    $ret = mysql_query($req, $db);
    if (!$ret) {
        if (mysql_errno($db) == 1062 and $forcer) { # la page existe dégà
            bdd_modifier($db, $nom, $pere, $fils, $ordre, $san_contenu);
        } else {
            return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db);
        }
    } else {
        menu_modifier_fils($db, $pere, $nom, 'ajouter');
        menu_regenerer($db);
    }
    return FALSE;
}

// Modifier une page dans la BDD
function bdd_modifier($db, $nom, $pere, $fils, $ordre, $contenu) {
    menu_modifier_fils($db, menu_pere($db, $nom), $nom, 'retirer');
    $req = 'UPDATE page SET contenu="'.$contenu.'", fils='.$fils.', ordre="'.$ordre.'" WHERE nom="'.$nom.'"';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    menu_modifier_fils($db, $pere, $nom, 'ajouter');
    menu_regenerer($db);
}

// Récupérer une page depuis la BDD
function bdd_charger($db, $nom) {
    $get = bdd_get($db, 'contenu', $nom);
    return htmlspecialchars_decode($get);
}

// Donne la liste des pages connues
function bdd_lister($db) {
    $r = array();
    $req = 'SELECT nom, fils, ordre FROM page ORDER BY ordre';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    while($row = mysql_fetch_array($ret)) {
        array_push($r, $row);
    }
    return $r;
}

// Supprime une page
function bdd_supprimer($db, $nom) {
    if (strcmp($nom, '')) {
        $req = 'DELETE FROM page WHERE nom="'.$nom.'"';
        $ret = mysql_query($req, $db)
           or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
        menu_modifier_fils($db, menu_pere($db, $nom), $nom, 'retirer');
        menu_regenerer($db);
    } else die("Aucune page sélectionnée");
}

// Renommer une page
function bdd_renommer($db, $page, $nouv) {
    $req = 'UPDATE page SET nom="'.$nouv.'" WHERE nom="'.$page.'"';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    // Changer les parentés aussi
    $pere = menu_pere($db, $page);
    if (!empty($pere)) {
        menu_modifier_fils($db, $pere, $page, 'retirer');
        menu_modifier_fils($db, $pere, $nouv, 'ajouter');
        menu_regenerer($db);
    }
}

// Récupérer les infos d'une page
function bdd_get($db, $champ, $nom) {
    global $les_champs;
    if (in_array($champ, $les_champs)) {
        $req = 'SELECT '.$champ.' FROM page WHERE nom="'.$nom.'"';
        $ret = mysql_query($req, $db)
           or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
        $f = mysql_fetch_row($ret);
        if (isset($f[0])) {
            return $f[0];
        } else {
            return FALSE;
        }
    }
}

// Permet à un admin de changer son mot de passe
function bdd_changer_mdp($db, $login, $mdp) {
    $req = 'UPDATE utilisateurs SET mdp="'.$mdp.'" WHERE login="'.$login.'"';
    $ret = mysql_query($req, $db);
    if ($ret) {
        return '';
    } else {
        return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db);
    }
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
function menu_regenerer($db) {
    $elems = array();
    $les_peres = menu_les_peres($db);
    $req = 'SELECT nom, fils, ordre FROM page ORDER BY nom, ordre';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    while ($row = mysql_fetch_assoc($ret)) {
        $elems[$row['nom']] = explode(MENU_JOCKER, $row['fils']);
    }
    $menu = '';
    foreach (menu_ordonne($db, $les_peres) as $lp) {
        if (strcmp($elems[$lp][0], MENU_SEUL)) {
            $menu .= '<h2>'.$lp."</h2>\n<ul>";
            foreach (menu_ordonne($db, $elems[$lp]) as $fs) {
                $menu .= '<li><a href="?page='.strtr($fs, " ", "_").'">'.$fs."</a></li>\n";
            }
            $menu .= "</ul>\n";
        } else {
            $menu .= '<h2><a href="?page='.strtr($lp, " ", "_").'">'.$lp."</a></h2>\n";
        }
    }

    // Écriture
    $fmenu = fopen('uploads/menu.html', 'w');
    fputs($fmenu, $menu);
    fclose($fmenu);
}

// Tri les éléments de menu donnés selon leur ordre
function menu_ordonne($db, $tab) {
    $rep = array();
    foreach ($tab as $t) {
        $ord = bdd_get($db, 'ordre', $t);
        if ($ord > 0) {
            $rep[$ord] = $t;
        }
    }
    if (ksort($rep)) {
        return $rep;
    } else {
        echo "Erreur : tri de ".print_r($tmp);
        return array();
    }
}

// Donne le père d'une page
function menu_pere($db, $page) {
    $req = 'SELECT nom FROM page WHERE fils LIKE "%'.$page.'%"';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    $f = mysql_fetch_row($ret);
    if (isset($f[0])) {
        return $f[0];
    } else {
        return '';
    }
}

// Ajoute/retire la page au pere
function menu_modifier_fils($db, $pere, $page, $modif='ajouter') {
    $les_fils = bdd_get($db, 'fils', $pere);
    if (isset($les_fils)) {
        $set = explode(MENU_JOCKER, $les_fils);
        switch($modif) {
        case 'ajouter':
            if ( !strcmp($set[0], MENU_SEUL) || !strcmp($set[0], 'NULL') ) {
                $set = $page;
            } else {
                array_push($set, $page);
#                $set = $les_fils.MENU_JOCKER.$page;
                $set = implode(MENU_JOCKER, $set);
            }
            break;
        case 'retirer':
            $set = array_diff($set, array($page));
            if (count($set) < 2) {
                if (empty($set[0])) {
                    $set = MENU_SEUL;
                } else {
                    $set = $set[0];
                }
            } else {
                $set = implode(MENU_JOCKER, $set);
            }
            break;
        }
        $req = 'UPDATE page SET fils="'.$set.'" WHERE nom="'.$pere.'"';
        $ret = mysql_query($req, $db)
           or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    } else {
    }
    return 0;
}
?>
