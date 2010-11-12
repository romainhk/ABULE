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
<textarea class="ckeditor" cols="80" id="contenu" name="contenu" rows="12"><?php echo $prechargement; ?></textarea>
    <script type="text/javascript">
    //<![CDATA[
    CKEDITOR.replace( 'contenu',
    {
        toolbar:
    [
        [ 'Source' ], 
        [ 'Bold', 'Italic', 'Underline', 'Strike' ],
        [ 'Styles', 'Format' ],
        [ 'Image', 'Table', 'SpecialChar', 'Smiley' ],
        [ 'Find', 'Replace', '-', 'ShowBlocks', 'Maximize' ]
    ],
    filebrowserBrowseUrl : 'browser.php',
    filebrowserUploadUrl : 'uploader.php',
    filebrowserWindowWidth : '640',
    filebrowserWindowHeight : '480'
    });
    //]]>
	</script>
    <div style="text-align:right;">
    <input type="submit" value="<?php echo ucfirst($action); ?>" accesskey="g" /></div>
</fieldset>
</form>
