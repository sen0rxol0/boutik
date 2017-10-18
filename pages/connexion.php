<?php
if (isset($_GET['inscription'])) {
    $content .= '<div class="alert alert-success"> Votre inscription a été validée, vous pouvez désormais vous connecter! </div>';
}

if (isset($_SESSION['membre'])) {
    header('location:' . URL . '?page=profil');
}

// S'il y a une action dans les arguments d'URL, alors j'unset la clé membre de la session.
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
    unset($_SESSION['membre']);
}

// GESTION DE CONNEXION
if ($_POST) {

    $erreur = '';

    if (!strlen($_POST['mdp'])) {
         $erreur .= '<div class="alert alert-danger">
                        <p>Veuillez renseigner votre mot de passe !</p>
                    </div>';
    }

    if (empty($erreur)) {
        $query = $pdo->prepare('SELECT * FROM membre WHERE pseudo = :pseudo');
        $query->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        
        if ($query->rowCount() != 0) {
            $membre = $query->fetch(PDO::FETCH_ASSOC);

            if (password_verify($_POST['mdp'], $membre['mdp'])) {

                extract($membre);

                $noSession = [
                    'date_enregistrement',
                    'date_modification',
                    'mdp',
                    'id_membre'
                ];

                foreach ($membre as $idx => $val) {
                    if (in_array($idx, $noSession)) {
                        continue;
                    }

                    $_SESSION['membre'][$idx] = $val;
                }

                header('location:' . URL . '?page=profil');

            } else {
                $erreur .= '<div class="alert alert-danger">
                                <p><b>Connexion échouée :</b> Erreur de mot de passe !</p>
                            </div>';
            }
        } else {
            $erreur .= '<div class="alert alert-danger">
                            <p><b>Connexion échouée :</b> Erreur de pseudo !</p>
                        </div>';
        }
    }

    $content .= $erreur;
}

?>

<?= $content ?>

<div class="container" style="margin-top: 25px;">
    <div class="col-md-4">
        <div class="panel panel-default">
            <h3 class="panel-title">Connexion</h3>
        </div>

        <div class="panel-body">
            <form action="" method="post" style="max-width: 400px; margin: auto;">
                <div class="form-group">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Pseudo">
                </div>

                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" name="mdp" class="form-control" id="mdp" placeholder="Mot de passe">
                </div>

                <button type="submit" class="btn btn-default">Se connecter</button>
            </form>
        </div>
    </div>
</div>