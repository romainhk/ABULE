<?php
/*
 * Uploader un fichier
 */
require_once('db.php');

// Ajoute un fichier à la BDD
/* Remplacé par le le dossier "uploads/"
function bdd_ajouter_fichier($db, $nom, $data) {
    $req = 'INSERT INTO fichier (nom, data) VALUES ("'.$nom.'", "'.$data.'")';
    $ret = mysql_query($req, $db);
    if (!$ret) {
        if (mysql_errno($db) == 1062) { # la page existe dégà
            $req = 'UPDATE fichier SET data="'.$contenu.'" WHERE nom="'.$nom.'"';
            $ret = mysql_query($req, $db)
                or die("Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db));
            return $ret;
        } else {
            return "Erreur dans la requête ".mysql_errno($db)." : ".mysql_error($db);
        }
    }
    return FALSE;
}  */

require_once('fonctions.php');
$taille_max = 5000;

if (isset($_GET['statut'])) {
    $statut = $_GET['statut'];
} else { $statut = -1; }
if (isset($_GET['err']) and !empty($_GET['err'])) {
    $err = $_GET['err'];
} else { $err = ''; }
$les_statut = array( 'Ok',
        "Problème lors de l'upload",
        "Format de fichier non autorisée",
        "Fichier plus grand que $taille_max ko",
        "Problème lors de la création du fichier" );

if (isset($_FILES['upload']) and !empty($_FILES['upload'])) {
    $dossier = 'uploads/'; # Dossier des uploads
    $extensions = array('image/png', 'image/gif', 'image/tiff', 'image/jpeg', 
        'image/svg+xml', 'application/pdf', 'application/zip', 'multipart/x-gzip', 
        'application/x-7z-compressed', 'application/x-rar-compressed', 'video/x-mng');

    $upload = $_FILES['upload'];
    $nom = $upload['name'];
    $type = $upload['type'];
    $taille = $upload['size']/1024; //ko
    $tmp_name = $upload['tmp_name'];
    $erreur = $upload['error'];

    if ($erreur != UPLOAD_ERR_OK) {
        $statut = 1;
        $err = $erreur;
    } else if (!in_array($type, $extensions)) {
        $statut = 2;
        $err = $type;
    } else if ($taille > $taille_max) {
        $statut = 3;
        $err = $taille;
    } else {
        $path = $dossier.retirer_accents(basename($nom));
        $err = $path;
        if (!move_uploaded_file($tmp_name, getcwd().'/'.$path)) {
            $statut = 4;
        } else {
            # Upload réussi !
            $statut = 0;
        }
    }
    redirection("&action=uploader&statut=$statut&err=$err", 1);
}

// Formulaire d'envoi
echo "<h1>Upload de fichier</h1>\n";
if ($statut > 0) {
    echo "<p>".$les_statut[$statut]." : $err.</p>";
}
?>
<form method="POST" action="uploader.php" enctype="multipart/form-data">
<ul><li><input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $taille_max*1024; ?>">
  <label for="nom">Fichier :</label> <input type="file" name="upload" size="40"></li></ul>
  <div style="text-align:right; padding-right:1em;"><input type="submit" name="envoyer" value="Envoyer le fichier"></div>
</form>
<?php
if ($statut == 0) {
    echo "<p>Le fichier est maintenant accessible à l'adresse : <tt>$err</tt></p>";
}
?>
<h3><a href="http://fr.wikipedia.org/wiki/Format_de_donn%C3%A9es">Formats de fichier</a> autorisés</h3>
<ul>
    <li>Images : gif, jpeg, mng, png, svg, tiff.</li>
    <li>Archives : 7z, gzip, rar, zip.</li>
    <li>Autres : pdf.</li>
</ul>
