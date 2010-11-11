<?php
/*
 * Lister ou supprimer des articles
 */
require_once('db.php');

if (isset($_POST['nom'])) {
    bdd_supprimer($db, $_POST['nom']);
}
$liste = bdd_lister($db);
echo "<h1>Maintenance</h1>\n";

if (!strcmp($action, 'lister')) {
    echo "<ul>\n";
    foreach ($liste as $l) {
        echo "<li>$l</li>\n";
    }
    echo "</ul>\n";
} else {
    # Supprimer
    echo '<form action="" method="post" onSubmit="return conf_suppr();">'."\n";
    echo "<fieldset><legend>Choisissez une page</legend>\n";
    echo '<select name="nom" size="1" onChange="abule.suppr=this.value">';
    echo '<option selected="selected" value="">...</option>'."\n";
    foreach ($liste as $l) {
        echo "<option value=\"$l\">$l</option>\n";
    }
    echo "</select>\n";
    echo '<input type="submit" value="Supprimer" accesskey="g" />';
    echo "</fieldset>\n";
}
?>
