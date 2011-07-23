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
 * Ajoute une l�gende aux images munies d'un attribut "title"
 */
function alignement_des_images() {
    var les_images = document.getElementsByTagName("img");
    for each (img in les_images) {
        if (img.nodeType != undefined) {
            var a = img.parentNode;
            if (a.nodeName == "A") {
                if (img.className.search(/^img_/) != -1) {
                    var title = img.getAttribute('title');
                    if ( title == null ) { title = ''}
                    // Ajoute de la l�gende
                    var b = a.cloneNode(true);
                    var div = document.createElement('div');
                    var cote = img.className.split("_")[1];
                    div.className = 'legende_' + cote;
                    div.appendChild(b);
                    var n = document.createElement('p');
                    n.innerHTML = title;
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

/*
 * Boite d�roulante
 */
var boite_deroulante_enrouler = '\u21B0';
var boite_deroulante_derouler  = 'ouvrir \u21B4';

// Enroule / D�roule une boite
function toggle_boite_deroulante(index) {
    var toggle = document.getElementById("toggle_" + index);
    var contenu = document.getElementById("contenu_" + index);

    if (!toggle || !contenu) return; 
    if (toggle.innerHTML == boite_deroulante_enrouler) {
        contenu.style.display = 'none';
        toggle.innerHTML = boite_deroulante_derouler;
    } else {
        contenu.style.display = 'block';
        toggle.innerHTML = boite_deroulante_enrouler;
    }
}

// Cr�er les boites d�roulantes
function boite_deroulante(Element){
    if(!Element) Element = document;
    var divs = Element.getElementsByTagName("div");
    var bd_index = 0;
    for(var i=0,l=divs.length;i<l;i++){
        if(hasClass(divs[i], "boite")){
            var boite = divs[i];
            bd_index++;

            var boite_toggle = document.createElement("a");
            boite_toggle.className = 'boite_toggle';
            boite_toggle.id = 'toggle_' + bd_index;
            boite_toggle.href = 'javascript:toggle_boite_deroulante(' + bd_index + ');';
            boite_toggle.innerHTML = boite_deroulante_derouler;
 
            boite.insertBefore( boite_toggle, boite.firstChild );
            var contenu = document.getElementById("contenu_" + bd_index);
        }
    }
}

/*
 * R�cup�r� depuis wikip�dia
 */
function hasClass(node, className) {
    var haystack = node.className;
    if(!haystack) return false;
    if (className === haystack) {
        return true;
    }
    return (" " + haystack + " ").indexOf(" " + className + " ") > -1;
}

/*
 * Ajax
 */
var xhr = null;
function getXMLHttpRequest() {
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	
	return xhr;
}

function demander_archives(callback, annee) {
    if (xhr && xhr.readyState != 0) {
		xhr.abort();
	}
	xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};

	xhr.open("GET", "archives.php?annee=" + annee, true);
	xhr.send(null);
}

function lire_archives(sData) {
    var filles = document.getElementById("filles");
    if (filles) {
        filles.parentNode.removeChild(filles);
    }
    var corps = document.getElementById("corps");
    if (!corps) { return ; }
    corps.innerHTML = corps.innerHTML + sData;
    alignement_des_images();
    boite_deroulante();
}

