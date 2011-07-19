<?php
/*
 * Uploader un fichier
 */
require_once('db.php');

require_once('fonctions.php');
$taille_max = 10240; // 10 Mo

if (isset($_GET['statut'])) {
    $statut = $_GET['statut'];
} else { $statut = -1; }
if (isset($_GET['err']) and !empty($_GET['err'])) {
    $err = $_GET['err'];
} else { $err = ''; }
$les_statut = array( 'Ok',
        "Problème non spécifique lors de l'upload",
        "Format de fichier non autorisée",
        "Problème lors de l'envoi",
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

    if ($erreur == UPLOAD_ERR_OK) {
        $path = $dossier.retirer_accents(basename($nom));
        $err = $path;
        if (!move_uploaded_file($tmp_name, getcwd().'/'.$path)) {
            $statut = 5;
        } else {
            # Upload réussi !
            $statut = 0;
            bdd_logger($db, 'Upload du fichier : '.$nom);
        }
    } else if ($taille > $taille_max || $erreur == UPLOAD_ERR_INI_SIZE || $erreur == UPLOAD_ERR_FORM_SIZE) {
        $statut = 4;
        $err = $taille;
    } else if ($erreur == UPLOAD_ERR_PARTIAL || $erreur == UPLOAD_ERR_NO_FILE) {
        $statut = 3;
        $err = $erreur;
    } else if (!in_array($type, $extensions) || $erreur == UPLOAD_ERR_EXTENSION) {
        $statut = 2;
        $err = $type;
    } else {
        $statut = 1;
        $err = $erreur;
    }
    redirection("&action=uploader&statut=$statut&err=$err", 1);
}

// Formulaire d'envoi
echo "<h1>Hébergement de fichier</h1>\n";
if ($statut > 0) {
    echo message($les_statut[$statut]." : $err");
}
?>
<form method="POST" action="" enctype="multipart/form-data">
<fieldset><legend>Envoie de fichier</legend>
<table class="form_table">
    <tr>
        <td><input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $taille_max*1024; ?>"></td>
        <td><label for="nom">Fichier (taille maximum : <?php echo $taille_max/1024; ?> Mo) :</label> <input type="file" name="upload" size="40"></td>
    </tr><tr>
        <td colspan="2" style="text-align:right;">
        <input type="submit" name="envoyer" value="Envoyer le fichier"></td>
    </tr>
</table>
</form>
<?php
if ($statut == 0) {
    echo message("Le fichier est maintenant accessible à l'adresse : <tt>$err</tt> ");
}
?>
<h4>Formats de fichier autorisés</h4>
<ul>
    <li>Images : gif, jpeg, mng, png, svg, tiff.</li>
    <li>Archives : 7z, gzip, rar, zip.</li>
    <li>Autres : pdf.</li>
</ul>
