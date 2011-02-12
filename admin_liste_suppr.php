<?php
/*
 * Lister, supprimer, renommer ou déplacer des articles
 */
require_once('db.php');

$liste = bdd_lister($db);

if (isset($_POST['nouveau'])) {
    if (!empty($_POST['nouveau']) and isset($_POST['page'])) {
        $page = $_POST['page'];
        $nouveau = $_POST['nouveau'];
        if (!in_array($nouveau, $liste)) {
            bdd_renommer($db, $page, $nouveau);
        } else {
            echo '<p>Impossible de renommer : ce nom est déjà utilisé.</p>';
        }
    }
} else if (isset($_POST['deplacer']) and !empty($_POST['deplacer']) and isset($_POST['page'])) {
    $nvpere = $_POST['deplacer'];
    $page   = $_POST['page'];
    $ordre  = $_POST['ordre'];
    echo $nvpere.'***'.$page.'******'.$ordre;
    #bdd_deplacer($db, $page, $nvpere, $ordre);
} else if (isset($_POST['nom']) and !empty($_POST['nom'])) {
    bdd_supprimer($db, $_POST['nom']);
}

echo "<h1>Maintenance</h1>\n";
// Formulaires
if (!strcmp($action, 'lister')) {
    # Lister
    echo "<p>Liste des pages existantes, ainsi que leur parenté et leur ordre d'affichage.</p>\n";
    echo '<table cellspacing="5" cellpadding="2">'."\n";
    echo "<tr><th>Nom</th><th>Niveau</th><th>Ordre</th></tr>\n";
    foreach ($liste as $l) {
        echo '<tr><td><a href="?page='.strtr($l['nom'], " ", "_").'">'.$l['nom'].'</a></td>';
        echo '<td>'.$l['niveau'].'</td><td>'.$l['ordre']."</td></tr>\n";
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
} else if (!strcmp($action, 'deplacer')) {
    # Déplacer
    echo '<form action="" method="post">'."\n";
    echo "<fieldset><legend>Déplacer</legend>\n";
    echo '<ul><li><label for="page">Page à déplacer : « '.$page.' ».</label>';
    echo '<input type="hidden" name="nom" value="'.$page.'" />';
    echo '</li><li><label for="deplacer">Nouveau père : </label>';
    echo '<select name="deplacer" size="1">';
    echo '<option value="">* Nouveau pere</option>'."\n";
    $pere = menu_pere($db, $page);
    foreach (menu_les_peres($db) as $lp) {
        if (!strcmp($pere, $lp)) {
            $sel = ' selected="selected"';
        } else { $sel = ''; }
        echo '<option value="'.$lp.'"'.$sel.'>'.$lp.'</option>'."\n";
    }
    echo "</select>\n<span style=\"margin-left:5ex;\">ordre : ";
    $ordre = bdd_get($db, 'ordre', $page);
    echo '<input type="text" name="ordre" size="2" maxlength="2" value="'.$ordre.'" />';
    echo '</li></ul>';
    echo '<div style="text-align:right;"><input type="submit" value="Déplacer" /></div>';
    echo "</fieldset>\n";

} else {
    echo '<p>Paramètre "'.$action.'" inconnu</p>';
}
?>
