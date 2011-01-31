<script>
function verif_mail(){
	var email=document.forms["contact"].elements["email"].value;
	var valide1=email.indexOf('@');
	var valide2=email.lastIndexOf('.');
	var valide3=email.length-3;
	if(valide1==-1||valide2<valide1||valide2>valide3) alert("Veuillez saisir une adresse email valide.");
	else document.forms["contact"].submit();	
}
function efface(){
	var mail="Votre message ici.";
	var test=document.forms["contact"].elements["mail"].value.indexOf(mail);
	if(test==0){
		document.forms["contact"].elements["mail"].value="";
	}
}
</script>
<?php
if (isset($_POST['email'])){
	$mail=addslashes($_POST['mail']);
	$object=addslashes($_POST['object']);
	$email=$_POST['email'];
	$receive=$_POST['receive'];
	$headers= "From: <".$email.">\r\nReply-to : <".$email.">\n"; 
	if (mail($receive,$object,$mail,$headers)) { 
	echo "Votre mail a été envoyé"; 
	} else { 
	echo "Une erreur s'est produite"; 
	} 
}
else{
echo"<h1>Contactez-nous</h1>&nbsp
<form name='contact' method='post' action=''> 
	<div id=form style='width:90%; margin:auto;'>
		A qui est destin&eacute votre mail :
		<p><input type='radio' name='receive' value='administrateur@labule.fr' id='webmaster' /> <label for='receive'>Le webmaster</label><br />
        <input type='radio' name='receive' value='labule@labule.fr' id='asso' /> <label for='asso'>Les membres de LABULE</label><br /></p>
		<label for='email'>Votre e-mail</label> : 
		<input type='text' name='email' id='email' size='30'></input><br/><br/>
		<label for='object'>Objet</label> : 
		<input type='text' name='object' id='object' size='70'></input><br/>&nbsp
		<div id='text' style='text-align:right'>
			<textarea name='mail' id='mail' rows='13' style='width:100%; border:3px double brown;' onfocus='efface()'>Votre message ici.</textarea><br/><br/>
			<input type='Button' value='Envoyer' onClick='verif_mail()'></input>
		</div>

</form>";
}
?>

