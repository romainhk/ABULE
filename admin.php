<?php
echo '<h1>Ajouter un admin</h1>'."\n";

## Création d'un compte
if (isset($_POST['creer_admin'])) {
    if (isset($_POST['pass']) && isset($_POST['nom'])) {
        $nom   = $_POST['nom'];
        $pass  = $_POST['pass'];
        $_SESSION['creer_admin'] = bdd_creer_admin($db, $nom, $pass);
    } else {
        echo '<p>Impossible de lire le formulaire.</p>';
    }
}

if (isset($_SESSION['creer_admin'])) {
    if (empty($_SESSION['creer_admin'])) {
        echo '<p>Admin créé</p>';
    } else {
        echo '<p>'.$_SESSION['creer_admin'].'</p>';
    }
}
unset($_SESSION['creer_admin']);

## Journal des modifs
$lim = 15;
$journal = '<p>Journal des '.$lim.' derniers événements.</p>'."\n";
$journal .= '<table border="1" cellpadding="5" cellspacing="3">'."\n";
$journal .= '<tr><th>Login</th><th>Date/Heure</th><th>Action</th></tr>'."\n";
$liste = bdd_journal($db, $lim);
foreach ($liste as $l) {
    $journal .= '<tr><td>'.$l['login'].'</td><td>'.$l['date'].'</td><td>'.$l['message'].'</td></tr>'."\n";
}
$journal .= '</table>'."\n";

?>
<form id="creer_admin" method="post" action="">
<ul><li>
    <label for="nom">Login du nouvel admin : </label>
    <input type="nom" id="nom" name="nom" size="25" /></li>
    <li><label for="pass">Son mot de passe : </label>
    <input type="password" id="pass" name="pass" size="25" /></li>
</ul>
<div style="text-align:center;">
    <input type="submit" id="creer_admin" name="creer_admin" value="Créer l'admin" />
</div>
</form>

<br/>
<h1>Journal</h1>
<?php #Journal
    echo $journal;
?>
