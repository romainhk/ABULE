<?php
/*
 * Liste des articles présents dans la base de données
 */
require_once('db.php');

$liste = bdd_lister($db);
?>
<h1>Liste des pages</h1>
<ul>
<?php
foreach ($liste as $l) {
    echo "<li>$l</li>\n";
}
?>
</ul>
