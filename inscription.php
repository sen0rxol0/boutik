<?php
$erreur = '';

if ($_POST && !empty($_POST)) {
    //controle de la taille du pseudo

    if (strlen($_POST['pseudo']) <= 3 || strlen($_POST['pseudo']) > 20) {
        $erreur .= '<div class="alert alert-danger">
                        <b>Erreur taille pseudo:</b> 
                        <p>* doit contenir entre 3 a 20 caractères!</p>
                    </div>';
    }

    $resultat = exec_req("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");

    if ($resultat->rowCount() >= 1) {
        $erreur .= '<div class="alert alert-danger">Pseudo déjà prise</div>';
    }

    if (empty($erreur)) {
        $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_BCRYPT); //hashage du mot de passe

        foreach($_POST as $idx => $val) {
            $_POST[$idx] = htmlspecialchars($val);
        }

        extract($_POST);

        $insertQuery = "INSERT INTO membre 
            (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, date_enregistrement) VALUES ('$pseudo', '$mdp', '$nom', '$prenom', '$email', '$civilite', 
            '$ville', '$code_postal', '$adresse', NOW())";

        exec_req($insertQuery);

        header('location:' . URL . '?page=connexion&inscription=1');
    }

    $content .= $erreur;
}
$content .= '<div class="container" style="max-width: 400px; margin: auto; margin-top: 25px;">
    <form action="" method="post">
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Pseudo">
        </div>

        <div class="form-group">
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" class="form-control" id="mdp" placeholder="Mot de passe">
        </div>

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" id="nom" placeholder="Votre nom">
        </div>

        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Votre prenom">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Adresse mail">
        </div>

        <div class="form-group">
            <label>Civilite</label> <br>
            <label class="radio-inline">
                <input type="radio" name="civilite" value="m"> Home
            </label>
            <label class="radio-inline">
                <input type="radio" name="civilite" value="f"> Femme
            </label>
        </div>

        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" name="ville" class="form-control" id="ville" placeholder="Votre ville">
        </div>

        <div class="form-group">
            <label for="code_postal">Code Postal</label>
            <input type="text" name="code_postal" class="form-control" id="code_postal" placeholder="Code Postal">
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <textarea id="adresse" class="form-control" rows="5" name="adresse"></textarea>
        </div>

        <button type="submit" class="btn btn-default">S\'inscrire</button>
    </form>
    </div>';
?>