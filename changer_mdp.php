<?php
echo '<h1>Changer votre mot de passe</h1>'."\n";

if (isset($_POST['submit'])) {
    if (isset($_POST['pass'])) {
        $pass  = $_POST['pass'];
        $_SESSION['changer_mdp'] = bdd_changer_mdp($db, $_SESSION['login'], $pass);
    } else {
        echo '<p>Impossible de lire le mot de passe</p>';
    }
}

if (isset($_SESSION['changer_mdp'])) {
    if (empty($_SESSION['changer_mdp'])) {
        echo '<p>Le mot de passe a bien été changé</p>';
    } else {
        echo '<p>'.$_SESSION['changer_mdp'].'</p>';
    }
}
unset($_SESSION['changer_mdp']);

// Formulaire pour modifier son mot de passe
?>
<form id="changer_mdp" method="post" action="">
<ul><li>
    <label for="pass">Nouveau mot de passe : </label>
    <input type="password" id="pass" name="pass" size="25" />
    <input type="submit" id="submit" name="submit" value="Changer" />
</li></ul>
</form>
