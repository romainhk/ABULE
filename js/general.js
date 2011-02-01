/*
 * Horloge
 */
calend = new Object();
calend.lmois=new Array("janvier","f\u00E9vrier","mars","avril","mai","juin","juillet","ao\u00FBt","septembre","octobre","novembre","d\u00E9cembre");
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
    conf = window.confirm("\u00CAtes-vous s\u00FBre de vouloir supprimer la page \u00AB "+abule.suppr+" \u00BB ?");
    return conf;
}

/*
 * Ajoute une légende aux images munies d'un attribut "name"
 */
function img_avec_legende() {
    var les_images = document.getElementsByTagName("img");
    for each (img in les_images) {
        if (img.nodeType != undefined) {
            var name = img.getAttribute('title');
            if ( name != null ) {
                var a = img.parentNode;
                if (a.nodeName == "A") {
                    // Ajoute de la légende
                    var b = a.cloneNode(true);
                    var div = document.createElement('div');
                    div.className = 'legende';
                    div.appendChild(b);
                    var n = document.createElement('p');
                    n.innerHTML = name;
                    div.appendChild(n);
                    a.parentNode.replaceChild(div, a);
                }
            }
        }
    }
}

/*
 * Formulaire de contact
 */
function verif_mail(){
	var email=document.forms["contact"].elements["from"].value;
	var valide1=email.indexOf('@');
	var valide2=email.lastIndexOf('.');
	if(valide1==-1||valide2<valide1) alert("Veuillez saisir une adresse email valide.");
	else document.forms["contact"].submit();	
}

function efface(){
	var mail="Votre message ici.";
	var test=document.forms["contact"].elements["mess"].value.indexOf(mail);
	if(test==0){
		document.forms["contact"].elements["mess"].value="";
	}
}
