date = new Object();
date.lmois=new Array("janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre");
date.ljour=new Array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");

function horloge() {
    var maintenant = new Date();
    var year=maintenant.getFullYear();
    var nbjour=maintenant.getDate();
    var heure=maintenant.getHours();
    var minute=maintenant.getMinutes();
    var seconde=maintenant.getSeconds();

    var mois=date.lmois[maintenant.getMonth()];
    var jour=date.ljour[maintenant.getDay()];
    if (minute<10) minute="0"+minute;
    if (seconde<10) seconde="0"+seconde;
    document.getElementById("horloge").innerHTML = jour+" "+nbjour+" "+mois+" "+year+"<br />"+heure+":"+minute+":"+seconde;
    setTimeout("horloge()",990);
}
