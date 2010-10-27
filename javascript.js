function horloge(){
	var maintenant = new Date();
	var year=maintenant.getFullYear();
	var nbjour=maintenant.getDate();
	var heure=maintenant.getHours();
	var minute=maintenant.getMinutes();
	var seconde=maintenant.getSeconds();
	var lmois=new Array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
	var ljour=new Array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
	var mois=lmois[maintenant.getMonth()];
	var jour=ljour[maintenant.getDay()];
	if(minute<10)minute="0"+minute;
	if(seconde<10)seconde="0"+seconde;
	document.getElementById("horloge").innerHTML =""+jour+" "+nbjour+" "+mois+" "+year+" "+heure+":"+minute+":"+seconde+"";
	setTimeout("horloge()",1000);
}