<?php
/*
 * Lister et sélectionner un fichier binaire dans la bdd
 */
require('db.php');
echo "Browser php<br>\n";
// anonymous function number
$funcNum = $_GET['CKEditorFuncNum'] ;
// instance name
$CKEditor = $_GET['CKEditor'] ;
 
// Check the $_FILES array and save the file. Assign the correct path to some variable ($url).
$url = '';
// Usually you will assign here something only if file could not be uploaded.
$message = '';
 
echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>$CKEditor - $funcNum<br>\n";

$req = 'SELECT * FROM fichier';
$ret = mysql_query($req, $db)
   or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
while($row = mysql_fetch_array($ret)) {
    echo $row['nom']."<br>\n";
}
?>
