<?php
require_once('../includes/init.inc.php');

if ($_GET) { 
// s'il y a une information dans l'url, c'est que l'internaute a clique sur l'un des liens
    $file = '../pages/' . $_GET['page'] . '.php';

    // @todo : implement a switch on all the pages and show a 404

    if (file_exists($file)) {
        require_once($file);
    } else {
        $content .= '<div class="alert alert-danger">La demande n\'a pas pu aboutir</div>';
    }
} else {
    require_once('../pages/accueil.php');
}
?>