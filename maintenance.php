<?php
/* 
 * !!! Maintenance du site !!!
 * Déplacer, renommer, supprimer ou archiver des articles
 */
define("JOCKER_NVPERE", "##jocker_nvpere##");
$ret = FALSE;
if (isset($_POST['page']) && !empty($_POST['page'])) {
    $page = urldecode($_POST['page']);
} else if (isset($_GET['page'])) {
    $page = stripslashes($_GET['page']);
} else {
    $page = '';
}

if (isset($_POST['renommer']) && !empty($_POST['renommer'])) {
    # Renommer
    $nouveau = $_POST['renommer'];
    $liste = menu_ordonne($db, NULL, 1);
    if (!in_array($nouveau, $liste)) {
        bdd_renommer($db, $page, $nouveau);
    } else {
        echo message('Impossible de renommer : ce nom est déjà utilisé');
    }
} else if (isset($_POST['deplacer']) and !empty($_POST['deplacer'])) {
    # Déplacer
    if (!strcmp($_POST['deplacer'], JOCKER_NVPERE)) {
        $nvpere = "";
    } else {
        $nvpere = urldecode($_POST['deplacer']);
    }
    $ordre  = $_POST['ordre'];
    $ret = bdd_deplacer($db, $page, $nvpere, $ordre);
    redirection($page);
} else if (isset($_POST['supprimer']) and !empty($_POST['supprimer'])) {
    # Supprimer
    $ret = bdd_supprimer($db, urldecode($_POST['supprimer']));
} else if (isset($_POST['archiver']) and isset($_POST['annee']) and !empty($_POST['archiver'])) {
    # Archiver
    $nom   = urldecode($_POST['archiver']);
    $annee = intval($_POST['annee']);
    if ($annee < 2000 || $annee > 2100) {
        $_SESSION['maintenance'] = 'Année "'.$annee.'" non valide';
    } else {
        $ret = bdd_archiver($db, $nom, $annee);
    }
}
if ($ret) { $_SESSION['maintenance'] = $ret; }

/* $_SESSION
 */
if (isset($_SESSION['maintenance'])) {
    echo message($_SESSION['maintenance'], 1);
}
unset($_SESSION['maintenance']);

?>
<h1>Maintenance</h1>

<!-- Déplacer -->
<?php
if (!strcmp($action, "deplacer")) {
    echo '<form action="" method="post">'."\n";
    echo '<fieldset><legend>Déplacer une page</legend>'."\n";
    echo '<table class="form_table">'."\n";
    echo '<tr><td><label for="page">Page à déplacer :</label></td><td>« '.$page.' ».';
    echo '<input type="hidden" name="page" value="'.protect_url($page).'" /></td>'."\n";
    echo '</tr><tr><td><label for="deplacer">Nouveau père : </label></td>'."\n";
    echo '<td><select name="deplacer" size="1">'."\n";
    echo '<option value="'.JOCKER_NVPERE.'">* Nouveau pere</option>'."\n";
    option_parente(menu_pere($db, $page), $page);
    echo "</select>\n</tr><td>Ordre : ";
    $ordre = bdd_get($db, 'ordre', $page);
    echo '</td><td><input type="text" name="ordre" size="2" maxlength="2" value="'.$ordre.'" /></td>';
    echo "</tr>\n";
    echo '<tr><td colspan="2" style="text-align:right;"><input type="submit" value="Déplacer" /></td></tr>'."\n";
    echo '</table></fieldset>';
}
?>

<!-- Renommer -->
<form action="" method="post">
<fieldset><legend>Renommer une page</legend>
<table class="form_table">
<tr>
    <td>
        <label for="page">Page à renommer : </label>
    </td><td>
        <select name="page" size="1">
        <option selected="selected" value="">...</option>
<?php
    option_parente('', '', array(1,2,3));
?>
        </select>
    </tr>
    <tr><td>
        <label for="renommer">Nouveau nom : </label>
    </td><td>
        <input type="text" name="renommer" size="25" maxlength="50" />
    </td></tr>
    <tr>
        <td colspan="2" style="text-align:right;"><input type="submit" value="Renommer" />
    </td></tr>
</table>
</fieldset>

<!-- Supprimer -->
<form action="" method="post">
<fieldset><legend>Supprimer une page</legend>
<table class="form_table">
    <tr><td>
        <select name="supprimer" size="1">
        <option selected="selected" value="">...</option>
<?php
    option_parente('', '', array(1,2,3));
?>
        </select>
    </td><td style="text-align:right;">
        <input type="submit" value="Supprimer" />
    </td></tr>
</table>
</fieldset>

<!-- Archiver -->
<form id="archive" method="post" action="">
<fieldset><legend>Archiver une page</legend>
<table class="form_table">
    <tr>
        <td><label for="archiver">Événement :</label></td>
        <td><select name="archiver" size="1">
        <option selected="selected" value="">...</option>
<?php
        option_parente('', 'Événements', array(2,3));
?>
        </select></td>
    </tr><tr>
        <td><label for="annee">Année :</label></td>
        <td><input type="text" id="annee" name="annee" size="4" maxlength="4" value="<?php echo strftime("%Y"); ?>" /></td>
    </tr><tr>
        <td colspan="2" style="text-align:right;">
        <input type="submit" id="submit" name="submit" value="Archiver la page" /></td>
    </tr>
</table>
</fieldset>
