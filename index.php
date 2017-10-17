<?php
require_once('inc/init.inc.php');
$titrepage = 'Boutik';

if ($_GET) { 
// s'il y a une information dans l'url, c'est que l'internaute a clique sur l'un des liens
    $file = $_GET['page'] . '.php';

    if (file_exists($file)) {
        require_once($file);
    } else {
        $content .= '<div class="alert alert-danger">La demande n\'a pas pu aboutir</div>';
    }
}
?>
<?php
require_once('layouts/base.php');
?>