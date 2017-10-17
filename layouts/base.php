<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $titrepage ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL ?>assets/css/styles.css">
</head>
<body>

    <?php require_once('inc/header.inc.php'); ?>

    <div class="container">
        <div class="starter-template">
            <h1>Front office</h1>
            <?= $content ?>
        </div>
    </div>
</body>
</html>