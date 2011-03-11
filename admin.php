<?php
echo '<h1>Ajouter un admin</h1>'."\n";

## Création d'un compte
if (isset($_POST['creer_admin'])) {
    if (isset($_POST['pass']) && isset($_POST['nom'])) {
        $nom   = $_POST['nom'];
        $pass  = $_POST['pass'];
        $_SESSION['creer_admin'] = bdd_creer_admin($db, $nom, $pass);
    } else {
        echo message('Impossible de lire le formulaire');
    }
}

if (isset($_SESSION['creer_admin'])) {
    if (empty($_SESSION['creer_admin'])) {
        echo message('Admin créé', 1);
    } else {
        echo message($_SESSION['creer_admin']);
    }
}
unset($_SESSION['creer_admin']);

## Journal des modifs
$lim = 20;
$journal = '<p>Journal des '.$lim.' derniers événements.</p>'."\n";
$journal .= '<table border="1" cellpadding="5" cellspacing="3" style="margin:0 auto;">'."\n";
$journal .= '<tr><th>Login</th><th>Date/Heure</th><th>Action</th></tr>'."\n";
$liste = bdd_journal($db, $lim);
foreach ($liste as $l) {
    $journal .= '<tr><td>'.$l['login'].'</td><td>'.$l['date'].'</td><td>'.$l['message'].'</td></tr>'."\n";
}
$journal .= '</table>'."\n";

?>
<form id="creer_admin" method="post" action="">
<table class="form_table"><tr>
    <td><label for="nom">Login du nouvel admin : </label></td>
    <td><input type="nom" id="nom" name="nom" size="25" /></td>
</tr><tr>
    <td><label for="pass">Son mot de passe : </label></td>
    <td><input type="password" id="pass" name="pass" size="25" /></td>
</tr><tr>
    <td colspan="2" style="text-align:right;">
    <input type="submit" id="creer_admin" name="creer_admin" value="Créer l'admin" /></td>
</tr></table>
</form>

<br/>
<h1>Journal</h1>
<?php #Journal
    echo $journal;
?>
