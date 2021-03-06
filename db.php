<?php
/*
 * Connexion à la base de données
 */
$les_champs = array( 'niveau', 'ordre', 'contenu' );   // Les champs accessibles de la table "page"
$mycnf = parse_ini_file("../mycnf");
$db = mysql_connect($mycnf['host'], $mycnf['user'], $mycnf['password']);
unset($mycnf);
if (!$db) {
    die('Imposible de se connecter à la base : '.mysql_error($db));
}

mysql_select_db('labulefr_site', $db);
mysql_query('SET NAMES UTF8', $db);

/*
 * Fonction d'accès à la BDD     #######################
 */
// Ajoute une page dans la BDD
function bdd_sauvegarder($db, $nom, $pere, $ordre, $contenu, $forcer=FALSE) {
    // $forcer permet de forcer la mise à jour si la page existe déjà
    $contenu = preg_replace("/<?php.*?>/", '', $contenu);
    $san_contenu = htmlspecialchars($contenu);
    if (!empty($pere)) {
        $niveau = bdd_get($db, 'niveau', $pere) + 1;
    } else {
        $niveau = 1;
    }

    $req = 'INSERT INTO page (nom, niveau, ordre, contenu) VALUES ("'.addslashes($nom).'", '.$niveau.', '.$ordre.', "'.$san_contenu.'")';
    $ret = mysql_query($req, $db);
    if (!$ret) {
        if (mysql_errno($db) == 1062 and $forcer) {
            $s = bdd_modifier($db, $nom, $pere, $niveau, $ordre, $san_contenu);
            if ($s) { return $s; }
        } else {
            if (!$forcer) { # la page existe dégà
                return "La page «".$nom."» existe déjà. Ajout interrompu";
            } else {
                return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db);
            }
        }
    } else {
        bdd_logger($db, 'Ajout de : '.$nom);
        if ($niveau > 1) {
            menu_modifier_fils($db, $pere, $nom, 'ajouter');
        }
        menu_regenerer($db);
    }
    return FALSE;
}

// Modifier une page dans la BDD
function bdd_modifier($db, $nom, $pere, $niveau, $ordre, $contenu) {
    $req = 'UPDATE page SET contenu="'.$contenu.'", niveau='.$niveau.', ordre='.$ordre.' WHERE nom="'.addslashes($nom).'"';
    $ret = mysql_query($req, $db);
    if (!$ret) {
       return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db);
    }
    bdd_logger($db, 'Modification de : '.$nom);
    menu_modifier_fils($db, menu_pere($db, $nom), $nom, 'retirer');
    menu_modifier_fils($db, $pere,                $nom, 'ajouter');
    menu_regenerer($db);
    return FALSE;
}

// Récupérer une page depuis la BDD
function bdd_charger($db, $nom) {
    $get = bdd_get($db, 'contenu', $nom);
    return htmlspecialchars_decode($get);
}

// Supprimer une page
function bdd_supprimer($db, $nom) {
    if (strcmp($nom, '')) {
        if (bdd_get($db, 'niveau', $nom)) { # On vérifie que la page existe
            $req = 'DELETE FROM page WHERE nom="'.addslashes($nom).'"';
            $ret = mysql_query($req, $db)
               or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
            bdd_logger($db, 'Suppression de : '.$nom);
            menu_modifier_fils($db, menu_pere($db, $nom), $nom, 'retirer');
            menu_regenerer($db);
            return FALSE;
        } else {
            return "Impossible de supprimer la page $nom";
        }
    } else return "Aucune page sélectionnée";
}

// Renommer une page
function bdd_renommer($db, $page, $nouv) {
    $req = 'UPDATE page SET nom="'.addslashes($nouv).'" WHERE nom="'.addslashes($page).'"';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    bdd_logger($db, 'Renommage de "'.$page.'" en : '.$nouv);
    // Remplacement par le nouveau père
    $pere = menu_pere($db, $page);
    if (!empty($pere)) {
        menu_modifier_fils($db, $pere, $page, 'retirer');
        menu_modifier_fils($db, $pere, $nouv, 'ajouter');
    }
    // Renommage pour les fils aussi
    $lf = menu_les_fils($db, $page);
    while ($f = array_pop($lf)) {
        menu_modifier_fils($db, $page, $f['nom'], 'retirer');
        menu_modifier_fils($db, $nouv, $f['nom'], 'ajouter');
    }
    menu_regenerer($db);
}

// Déplacer une page
function bdd_deplacer($db, $page, $nvpere, $ordre) {
    $niveau = bdd_get($db, 'niveau', $nvpere) + 1;
    if ($niveau > 0 && $niveau < 4) {
        $req = 'UPDATE page SET niveau='.$niveau.', ordre='.$ordre.' WHERE nom="'.addslashes($page).'"';
        $ret = mysql_query($req, $db)
           or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
        bdd_logger($db, 'Déplacement de "'.$page.'" sous : '.$nvpere);
        $pere = menu_pere($db, $page);
        menu_modifier_fils($db, $pere,   $page, 'retirer');
        menu_modifier_fils($db, $nvpere, $page, 'ajouter');
        menu_regenerer($db);
    }
}

// Archiver une page
function bdd_archiver($db, $nom, $annee) {
    if (bdd_get($db, 'niveau', $nom)) {
        $contenu = bdd_charger($db, $nom);
        $req = 'INSERT INTO archives (nom, annee, contenu) VALUES ("'.addslashes($nom).'", '.$annee.', "'.$contenu.'")';
        $ret = mysql_query($req, $db);
        if (!$ret) { return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db); }
        $ret = bdd_supprimer($db, $nom);
        if ($ret) { return $ret; }
        bdd_logger($db, 'Archivage de "'.$nom.'" ('.$annee.')');
        menu_modifier_fils($db, menu_pere($db, $nom), $nom, 'retirer');
        menu_regenerer($db);
    } else {
        return 'Page "'.$nom.'" inexistante';
    }
    return FALSE;
}

// Donne les archives
function bdd_les_archives($db, $annee=0) {
    $arch = array();
    $where = '';
    if ($annee != 0) { $where = "WHERE annee=$annee"; }
    $req = "SELECT nom, annee, contenu FROM archives $where ORDER BY annee";
    $ret = mysql_query($req, $db);
    while ($row = mysql_fetch_array($ret)) {
        array_push($arch, array('nom' => $row['nom'], 'annee' => $row['annee'], 'contenu' => $row['contenu']));
    }
    return $arch;
}
// Donne les annees présentes dans les archives
function bdd_les_annees_en_archive($db) {
    $arch = array();
    $req = "SELECT DISTINCT annee FROM archives ORDER BY annee";
    $ret = mysql_query($req, $db);
    while ($row = mysql_fetch_row($ret)) {
        array_push($arch, $row[0]);
    }
    return $arch;
}

// Récupérer les infos d'une page
function bdd_get($db, $champ, $nom) {
    global $les_champs;
    if (in_array($champ, $les_champs)) {
        $req = 'SELECT '.$champ.' FROM page WHERE nom="'.addslashes($nom).'"';
        $ret = mysql_query($req, $db)
           or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
        $f = mysql_fetch_row($ret);
        if (isset($f[0])) {
            return $f[0];
        }
    }
    return FALSE;
}

// Liste des fils d'une page
function menu_les_fils($db, $page) {
    $fils = array();
    $req = 'SELECT fils, niveau, ordre FROM parente as p, page WHERE page="'.addslashes($page).'" AND p.fils=page.nom ORDER BY ordre ASC';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    while ($row = mysql_fetch_array($ret)) {
        array_push($fils, array('nom' => $row['fils'], 'niveau' => $row['niveau'], 'ordre' => $row['ordre']));
    }
    return $fils;
}

/*
 *  Admin et utilisateurs
 */
// Créer un nouvel utilisateur
function bdd_creer_utilisateur($db, $login, $mdp, $admin=0) {
    if ($_SESSION['admin']) {
        if ($admin != 1) { $admin = 0; }
        $req = 'INSERT INTO utilisateur (login, mdp, admin) VALUES ("'.$login.'", "'.sha1($mdp).'", "'.$admin.'")';
        $ret = mysql_query($req, $db);
        if ($ret) {
            if ($admin) { $mode = "Administrateur ";
            } else {      $mode = "Utilisateur "; }
            return $mode.$login." créé";
            bdd_logger($db, 'Création du compte '.strtolower($mode).' '.$login);
        } else {
            return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db);
        }
    } else { return "Création de compte interdite avec ce compte"; }
}

// Supprimer un admin
function bdd_supprimer_utilisateur($db, $login) {
    if ($_SESSION['admin']) {
        $req = 'DELETE FROM utilisateur WHERE login="'.$login.'"';
        $ret = mysql_query($req, $db);
        if ($ret) {
            return "Utilisateur ".$login." supprimé";
            bdd_logger($db, 'Suppression du compte '.$login);
        } else {
            return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db);
        }
    } else { return "Suppression de compte interdite avec ce compte"; }
}

// Liste des admins
function bdd_liste_utilisateur($db) {
    $req = 'SELECT login FROM utilisateur';
    $ret = mysql_query($req, $db);
    if ($ret) {
        $r = array();
        while($row = mysql_fetch_array($ret)) {
            array_push($r, $row['login']);
        }
        return $r;
    } else {
        return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db);
    }
}

// Permet à un admin de changer son mot de passe
function bdd_changer_mdp($db, $login, $mdp) {
    $req = 'UPDATE utilisateur SET mdp="'.sha1($mdp).'" WHERE login="'.$login.'"';
    $ret = mysql_query($req, $db);
    if ($ret) {
        bdd_logger($db, $login.' a modifié son mot de passe');
        return '';
    } else {
        return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db);
    }
}

/*  Journal
 */
// Enregistre l'opération au journal
function bdd_logger($db, $message) {
    session_start();
    $req = 'INSERT INTO log (login, message) VALUES ("'.$_SESSION['login'].'", "'.addslashes($message).'")';
    $ret = mysql_query($req, $db);
    return $ret;
}

// Journal des modifications récentes
function bdd_journal($db, $nb=10) {
    $r = array();
    $req = 'SELECT * FROM log ORDER BY id DESC LIMIT 0,'.$nb;
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    while($row = mysql_fetch_array($ret)) {
        array_push($r, $row);
    }
    return $r;
}

/*
 * Gestion du Menu     #######################
 */
// Mettre à jour le menu.html
function menu_regenerer($db) {
    $elems = array();
    $req = 'SELECT page.nom, page.ordre, f.ordre as ordfils, p.fils as fils FROM page'
        .' LEFT JOIN parente as p ON p.page=page.nom LEFT JOIN page as f'
        .' ON f.nom=p.fils WHERE page.niveau=1 ORDER BY page.ordre, f.ordre';
    $ret = mysql_query($req, $db)
        or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));

    $menu = '';
    while ($row = mysql_fetch_assoc($ret)) {
        $nom = $row['nom'];
        if (!in_array($nom, $elems)) {
            if (count($elems) > 0) {
                $menu .= "</ul>\n";
            }
            array_push($elems, $nom);
            $menu .= '<h2><a href="?page='.protect_url($nom).'">'.$nom."</a></h2>\n<ul>";
        }
        $fils = $row['fils'];
        $menu .= '<li><a href="?page='.protect_url($fils).'">'.$fils."</a></li>\n";
    }
    $menu .= "</ul>";

    // Écriture
    $fmenu = fopen('uploads/menu.html', 'w');
    fputs($fmenu, $menu);
    fclose($fmenu);
}

// Donne le père d'une page
function menu_pere($db, $page) {
    $req = 'SELECT page FROM parente WHERE fils LIKE "%'.addslashes($page).'%" ESCAPE "\\\\"';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    $f = mysql_fetch_row($ret);
    if (isset($f[0])) {
        return $f[0];
    } else {
        return '';
    }
}

// Liste des éléments pères du menu
function menu_les_peres($db, $niveaux) {
    $peres = array();
    $niveau = 'niveau='.array_pop($niveaux);
    foreach ($niveaux as $n) {
        $niveau = $niveau.' OR niveau='.$n;
    }
    $req = 'SELECT nom, ordre, niveau FROM page WHERE '.$niveau.' ORDER BY ordre ASC';
    $ret = mysql_query($req, $db)
       or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    while ($row = mysql_fetch_array($ret)) {
        $pair = array('nom' => $row['nom'], 'niveau' => $row['niveau'], 'ordre' => $row['ordre']);
        array_push($peres, $pair);
    }
    return $peres;
}

// Donne une liste ordonnée des pages
function menu_ordonne($db, $peres, $niveau) {
    if ((!isset($peres) or empty($peres)) && $niveau == 1) {
        $peres = menu_les_peres($db, array(1));
    }
    $rep = array();
    foreach ($peres as $l) {
        array_push($rep, array('nom' => $l['nom'], 'niveau' => $l['niveau'], 'ordre' => $l['ordre']));
        if ($niveau < 3) {
            foreach (menu_ordonne($db, menu_les_fils($db, $l['nom']), $niveau+1) as $m) {
                array_push($rep, $m);
            }
        }
    }
    return $rep;
}

// Ajoute/retire la page au pere
function menu_modifier_fils($db, $pere, $page, $modif='ajouter') {
    #echo $pere."****".$page.'----'.$modif.'<br/>';
    if (!empty($pere)) {
        switch($modif) {
        case 'ajouter':
            $req = 'INSERT INTO parente(page, fils) VALUES ("'.addslashes($pere).'", "'.addslashes($page).'")';
            break;
        case 'retirer':
            $req = 'DELETE FROM parente WHERE page="'.addslashes($pere).'" AND fils="'.addslashes($page).'"';
            break;
        }
        $ret = mysql_query($req, $db)
           or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
    }
}
?>
