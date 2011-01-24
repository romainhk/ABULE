<?php
/*
 * Lister ou supprimer des articles
 */
require_once('db.php');

// Rend lisible la colonne page.fils
function liste_fils($val) {
    switch ($val) {
    case MENU_SEUL:
        return "<i>Père seul</i>";
        break;
    case '':
        #return "<i>Fils</i>";
        return "";
        break;
    default;
        return implode(' / ', explode(MENU_JOCKER, $val));
    }
}

if (isset($_POST['nom'])) {
    bdd_supprimer($db, $_POST['nom']);
}
$liste = bdd_lister($db);
echo "<h1>Maintenance</h1>\n";

if (!strcmp($action, 'lister')) {
    # Lister
    echo '<table cellspacing="5" cellpadding="2">'."\n";
    echo "<tr><th>Nom</th><th>Fils</th><th>Ordre</th></tr>\n";
    foreach ($liste as $l) {
        //TODO ajouter des liens direct vers ces pages
        echo '<tr><td><a href="?page='.$l['nom'].'">'.$l['nom'].'</a></td>';
        echo '<td>'.liste_fils($l['fils']).'</td><td>'.$l['ordre']."</td></tr>\n";
    }
    echo "</table>\n";
} else {
    # Supprimer
    echo '<form action="" method="post" onSubmit="return conf_suppr();">'."\n";
    echo "<fieldset><legend>Choisissez une page</legend>\n";
    echo '<select name="nom" size="1" onChange="abule.suppr=this.value">';
    echo '<option selected="selected" value="">...</option>'."\n";
    foreach ($liste as $l) {
        echo '<option value="'.$l['nom'].'">'.$l['nom']."</option>\n";
    }
    echo "</select>\n";
    echo '<input type="submit" value="Supprimer" accesskey="g" />';
    echo "</fieldset>\n";
}
?>
