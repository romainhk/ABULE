<?php
/*
 * Fonctions générales utiles
 */
require_once('db.php');

// Ouvre un flux rss et en fait une présentation
function charger_rss($url, $nbmax) {
    if ($flux = simplexml_load_file($url)) {
        $ret = '<ul>';
        $donnee = $flux->channel;
        $i = 0;
        foreach($donnee->item as $val) {
            if ( $i < $nbmax ) {
                $ret = $ret.'<li>'.$val->pubDate.' &#183; <a href="'.$val->link.'">'.$val->title."</a></li>\n";
                $i++;
            } else break;
        }
        $ret = $ret."</ul>\n";
    } else $ret = false;
    return $ret;
}

// Ajoute une redirection javascript à la page
function redirection($page, $temps=1) {
    echo '<script language="javascript">setTimeout("document.location.replace(\'index.php?page='.protect_url($page).'\')", '.$temps.');</script>';
}

// Fonction de convertion d'accents
function retirer_accents($s) {
	$pattern = array(
		'/à/', '/À/', '/á/', '/Á/', '/â/', '/Â/', '/ã/', '/Ã/', '/ä/', '/Ä/', '/ç/', '/Ç/', 
		'/é/', '/É/', '/è/', '/È/', '/ê/', '/Ê/', '/ë/', '/Ë/', 
		'/ì/', '/Ì/', '/í/', '/Í/', '/î/', '/Î/', '/ï/', '/Ï/', '/ñ/', '/Ñ/',
		'/ò/', '/Ò/', '/ó/', '/Ó/', '/ô/', '/Ô/', '/ö/', '/Ö/',
		'/ù/', '/Ù/', '/ú/', '/Ú/', '/û/', '/Ü/', '/ü/', '/Ü/', '/ý/', '/Ý/', '/ÿ/');
	$replace = array(
		'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'A', 'c', 'C', 
		'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E',
		'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'n', 'N',
		'o', 'O', 'o', 'O',	'o', 'O', 'o', 'O',
		'u', 'U', 'u', 'U',	'u', 'U', 'u', 'U',	'y', 'Y', 'y');
	return preg_replace($pattern, $replace, $s);
}

// Liste d'option triée par parenté, $pere est selectionné
function option_parente($pere='', $excl='', $niveaux=array(1,2)) {
    global $db;
    foreach (menu_ordonne($db, NULL, 1) as $lp) {
        $niveau = $lp['niveau'];
        if ( in_array($niveau, $niveaux) ) {
            $nom = $lp['nom'];
            if ( strcmp($nom, $excl) ) {
                if (!strcmp($pere, $nom)) {
                    $sel = ' selected="selected"';
                } else { $sel = ''; }
                echo '<option value="'.urlencode($nom).'"'.$sel.'>'.str_repeat('#', $niveau-1).' '.$nom.'</option>'."\n";
            }
        }
    }
}

// Protège une url des quotes
function protect_url($mot) {
    return preg_replace("/ /", '%20', preg_replace("/'/", '%27', preg_replace('/"/', '%22', stripslashes($mot))));
}

// Le lien modifier/déplacer
function lien_modifier($page) {
    $page = protect_url($page);
    $ret  = '<div class="modifier"><a href="?page='.$page.'&action=deplacer">Déplacer</a>'."<br />\n";
    $ret .= '<a href="?page='.$page.'&action=modifier">Modifier</a></div>'."\n";
    return $ret;
}

// Affiche un message d'avertissement/d'erreur
// Niveaux :
//    1) Avertissement / Notification
//    2) Message important
function message($mess, $niveau=2) {
    switch ($niveau) {
    case 1:
        $class = 'message_avertissement';
        break;
    case 2;
    default:
        $class = 'message_important';
        break;
    }
    return "\n<p class=\"$class\">$mess</p>\n";
}

// Charger les pages filles en boite déroulante
function pages_filles($filles) {
    global $db;
    global $index_bd;
    $r = "<div id=\"filles\">\n";
    foreach ($filles as $f) {
        $nom = $f['nom'];
        $d = bdd_charger($db, $nom);
        if (is_string($d)) {
            $r .= '<div class="boite" id="boite_'.$index_bd.'">';
            $r .= '<div class="boite_titre">'.stripslashes($nom).'&nbsp;(<a href="index.php?page='.stripslashes($nom).'" title="Lien vers la sous-page">&gt;</a>)</div>';
            $r .= '<div class="boite_contenu" id="contenu_'.$index_bd.'">';
            if (isset($_SESSION['login'])) {
                $r .= lien_modifier($nom);
            }
            $r .= $d.'</div></div>'."\n";
            $index_bd++;
        } else {
            $r .= message("Impossible de charger la sous-page « $page »");
        }
    }
    return $r."</div>\n";
}

?>
