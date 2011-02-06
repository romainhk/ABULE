<?php
define("FICHIER_RSS", "flux.rss");
$liste = bdd_lister($db);

// Ajoute un élément au flux rss
function ajouter_news($fichier, $titre, $cible){
	$element_channel = $fichier->getElementById("news");
	
	$element_item = $fichier->createElement("item");
	$element_item = $element_channel->appendChild($element_item);
	
	$element_title = $fichier->createElement("title");
	$element_title = $element_item->appendChild($element_title);
	$texte_title = $fichier->createTextNode($titre);
	$texte_title = $element_title->appendChild($texte_title);
	
	$element_link = $fichier->createElement("link");
	$element_link = $element_item->appendChild($element_link);
	$texte_link = $fichier->createTextNode('index.php?page='.$cible);
	$texte_link = $element_link->appendChild($texte_link);
	
	$element_date = $fichier->createElement("pubDate");
	$element_date = $element_item->appendChild($element_date);
	$texte_date = $fichier->createTextNode(date("d/m"));
	$texte_date = $element_date->appendChild($texte_date);
}

if (isset($_POST['titre']) and isset($_POST['cible']) and !empty($_POST['cible'])) {
    $rss = new DOMDocument();
    $rss->load(FICHIER_RSS); 
    ajouter_news($rss, $_POST['titre'], $_POST['cible']);
    $rss->save(FICHIER_RSS);
    redirection('', 1);
}
?>
<h1>Publier une news</h1>
<form id="news" method="post" action="">
<table class="form_news"><tr>
    <td><label for="titre">Titre de la news : </label></td>
    <td><input type="text" id="titre" name="titre" size="35" /></td>
</tr><tr>
    <td><label for="cible">Page cible : </label></td>
    <td><?php #PHP

    echo '<select name="cible" size="1">';
    echo '<option selected="selected" value="">...</option>'."\n";
    foreach ($liste as $l) {
        echo '<option value="'.$l['nom'].'">'.$l['nom']."</option>\n";
    }
    echo "</select>\n";
?> 
    </td>
</tr><tr>
    <td colspan="2" style="text-align:right;">
        <input type="submit" id="submit" name="submit" value="Créer la news" /></td>
</tr></table>
</form>
