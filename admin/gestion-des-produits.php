<?php
$produit = null;

if ($_POST) {
    if (!empty($_POST['photo'])) {
        $photoUrl = URL . 'img/' . $_POST['reference'] . $_FILES['photo']['name'];
        $photoDossier = RACINE . 'img/' . $_POST['reference'] . $_FILES['photo']['name'];

        copy($_FILES['photo']['tmp_name'], $photoDossier);
    }

    extract($_POST);

    $id_produit = $_GET['id_produit'] ? $_GET['id_produit'] : 'NULL';
    
    $replaceQuery = "REPLACE INTO produit 
        (id_produit, reference, categorie, titre, description, couleur, taille, sexe, photo, prix, stock) VALUES ('$id_produit', '$reference', '$categorie', '$titre', '$description', '$couleur', '$taille', '$sexe', 
        '$photoUrl', '$prix', '$stock')";

    $pdo->query($replaceQuery);

    $content .= '<div class="alert alert-success"><p>Le produit à bien été ajouté</p></div>';
}

if (isset($_GET['action']) && $_GET['action'] == 'modifier') {
    $res = $pdo->query("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'");
    $produit = $res->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET['action']) && $_GET['action'] == 'supprimer') {
    $pdo->query("DELETE FROM produit WHERE id_produit = '$_GET[id_produit]'");
}

$getValue = function ($val) use ($produit)
{
    return !is_null($produit) ? $produit[$val] : '';
};


$resultat = $pdo->query('SELECT * FROM produit');

$content .= '<table class="table"><tr>';

for ($i = 0; $i < $resultat->columnCount(); $i++) {
    $colonne = $resultat->getColumnMeta($i);
    $content .= "<th>$colonne[name]</th>";
}
$content .= '<th colspan="2">Action</th>';
$content .= '</tr>';

$produits = $resultat->fetchAll(PDO::FETCH_ASSOC);

foreach($produits as $col) {
    $content .= '<tr>';

    foreach($col as $idx => $valeur) {
        if ($idx == 'photo') {
            $content .= '<td><img height="50px" src="' . $valeur . '" alt=""></td>';   
        } else  {
            $content .= '<td>' . $valeur . '</td>';
        }
    }

    $content .= '<td><a href="?page=gestion-des-produits&action=modifier&id_produit=' . $col['id_produit']. '">Modifier</a></td>';

    $content .= '<td><a href="?page=gestion-des-produits&action=supprimer&id_produit=' . $col['id_produit']. '">Supprimer</a></td>';

    $content .= '</tr>';
}

$content .= '<table>';


$content .= '<div class="container" style="max-width: 600px; margin: auto; margin-top: 25px;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="reference">Référence</label>
            <input type="text" name="reference" class="form-control" id="reference" placeholder="Référence" value="' . $getValue('reference') . '">
        </div>

        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <input type="text" name="categorie" class="form-control" id="categorie" placeholder="Catégorie"  value="' . $getValue('categorie') . '">
        </div>

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre" class="form-control" id="titre" placeholder="Titre"  value="' . $getValue('titre') . '">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" rows="5" name="description">' . $getValue('description') . '</textarea>
        </div>

        <div class="form-group">
            <label for="couleur">Couleur</label>
            <input type="text" name="couleur" class="form-control" id="couleur" placeholder="Couleur"  value="' . $getValue('couleur') . '">
        </div>

        <div class="form-group">
            <label for="taille">Taille</label>
            <select name="taille" id="taille" class="form-control">
                <option value="s">S</option>
                <option value="m" selected>M</option>
                <option value="l">L</option>
                <option value="xl">XL</option>
            </select>
        </div>

        <div class="form-group">
            <label for="sexe">Sexe</label>
            <select name="sexe" id="sexe" class="form-control">
                <option value="m">Homme</option>
                <option value="f">Femme</option>
            </select>
        </div>

        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" accept=".png, .jpg, .jpeg" class="form-control" id="photo" placeholder="Choisissez une photo">';
            if ($getValue('photo')) {
                $content .= 'Photo actuelle: <img src="' . $getValue('photo') . '">';
                $content .=  '<input type="hidden" name="photo_actuelle" value="' . $getValue('photo') . '">';
            }

            $content .= '
        </div>

        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" name="prix" class="form-control" id="prix" placeholder="Prix"  value="' . $getValue('prix') . '">
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="text" name="stock" class="form-control" id="stock" placeholder="Stock"  value="' . $getValue('stock') . '">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter produit</button>
    </form>
    </div>';
?>