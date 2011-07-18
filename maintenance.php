<?php
/* 
 * !!! Maintenance du site !!!
 * Lister, supprimer, renommer, déplacer ou archiver des articles
 */
define("JOCKER_NVPERE", "###jocker_nvpere###");

if (isset($_POST['nouveau'])) {
    if (!empty($_POST['nouveau']) and isset($_POST['page'])) {
        $page = urldecode($_POST['page']);
        $nouveau = $_POST['nouveau'];
        $liste = menu_ordonne($db, NULL, 1);
        if (!in_array($nouveau, $liste)) {
            bdd_renommer($db, $page, $nouveau);
        } else {
            echo message('Impossible de renommer : ce nom est déjà utilisé');
        }
    }
} else if (isset($_POST['deplacer']) and !empty($_POST['deplacer']) and isset($_POST['page'])) {
    if (!strcmp($_POST['deplacer'], JOCKER_NVPERE)) {
        $nvpere = "";
    } else {
        $nvpere = urldecode($_POST['deplacer']);
    }
    $page = urldecode($_POST['page']);
    $ordre  = $_POST['ordre'];
    bdd_deplacer($db, $page, $nvpere, $ordre);
} else if (isset($_POST['nom']) and !empty($_POST['nom'])) {
    bdd_supprimer($db, urldecode($_POST['nom']));
} else if (isset($_POST['nom']) and isset($_POST['annee']) and !empty($_POST['nom'])) {
    $nom   = urldecode($_POST['nom']);
    $annee = intval($_POST['annee']);
    if ($annee < 2000 || $annee > 2100) {
        $_SESSION['archivage'] = 'Année "'.$annee.'" non valide';
    } else {
        $ret = bdd_archiver($db, $nom, $annee);
        if ($ret) { $_SESSION['archivage'] = $ret; }
    }
}

/* $_SESSION
 */
if (isset($_SESSION['archivage'])) {
    echo message($_SESSION['archivage'], 1);
}
unset($_SESSION['archivage']);

echo "<h1>Maintenance</h1>\n";
// Formulaires
if (!strcmp($action, 'lister')) {
    # Lister
    echo "<p>Liste classée des pages existantes.</p>\n";
    echo '<table cellspacing="5" cellpadding="2">'."\n";
    echo "<tr><th>Nom</th><th>Ordre</th></tr>\n";
    $liste = menu_ordonne($db, NULL, 1);
    foreach ($liste as $l) {
        echo '<tr><td>'.str_repeat('&nbsp;&nbsp;&nbsp;', $l['niveau']-1);
        echo '<a href="?page='.protect_url($l['nom']).'">'.$l['nom'].'</a></td>';
        echo '<td>'.$l['ordre']."</td></tr>\n";
    }
    echo "</table>\n";
} else if (!strcmp($action, 'supprimer')) {
    # Supprimer
    echo '<form action="" method="post" onSubmit="return conf_suppr();">'."\n";
    echo "<fieldset><legend>Supprimer une page</legend>\n";
    echo '<select name="nom" size="1" onChange="abule.suppr=this.value">';
    echo '<option selected="selected" value="">...</option>'."\n";
    option_parente('', '', array(1,2,3));
    echo "</select>\n";
    echo '<input type="submit" value="Supprimer" />';
    echo "</fieldset>\n";
} else if (!strcmp($action, 'renommer')) {
    # Renommer
    echo '<form action="" method="post">'."\n";
    echo "<fieldset><legend>Renommer une page</legend>\n";
    echo '<ul><li><label for="page">Page à renommer : </label>';
    echo '<select name="page" size="1">';
    echo '<option selected="selected" value="">...</option>'."\n";
    option_parente('', '', array(1,2,3));
    echo "</select>\n";
    echo '</li><li><label for="nouveau">Nouveau nom : </label>';
    echo '<input type="text" name="nouveau" size="25" maxlength="50" />';
    echo '</li></ul>';
    echo '<div style="text-align:right;"><input type="submit" value="Renommer" /></div>';
    echo "</fieldset>\n";
} else if (!strcmp($action, 'deplacer')) {
    # Déplacer
    echo '<form action="" method="post">'."\n";
    echo "<fieldset><legend>Déplacer une page</legend>\n";
    echo '<ul><li><label for="page">Page à déplacer : « '.$page.' ».</label>';
    echo '<input type="hidden" name="page" value="'.protect_url($page).'" />';
    echo '</li><li><label for="deplacer">Nouveau père : </label>';
    echo '<select name="deplacer" size="1">';
    echo '<option value="'.JOCKER_NVPERE.'">* Nouveau pere</option>'."\n";
    option_parente(menu_pere($db, $page), $page);
    echo "</select>\n<span style=\"margin-left:5ex;\">ordre : ";
    $ordre = bdd_get($db, 'ordre', $page);
    echo '<input type="text" name="ordre" size="2" maxlength="2" value="'.$ordre.'" />';
    echo '</li></ul>';
    echo '<div style="text-align:right;"><input type="submit" value="Déplacer" /></div>';
    echo "</fieldset>\n";
} else if (!strcmp($action, 'archiver')) {
    # Archiver
    echo '<form id="archive" method="post" action="">';
    echo '<fieldset><legend>Archiver une page</legend>';
    echo '<table class="form_table"><tr>';
    echo '<td><label for="titre">Événement :</label></td>';
    echo '<td><select name="nom" size="1">';
    echo '<option selected="selected" value="">...</option>'."\n";
    option_parente('', 'Événements', array(2,3));
    echo "</select>\n</td>";
    echo '</tr><tr>';
    echo '<td><label for="annee">Année :</label></td>';
    echo '<td><input type="text" id="annee" name="annee" size="4" maxlength="4" value="'.strftime("%Y").'" /></td>';
    echo '</tr><tr>';
    echo '<td colspan="2" style="text-align:right;">';
    echo '<input type="submit" id="submit" name="submit" value="Archiver la page" /></td>';
    echo '</tr></table></fieldset>';
} else {
    echo '<p>Paramètre "'.$action.'" inconnu</p>';
}
echo '</form>';
?>
