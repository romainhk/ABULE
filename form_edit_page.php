<?php
if (!strcmp($action, 'ajouter')) {
    $modification = False;
} else {
    $modification = True;
}
?>
<h1>Formulaires Admin</h1>
<form method="post" action="edit_page.php">
<fieldset>
<legend><?php echo ucfirst($action); ?> une page</legend>
<ul>
<?php
    if ($modification) {
        echo "<li>Nom de la page : « $page ».</li>";
    } else {
        echo '<li><label for="nom">Nom de la page :</label>'
            ."\n    ".'<input type="text" name="nom" size="25" /></li>';
    }
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
    ]
    });
    //]]>
	</script>
    <div style="text-align:right;">
    <?php if ($modification) echo '<input type="hidden" name="modifier" value="foo" />'; ?>
    <input type="submit" value="Ajouter" accesskey="g" /></div>
</fieldset>
</form>
