date = new Object();
date.lmois=new Array("janvier","f�vrier","mars","avril","mai","juin","juillet","ao�t","septembre","octobre","novembre","d�cembre");
date.ljour=new Array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
date.maintenant = new Date();
date.year=date.maintenant.getFullYear();
date.mois=date.lmois[date.maintenant.getMonth()];

function horloge() {
    date.maintenant = new Date();
    var nbjour=date.maintenant.getDate();
    var heure=date.maintenant.getHours();
    var minute=date.maintenant.getMinutes();
    var seconde=date.maintenant.getSeconds();

    var jour=date.ljour[date.maintenant.getDay()];
    if (minute<10) minute="0"+minute;
    if (seconde<10) seconde="0"+seconde;
    document.getElementById("horloge").innerHTML = jour+" "+nbjour+" "+date.mois+" "+date.year+" "+heure+":"+minute+":"+seconde;
    setTimeout("horloge()",998);
}

