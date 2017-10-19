<?php
require_once('../core/init.core.php');

if ($_GET && $_GET['page']) { 
    
    switch ($_GET['page']) {
        case 'catalogue':
            $titrepage = 'Catalogue - Boutik';
        break;
        case 'profil':
            $titrepage = 'Profile - Boutik';
        break;
        case 'inscription':
            if (isAuthenticated()) {
                header('location:' . URL . '?page=profil');
            }

            $titrepage = 'Inscription - Boutik';
        break;
        case 'connexion':
            if (isAuthenticated()) {
                header('location:' . URL . '?page=profil');
            }
            $titrepage = 'Connexion - Boutik';
        break;
        default:
            $titrepage = '404 - Page introuvable - Boutik';
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