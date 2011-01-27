/*
 * Horloge
 */
calend = new Object();
calend.lmois=new Array("janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre");
calend.ljour=new Array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
calend.maintenant = new Date();
calend.year=calend.maintenant.getFullYear();
calend.mois=calend.lmois[calend.maintenant.getMonth()];

function horloge() {
    calend.maintenant = new Date();
    var nbjour=calend.maintenant.getDate();
    var heure=calend.maintenant.getHours();
    var minute=calend.maintenant.getMinutes();
    var seconde=calend.maintenant.getSeconds();

    var jour=calend.ljour[calend.maintenant.getDay()];
    if (minute<10) minute="0"+minute;
    if (seconde<10) seconde="0"+seconde;
    document.getElementById("horloge").innerHTML = jour+" "+nbjour+"&nbsp;"+calend.mois+" "+calend.year+" "+heure+":"+minute+":"+seconde;
    setTimeout("horloge()",999);
}

/*
 * Confirmation de la suppression d'une page
 */
abule = new Object();
abule.suppr = "";
function conf_suppr() {
    conf = window.confirm("Etes-vous sure de vouloir supprimer la page \""+abule.suppr+"\" ?");
    return conf;
}
