/*
 * Horloge
 */
date = new Object();
date.lmois=new Array("janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre");
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
    document.getElementById("horloge").innerHTML = jour+" "+nbjour+"&nbsp;"+date.mois+" "+date.year+" "+heure+":"+minute+":"+seconde;
    setTimeout("horloge()",999);
}

/*
 * Confirmation de la suppression d'une page
 */
abule = new Object();
abule.suppr = "";
function conf_suppr() {
    conf = window.confirm("Êtes-vous sûre de vouloir supprimer la page « "+abule.suppr+" » ?");
    return conf;
}
