<h1>Maintenance</h1>
<?php
/*
 * Formulaire d'archivage d'une page, par année
 */

if (isset($_POST['nom']) and isset($_POST['annee']) and !empty($_POST['nom'])) {
    $nom   = urldecode($_POST['nom']);
    $annee = intval($_POST['annee']);
    if ($annee < 2000 || $annee > 2100) {
        $_SESSION['archivage'] = 'Année "'.$annee.'" non valide';
    } else {
        $ret = bdd_archiver($db, $nom, $annee);
        if ($ret) { $_SESSION['archivage'] = $ret; }
    }
}
if (isset($_SESSION['archivage'])) {
    echo message($_SESSION['archivage'], 1);
}
unset($_SESSION['archivage']);
?>
<form id="archive" method="post" action="">
<fieldset><legend>Archiver une page</legend>
<table class="form_table"><tr>
    <td><label for="titre">Nom de la page :</label></td>
    <td><?php
    echo '<select name="nom" size="1">';
    echo '<option selected="selected" value="">...</option>'."\n";
    option_parente('', 'Événements', array(2,3));
    echo "</select>\n";
?></td>
</tr><tr>
    <td><label for="annee">Année (<i>YYYY</i>) :</label></td>
    <td><input type="text" id="annee" name="annee" size="4" /></td>
</tr><tr>
    <td colspan="2" style="text-align:right;">
        <input type="submit" id="submit" name="submit" value="Archiver la page" /></td>
</tr></table>
</fieldset>
</form>
