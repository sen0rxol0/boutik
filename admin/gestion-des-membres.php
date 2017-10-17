<?php 
$membre = null;

if ($_POST) {
    $req = "SELECT pseudo, email FROM membre WHERE pseudo = '$_POST[pseudo]' OR email = '$_POST[email]'";
    $res = $pdo->query($req);

    if ($res->rowCount() >= 1) {
        $m = $res->fetch(PDO::FETCH_ASSOC);
        $match = $m['pseudo'] == $_POST['pseudo'] ? 'Pseudo' : 'Email';
        $content .= '<div class="alert alert-danger"><p>' . $match . ' déjà prise</p></div>';
    } else {
        $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

        extract($_POST);

        $id_membre = $_GET['id_membre'] ? $_GET['id_membre'] : 'NULL';

        $req = "REPLACE INTO membre 
            (id_membre, pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut, date_enregistrement) 
            VALUES ('$id_membre', '$pseudo', '$mdp', '$nom', '$prenom', '$email', '$civilite', '$ville', '$code_postal', '$adresse', '$statut', NOW())";

        $pdo->query($req);
    }
}

if (isset($_GET['action']) && empty($_POST)) {
    switch ($_GET['action']) {
        case 'supprimer':
            $req = "DELETE FROM membre WHERE id_membre = '$_GET[id_membre]'";
            $pdo->query($req);

            $content .= '<div class="alert alert-success"><p>Membre à bien été supprimé</p></div>';
        break;
        case 'modifier':
            $req = "SELECT * FROM membre WHERE id_membre = '$_GET[id_membre]'";
            $membre = $pdo->query($req)->fetch(PDO::FETCH_ASSOC);
            // header('location:' . URL . 'admin?page=gestion-des-membres')
        break;
        default:
        // header('location:' . URL . 'admin?page=gestion-des-membres' )
        break;
    }
}

$getValue = function ($val) use ($membre)
{
    return !is_null($membre) ? $membre[$val] : '';
};


$res = $pdo->query('SELECT * FROM membre');

$content .= '<table class="table"><tr>';
for ($i = 0; $i < $res->columnCount(); $i++) {
    $col = $res->getColumnMeta($i);
    $content .= '<th>' . $col['name'] . '</th>';
}

$content .= '<th colspan="2">Action</th>';
$content .= '</tr>';

$membres = $res->fetchAll(PDO::FETCH_ASSOC);

foreach ($membres as $m) {
    $content .= '<tr>';

    foreach ($m as $idx => $val) {
        if ($idx == 'mdp') {
            $content .= '<td></td>';
        } else {
            $content .= '<td>' . $val . '</td>';            
        }
    }

    $content .= '<td><a href="?page=gestion-des-membres&action=modifier&id_membre=' . $m['id_membre'] . '">Modifier</td>';
    $content .= '<td><a href="?page=gestion-des-membres&action=supprimer&id_membre=' . $m['id_membre'] . '">Supprimer</td>';

    $content .= '</tr>';
}

$content .= '</tr></table>';

$content .= '<div class="container" style="max-width: 600px; margin: auto; margin-top: 25px;">
    <form action="" method="post">
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="Pseudo" value="' . $getValue('pseudo') . '">
        </div>

        <div class="form-group">
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" class="form-control" id="mdp" placeholder="Mot de passe">
        </div>

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" id="nom" placeholder="Votre nom" value="' . $getValue('nom') . '">
        </div>

        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Votre prenom" value="' . $getValue('prenom') . '">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Adresse mail" value="' . $getValue('email') . '">
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
            <input type="text" name="ville" class="form-control" id="ville" placeholder="Votre ville" value="' . $getValue('ville') . '">
        </div>

        <div class="form-group">
            <label for="code_postal">Code Postal</label>
            <input type="text" name="code_postal" class="form-control" id="code_postal" placeholder="Code Postal" value="' . $getValue('code_postal') . '">
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <textarea id="adresse" class="form-control" rows="5" name="adresse">' . $getValue('adresse') . '</textarea>
        </div>

        <div class="form-group">
            <label for="statut">Administrator</label>
            <select name="statut" id="statut" class="form-control">
                <option value="0">Non admin</option>
                <option value="1">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter membre</button>
    </form>
    </div>';
?>