// Chargement de la fenêtre
function load() {
    editArea=opener.editArea;
    document.title= editArea.get_translation(document.title, "template");
    document.body.innerHTML= editArea.get_translation(document.body.innerHTML, "template");

    var liste = window.opener.EditArea_filebrowser.liste;
	var tr = document.getElementById("liste");

    for (var l in liste) {
        var td = document.createElement("td");
        td.innerHtml = l;
        tr.appendChild(td);
    }
}

// Ajouter l'url du fichier dans l'éditeur
function insertUrl(i){
    opener.parent.editAreaLoader.setSelectedText(editArea.id, i);
    range= opener.parent.editAreaLoader.getSelectionRange(editArea.id);
    opener.parent.editAreaLoader.setSelectionRange(editArea.id, range["end"], range["end"]);
    window.focus();
}
