<?php
echo '<h1>Mot de passe</h1>'."\n";

if (isset($_POST['submit'])) {
    if (isset($_POST['pass']) && isset($_POST['passconf'])) {
        $pass  = $_POST['pass'];
        $passconf  = $_POST['passconf'];
        if ($pass == $passconf) {
            $_SESSION['changer_mdp'] = bdd_changer_mdp($db, $_SESSION['login'], $pass);
        } else {
            echo message('Mots de passe différents');
        }
    } else {
        echo message('Impossible de lire/confirmer le mot de passe');
    }
}

if (isset($_SESSION['changer_mdp'])) {
    if (empty($_SESSION['changer_mdp'])) {
        echo message('Le mot de passe a bien été changé', 1);
    } else {
        echo message($_SESSION['changer_mdp']);
    }
}
unset($_SESSION['changer_mdp']);

// Formulaire pour modifier son mot de passe
?>
<form id="changer_mdp" method="post" action="">
<fieldset><legend>Changer votre mot de passe</legend>
<table class="form_table">
    <tr>
        <td><label for="pass">Nouveau mot de passe : </label></td>
        <td><input type="password" id="pass" name="pass" size="25" /></td>
    </tr><tr>
        <td><label for="passconf">Confirmer le mot de passe : </label></td>
        <td><input type="password" id="passconf" name="passconf" size="25" /></td>
    </tr><tr>
        <td colspan="2" style="text-align:right;">
        <input type="submit" id="submit" name="submit" value="Changer" /></td>
    </tr>
</table>
</form>
