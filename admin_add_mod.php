<?php
/*
 * Formulaire d'ajout/modification de page
 */
$prechargement = "";
if (!strcmp($action, 'ajouter')) {
    $modification = False;
    $prechargement = '&lt;h1&gt;Titre de la page&lt;/h1&gt;&#10;&lt;p&gt;Contenu de la page...&lt;/p&gt;';
} else {
    $modification = True;
    $prechargement = bdd_charger($db, $page);
}
?>
<h1>Édition</h1>
<form method="post" action="edit_page.php">
<fieldset>
<legend><?php echo ucfirst($action); ?> une page</legend>
<ul>
<?php
    if ($modification) {
        echo "<li>Nom de la page : « $page ».<input type=\"hidden\" name=\"nom\" value=\"$page\" />\n";
        echo '<input type="hidden" name="modifier" value="foo" /></li>';
    } else {
        echo '<li><label for="nom">Nom de la page :</label>'
            ."\n    ".'<input type="text" name="nom" size="25" /></li>';
    }
    echo "\n";
?>
    <li><label for="contenu">Contenu :</label></li>
</ul>
<textarea class="editor" cols="80" id="editeur" name="contenu" rows="12"><?php echo $prechargement; ?></textarea>
<script language="javascript" type="text/javascript" src="edit_area/edit_area_full.js"></script>
<script language="javascript" type="text/javascript">
editAreaLoader.init({
	id : "editeur"	        // textarea id
    ,language: "fr"
	,syntax: "html"		    // syntax to be uses for highgliting
	,start_highlight: true		// to display with highlight mode on start-up
    ,font_size: 11
    ,cursor_position: "auto"
    ,allow_resize: "both"
    ,min_width: 600
    ,word_wrap: true
});
</script>
    <div style="text-align:right;">
    <input type="submit" value="<?php echo ucfirst($action); ?>" accesskey="g" /></div>
</fieldset>
</form>
