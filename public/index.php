<?php
require_once('../core/init.core.php');

$uri = explode('/', $_SERVER['REQUEST_URI']);

prind_r($uri);

echo $_SERVER['REQUEST_URI'];


// Route it up!
// switch ($request_uri[0]) {
//     // Home page
//     case '/':
//         require '../views/home.php';
//         break;
//     // About page
//     case '/about':
//         require '../views/about.php';
//         break;
//     // Everything else
//     default:
//         header('HTTP/1.0 404 Not Found');
//         require '../views/404.php';
//         break;
// }

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