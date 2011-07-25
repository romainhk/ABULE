<?php
/*
 * ###Admin
 * Actions disponibles pour les super-admins
 */
echo '<h1>Gestion des utilisateurs</h1>'."\n";

## Création d'un compte
if (isset($_POST['creer_admin'])) {
    if (isset($_POST['pass']) && isset($_POST['nom'])) {
        $nom   = $_POST['nom'];
        $pass  = $_POST['pass'];
        $admin = (isset($_POST['admin'])) ? $_POST['admin'] : 0;
        $_SESSION['creer_admin'] = bdd_creer_utilisateur($db, $nom, $pass, $admin);
    } else {
        echo message('Impossible de lire le formulaire de création');
    }
}
if (isset($_SESSION['creer_admin'])) {
    echo message($_SESSION['creer_admin'], 1);
}
unset($_SESSION['creer_admin']);

## Supprimer un compte
if (isset($_POST['supprimer_admin'])) {
    if (isset($_POST['nom'])) {
        $nom   = $_POST['nom'];
        $_SESSION['supprimer_admin'] = bdd_supprimer_utilisateur($db, $nom);
    } else {
        echo message('Impossible de lire le formulaire de suppression');
    }
}

if (isset($_SESSION['supprimer_admin'])) {
    echo message($_SESSION['supprimer_admin'], 1);
}
unset($_SESSION['supprimer_admin']);

## Journal des modifs
$lim = 20;
$journal  = '<p>Journal des '.$lim.' derniers événements.</p>'."\n";
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
    <td><label for="nom">Login du nouvel utilisateur : </label></td>
    <td><input type="nom" id="nom" name="nom" size="25" /></td>
</tr><tr>
    <td><label for="pass">Son mot de passe : </label></td>
    <td><input type="password" id="pass" name="pass" size="25" /></td>
</tr><tr>
    <td><label for="admin">Administrateur ?<br />(peut créer/supprimer des comptes) : </label></td>
    <td><input type="checkbox" name="admin" value="1" /></td>
</tr><tr>
    <td colspan="2" style="text-align:right;">
    <input type="submit" id="creer_admin" name="creer_admin" value="Créer l'utilisateur" /></td>
</tr></table>
</form>
<hr width="30%">
<form id="supprimer_admin" method="post" action="">
<table class="form_table"><tr>
    <td><label for="nom">Login de l'utilisateur à supprimer : </label></td>
    <td style="text-align:left;"><select name="nom" size="1">
<?php
foreach (bdd_liste_utilisateur($db) as $nom) {
    echo $nom;
    echo '<option value="'.urlencode($nom).'">'.$nom.'</option>'."\n";
}
?></select></td>
</tr><tr>
    <td colspan="2" style="text-align:right;">
    <input type="submit" id="supprimer_admin" name="supprimer_admin" value="Supprimer l'utilisateur" /></td>
</tr></table>
</form>

<br/>
<h1>Journal</h1>
<?php #Journal
    echo $journal;
?>
