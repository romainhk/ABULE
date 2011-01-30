<?php
#start() et destroy() sont dans index.php

if (isset($_POST['submit'])) {
    // Login
    $login = (isset($_POST['login'])) ? $_POST['login'] : '';
    $pass  = (isset($_POST['pass']))  ? $_POST['pass']  : '';
    $sql = "SELECT login, mdp FROM utilisateur WHERE login = '".addslashes($login)."'";
    $req = mysql_query($sql) or die('Erreur SQL : <br />'.$sql);

    if (mysql_num_rows($req) > 0) {
        $data = mysql_fetch_assoc($req);
        if ($pass == $data['mdp']) {
            $_SESSION['login'] = $login;
            bdd_logger($db, 'Log-in : '.$login);

            #REDIRECTION
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else { $page = 'Accueil'; }
            require_once('fonctions.php');
            redirection($page);
        }
    }
}

// Affichage
echo '<h2>Login</h2>'."\n";
if (isset($_SESSION['login'])) {
    // "Connecté", bouton logout
    echo '<ul><li>Bonjour '.$_SESSION['login']." :</li>\n";
    echo '<li><a href="index.php?action=changer_mdp"><i>Changer son mot de passe</i></a></li>';
    echo '<li><a href="index.php?action=logout"><b>Se déconnecter</b></a></li></ul>';
} else {
    // Formulaire de connexion
    echo '<form class="connect" id="conn" method="post" action=""><ul>'."\n";
    echo '  <li><label for="login">Login :</label><input type="text" id="login" name="login" size="25" /></li>'."\n";
    echo '  <li><label for="pass">Mot de Passe :</label><input type="password" id="pass" name="pass" size="25" /></li>'."\n";
    echo '  <li><input type="submit" id="submit" name="submit" value="Connexion" /></li>'."\n";
    echo '</ul></form>'."\n";
}
?>
