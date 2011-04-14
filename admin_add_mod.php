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
<div style="float:right;"><a href="?action=aide_html">Aide html</a></div>
<ul>
<?php
    ## Nom, père et ordre
    $ordre = 1;
    $pere= '';
    if ($modification) {
        echo "<li>Nom de la page : « ".$page.' ».<input type="hidden" name="nom" value="'.protect_url($page)."\" />\n";
        echo '<input type="hidden" name="modifier" value="foo" /></li>'."\n";
        $ordre = bdd_get($db, 'ordre', $page);
        $pere = menu_pere($db, $page);
    } else {
        echo '<li><label for="nom">Nom de la page :</label>'
            ."\n    ".'<input type="text" name="nom" size="25" /></li>'."\n";
    }
    echo '<li>Menu : <select name="pere" size="1">';
    echo '<option value="">* Nouvelle section</option>'."\n";
    option_parente($pere);
    echo "</select>\n<span style=\"margin-left:5ex;\">ordre : ";
    echo '<input type="text" name="ordre" size="2" maxlength="2" value="'.$ordre.'" />';
    echo "</span></li>\n";
?>
    <li><label for="contenu">Contenu html :</label></li>
</ul>
<textarea cols="80" id="editeur" name="contenu" rows="12"><?php echo $prechargement; ?></textarea>
<script language="javascript" type="text/javascript" src="edit_area/edit_area_full.js"></script>
<script language="javascript" type="text/javascript">
editAreaLoader.init({
	id : "editeur"	        // textarea id
    ,language: "fr"
	,syntax: "html"		    // syntax highgliting
	,start_highlight: true		// highlight mode on start-up
    ,font_size: 11
    ,cursor_position: "auto"
    ,allow_resize: "both"
    ,min_width: 600
    ,min_height: 500
    ,word_wrap: true
    //,end_toolbar: "|,filebrowser,image,surligner"
    ,end_toolbar: "|,image,galerie,surligner"
    ,plugins: "filebrowser,labule"
});
</script>
    <div style="text-align:right;">
    <input type="submit" value="<?php echo ucfirst($action); ?>" accesskey="g" /></div>
</fieldset>
</form>

<h3>Aide</h3>
<p>Les éléments d'un menu sont répartis selon deux niveaux : père et fils. Les pères avec fils n'ont pas de page propre.</p>
<dl>
    <dt>Menu</dt>
    <dd>L'élément parent du menu.</dd>
    <dt>Ordre</dt>
    <dd>Les éléments seront classés du plus petit au plus grand. L'ordre est un nombre strictement positif ; si deux pages d'un même niveau ont le même ordre, un seul s'affichera.</dd>
</dl>
