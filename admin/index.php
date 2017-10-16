<?php 
require_once('../inc/init.inc.php');

$membre = $_SESSION['membre'];

if (!$membre || ($membre && $membre['statut'] != 1)) {
    header('location:' . URL . '?page=connexion'); exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boutik Admin</title>
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

                <a href="<?= URL ?>" class="navbar-brand">Admin</a>
            </div>

            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="?page=gestion-des-produits">Gestion des produits</a></li>
                    <li><a href="?page=gention-des-membres">Gestion des membres</a></li>
                    <li><a href="?page=gestion-des-commandes">Gestion des commandes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="starter-template">
            <h1>Back office</h1>
            <?= $content ?>
        </div>
    </div>
</body>
</html>