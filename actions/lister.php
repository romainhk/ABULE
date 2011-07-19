<h1>Liste des pages</h1>
<p>Liste classée des pages existantes.</p>
<?php
    echo '<table cellspacing="5" cellpadding="2">'."\n";
    echo "<tr><th>Nom</th><th>Ordre</th></tr>\n";
    $liste = menu_ordonne($db, NULL, 1);
    foreach ($liste as $l) {
        echo '<tr><td>'.str_repeat('&nbsp;&nbsp;&nbsp;', $l['niveau']-1);
        echo '<a href="?page='.protect_url($l['nom']).'">'.$l['nom'].'</a></td>';
        echo '<td>'.$l['ordre']."</td></tr>\n";
    }
    echo "</table>\n";
?>
