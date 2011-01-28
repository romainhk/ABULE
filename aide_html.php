<?php
# Rien à faire :)
?>
<h1>Aide Html</h1>
<p>L'<a href="http://fr.wikipedia.org/wiki/Hypertext_Markup_Language">HTML</a> est un langage permettant de présenter des documents qui repose sur l'utilisation de balises. Une balise est reparable par des chevrons : < et >.</p>
<p>Par exemple, un paragraphe sera délimité par la balise ouvrante &#60;p> et la fermante &#60;/p> :</p>
<pre>&#60;p>Un jolie paragraphe.&#60;/p></pre>

<h3>Liste des balises utuelles</h3>
<ul>
    <li>p : paragraphe</li>
    <li>i : italique</li>
    <li>b : gras (bold)</li>
    <li>h1 jusque h6 : titre de niveau 1 à 6 resp.</li>
    <li>pre : texte non formatté</li>
    <li>u : souligner (underscore)</li>
    <li>ul : liste à puce</li>
    <li>ol : liste numérotée</li>
    <li>li : élément de liste (pour ol et ul)</li>
    <li>dl : liste de définition</li>
    <li>dt : liste de définition : titre</li>
    <li>dd : liste de définition : défintion</li>
    <li>span : élément de texte générique</li>
</ul>
<p>Certaines balises nécessitent des paramètres. Voir <a href="http://fr.selfhtml.org/html/index.htm">selfhtml.org</a> pour une liste complète des balises et de leurs paramètres.</p>
<ul>
    <li>a : lien hypertexte ;<ul>
        <li>href : l'url</li>
        <li>title et alt : texte alternatif quand le lien est survolé par exemple</li>
        </ul></li>
    <li>img : image ;<ul>
        <li>src : l'url de l'image</li>
        <li>alt : texte alternatif quand l'image est inaccessible</li>
        <li>width/height : largeur/hauteur de l'image</li>
        </ul></li>
</ul>

<h3>Exemples</h3>
<h5>Paragraphe simple</h5>
<pre>
&#60;h3>Histoire&#60;/h3>
&#60;p>&#60;b>Assommé&#60;/b>, &#60;i>balancé&#60;/i>...&#60;/p>
&#60;p>Je ne pris pourtant pas &#60;a href="http://...">parti&#60;/a>.&#60;/p>
</pre>
<h5>Listes</h5>
<pre>
&#60;ol>
&#60;li>Premier&#60;/li>
&#60;li>Second&#60;/li>
&#60;/ol>
&#60;ul>
&#60;li>Premier&#60;/li>
&#60;li>Second&#60;/li>
&#60;/ul>
&#60;dl>
&#60;dt>Terme&#60;/dt>
&#60;dd>Supposant que l'impôt doit tomber sur le dos d'une cuirasse de protection.&#60;/dd>
&#60;dt>Autre terme&#60;/dt>
&#60;dd>Bêta, lui dit-il tout bas, et par des lectures attentives et reposées...&#60;/dd>
&#60;/dl>
</pre>
