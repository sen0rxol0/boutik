<?php
require_once('inc/init.inc.php');

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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boutik</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL ?>assets/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-dafault navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" type="button" 
                    data-toggle="collapse" data-target="#navbar" 
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a href="<?= URL ?>" class="navbar-brand">Boutique</a>
            </div>

            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="?page=catalogue">Catalogue</a></li>
                    <li><a href="?page=panier">Panier</a></li>
                    <?php if (isset($_SESSION['membre'])) : ?>
                    <li><a href="?page=profil">Profil</a></li>
                    <li><a href="?page=connexion&action=deconnexion">Déconnexion</a></li>
                    <?php else : ?>
                    <li><a href="?page=inscription">S&apos;inscrire</a></li>
                    <li><a href="?page=connexion">Connexion</a></li>
                    <?php endif; 
                    if (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == 1) : ?>
                    <li><a href="<?= URL ?>admin">Back Office</a></li>
                    <?php endif; ?>
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="starter-template">
            <h1>Front office</h1>
            <?= $content ?>
        </div>
    </div>
</body>
</html>