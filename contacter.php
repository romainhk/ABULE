<?php
/*
 * Formulaire de contact
 */
if (isset($_POST['from'])) {
	$to = $_POST['to'];
	$subject = $_POST['subject'];
	$mess = $_POST['mess'];
	$from = $_POST['from'];
    switch($to) {
    case 'labule':
        $to = 'labule@labule.fr';
        break;
    case 'admin':
        $to = 'administrateur@labule.fr';
        break;
    default:
        unset($to);
    }
    if (isset($to)) {
        $headers  = "From: <$from>"."\r\n";
        #$headers .= "Reply-To: <$from>"."\r\n";
        $headers .= 'Date: '.date("r")."\r\n";
        $headers .= 'Content-Type: text/plain; charset="iso-8859-1"'."\r\n";
        $headers .= 'X-Mailer: PHP/'.phpversion()."\r\n";
        if (mail($to,$subject,$mess,$headers)) {
            echo "<p>Votre email a bien &#233;t&#233; envoy&#233;.</p>";
        } else {
            echo "<p>Une erreur s'est produite.</p>";
        }
    } else {
        echo "<p>Adresse d'exp&#233;dition non reconnue.</p>";
    }
    echo "<p>Redirection en cours...</p>";
    redirection('', 4000);
} else {
echo"<h1>Contactez-nous</h1>&nbsp
<form name='contact' method='post' action=''> 
	<div id=form style='width:90%; margin:auto;'>
		A qui est destin&eacute votre mail :
		<p><input type='radio' name='to' value='admin' id='webmaster' /> <label for='to'>Le webmaster</label><br />
        <input type='radio' name='to' value='labule' id='asso' checked=\"checked\" /> <label for='asso'>Les membres de L&#180;A.B.U.L.E.</label><br /></p>
		<label for='from'>Votre e-mail</label> : 
		<input type='text' name='from' id='from' size='30'></input><br/><br/>
		<label for='subject'>Objet</label> : 
		<input type='text' name='subject' id='subject' size='60'></input><br/>&nbsp
		<div id='text' style='text-align:right'>
			<textarea name='mess' id='mess' rows='13' style='width:100%; border:3px double brown;' onfocus='efface()'>Votre message ici.</textarea><br/><br/>
			<input type='button' value='Envoyer' onClick='verif_mail()' style=\"font-weight:600;\"></input>
		</div>

</form>";
}
?>

