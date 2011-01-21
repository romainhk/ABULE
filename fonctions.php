<?php
/*
 * Fonctions générales utiles
 */

// Ouvre un flux rss et en fait une présentation
function charger_rss($nbmax) {
    if ($flux = simplexml_load_file('http://linuxfr.org/backend/~patrick_g/journal/rss20.rss')) {
        $ret = '<ul>';
        $donnee = $flux->channel;
        $i = 0;
        foreach($donnee->item as $val) {
            if ( $i < $nbmax ) {
                $ret = $ret.'<li>'.date("d/m/Y",strtotime($val->pubDate))
                    .' - <a href="'.$val->link.'">'.$val->title."</a></li>\n";
              //$ret = $ret.'<br/>'.$val->description.'</li>';
                $i++;
            } else break;
        }
        $ret = $ret."</ul>\n";
    } else $ret = 'Erreur de lecture du flux RSS';
    return $ret;
}

function redirection($page, $temps=1) {
    echo '<script language="javascript">setTimeout("document.location.replace(\'index.php?page='.$page.'\')", '.$temps.');</script>';
}
?>
