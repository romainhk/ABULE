<?php
/*
 * Lister, supprimer ou renommer des articles
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
$liste = bdd_lister($db);

if (isset($_POST['nouveau'])) {
    if (!empty($_POST['nouveau']) and isset($_POST['page'])) {
        $page = $_POST['page'];
        $nouveau = $_POST['nouveau'];
        // Le nom existe déjà ?
        if (!in_array($nouveau, $liste)) {
            bdd_renommer($db, $page, $nouveau);
        } else {
            echo '<p>Impossible de renommer : ce nom est déjà utilisé.</p>';
        }
    }
} else if (isset($_POST['nom']) and !empty($_POST['nom'])) {
    bdd_supprimer($db, $_POST['nom']);
}

echo "<h1>Maintenance</h1>\n";

if (!strcmp($action, 'lister')) {
    # Lister
    echo "<p>Liste des pages existantes, ainsi que leur parenté et leur ordre d'affichage.</p>\n";
    echo '<table cellspacing="5" cellpadding="2">'."\n";
    echo "<tr><th>Nom</th><th>Fils</th><th>Ordre</th></tr>\n";
    foreach ($liste as $l) {
        echo '<tr><td><a href="?page='.strtr($l['nom'], " ", "_").'">'.$l['nom'].'</a></td>';
        echo '<td>'.liste_fils($l['fils']).'</td><td>'.$l['ordre']."</td></tr>\n";
    }
    echo "</table>\n";
} else if (!strcmp($action, 'supprimer')) {
    # Supprimer
    echo '<form action="" method="post" onSubmit="return conf_suppr();">'."\n";
    echo "<fieldset><legend>Choisissez une page</legend>\n";
    echo '<select name="nom" size="1" onChange="abule.suppr=this.value">';
    echo '<option selected="selected" value="">...</option>'."\n";
    foreach ($liste as $l) {
        echo '<option value="'.$l['nom'].'">'.$l['nom']."</option>\n";
    }
    echo "</select>\n";
    echo '<input type="submit" value="Supprimer" />';
    echo "</fieldset>\n";
} else if (!strcmp($action, 'renommer')) {
    # Renommer
    echo '<form action="" method="post">'."\n";
    echo "<fieldset><legend>Renommer</legend>\n";
    echo '<ul><li><label for="page">Page à renommer : </label>';
    echo '<select name="page" size="1">';
    echo '<option selected="selected" value="">...</option>'."\n";
    foreach ($liste as $l) {
        echo '<option value="'.$l['nom'].'">'.$l['nom']."</option>\n";
    }
    echo "</select>\n";
    echo '</li><li><label for="nouveau">Nouveau nom : </label>';
    echo '<input type="text" name="nouveau" size="25" maxlength="50" />';
    echo '</li></ul>';
    echo '<div style="text-align:right;"><input type="submit" value="Renommer" /></div>';
    echo "</fieldset>\n";
} else {
    echo '<p>Paramètre "'.$action.'" inconnu</p>';
}
?>
