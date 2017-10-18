<?php
require_once('../core/init.core.php');

if ($_GET && $_GET['page']) { 
    
    switch ($_GET['page']) {
        case 'catalogue':
        break;
        case 'profil':
        break;
        case 'inscription':
        break;
        case 'connexion':
        break;
        default:
            $titrepage = '404';
        break;
    }

    $file = '../pages/' . $_GET['page'] . '.php';

    if (file_exists($file)) {
        $includeFile = $file;
    } else {
        $content .= '<div class="alert alert-danger">La demande n\'a pas pu aboutir</div>';
    }
} else {
    $titrepage = 'Accueil - Boutik';
    $includeFile = '../pages/accueil.php';
}

require_once('../layouts/base.php');
?>