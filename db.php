<?php
/*
 * Connexion à la base de données
 */
$mycnf = parse_ini_file("mycnf");
$db = mysql_connect($mycnf['host'], $mycnf['user'], $mycnf['password']);
if (!$db) {
    die('Imposible de se connecter à la base : '.mysql_error($db));
}

mysql_select_db('site_abule', $db);
mysql_query('SET NAMES UTF8', $db);
?>
