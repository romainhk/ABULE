<?php
/*
 * ### Lister
 * Liste des pages
 */
?>
<h1>Liste des pages</h1>
<p>Liste des pages existantes, classée par numéro d'ordre.</p>
<?php
    echo '<table cellspacing="5" cellpadding="2" style="margin:1ex;">'."\n";
    echo '<tr><th style="text-align:center;">Nom de la page</th><th>Ordre</th></tr>'."\n";
    $liste = menu_ordonne($db, NULL, 1);
    foreach ($liste as $l) {
        $decalage = ($l['niveau']-1)*5;
        echo '<tr><td style="padding-left:'.$decalage.'ex;">';
        echo '<a href="?page='.protect_url($l['nom']).'">'.$l['nom'].'</a></td>';
        echo '<td style="text-align:right;">'.$l['ordre'];
        echo str_repeat('&nbsp;&nbsp;&nbsp;', 3-$l['niveau'])."</td></tr>\n";
    }
    echo "</table>\n";
?>
