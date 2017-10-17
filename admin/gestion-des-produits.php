<?php

if ($_POST) {
    // debug($_FILES);

    if (!empty($_POST['photo'])) {

        // if (isset($_POST['photo_actuelle'])) {
            
        // } else {
        // }
        
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

    $content .= '<div class="alert alert-success"><p>Le produit a bien été ajouté</p></div>';
}

$resultat = $pdo->query('SELECT * FROM produit');

$content .= '<table class="table"><tr>';

for ($i = 0; $i < $resultat->columnCount(); $i++) {
    $colonne = $resultat->getColumnMeta($i);
    $content .= "<th>$colonne[name]</th>";
}
$content .= '<th colspan="2">Action</th>';
$content .= '</tr>';

$produits = $resultat->fetchAll(PDO::FETCH_ASSOC);

foreach($produits as $produit) {
    $content .= '<tr>';

    foreach($produit as $idx => $valeur) {
        if ($idx == 'photo') {
            $content .= '<td><img height="50px" src="' . $valeur . '" alt=""></td>';   
        } else  {
            $content .= '<td>' . $valeur . '</td>';
        }
    }

    $content .= '<td><a href="?page=gestion-des-produits&action=modifier&id_produit=' . $produit['id_produit']. '">Modifier</a></td>';

    $content .= '<td><a href="?page=gestion-des-produits&action=supprimer&id_produit=' . $produit['id_produit']. '">Supprimer</a></td>';

    $content .= '</tr>';
}

$content .= '<table>';

if (isset($_GET['action']) && $_GET['action'] == 'modifier') {
    $res = $pdo->query("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'");
    $produit = $res->fetch(PDO::FETCH_ASSOC);
}


// $id_produit = $produit['id_produit'] ?? ''; // ternary operation
$id_produit = $produit['id_produit'] ? $produit['id_produit'] : '';
$reference = $produit['reference'] ? $produit['reference'] : ''; 
$categorie = $produit['categorie'] ? $produit['categorie'] : ''; 
$titre = $produit['titre'] ? $produit['titre'] : ''; 
$description = $produit['description'] ? $produit['description'] : ''; 
$couleur = $produit['couleur'] ? $produit['couleur'] : ''; 
$taille = $produit['taille'] ?  $produit['taille'] : ''; 
$sexe = $produit['sexe'] ? $produit['sexe'] : '';
$photo = $produit['photo'] ? $produit['photo'] : '';
$prix = $produit['prix'] ? $produit['prix'] : '';
$stock = $produit['stock'] ? $produit['stock'] : '';



// if (isset($produitValeurs)) {
//     extract($produitValeurs);
//     echo $prix;
// }  else {
    
//     for ($i = 0; $i < $resultat->columnCount(); $i++) {
//         $colonne = $resultat->getColumnMeta($i);
//         // $$colonne['name'] = '';
//         echo $colonne['name'];
//         // echo ${$colonne['name']};

//         // echo $$colonne['name'];
//     }
// }


if (isset($_GET['action']) && $_GET['action'] == 'supprimer') {
    $pdo->query("DELETE FROM produit WHERE id_produit = '$_GET[id_produit]'");
}

$content .= '<div class="container" style="max-width: 600px; margin: auto; margin-top: 25px;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="reference">Référence</label>
            <input type="text" name="reference" class="form-control" id="reference" placeholder="Référence" value="' . $reference . '">
        </div>

        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <input type="text" name="categorie" class="form-control" id="categorie" placeholder="Catégorie"  value="' . $categorie . '">
        </div>

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre" class="form-control" id="titre" placeholder="Titre"  value="' . $titre . '">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" rows="5" name="description">' . $description . '</textarea>
        </div>

        <div class="form-group">
            <label for="couleur">Couleur</label>
            <input type="text" name="couleur" class="form-control" id="couleur" placeholder="Couleur"  value="' . $couleur . '">
        </div>

        <div class="form-group">
            <label for="taille">Taille</label>
            <select name="taille" id="taille" class="form-control">
                <option value="s">S</option>
                <option value="m">M</option>
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
            if (!empty($photo)) {
                $content .= 'Photo actuelle: <img src="' . $photo . '">';
                $content .=  '<input type="hidden" name="photo_actuelle" value="' . $photo . '">';
            }

            $content .= '
        </div>

        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" name="prix" class="form-control" id="prix" placeholder="Prix"  value="' . $prix . '">
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="text" name="stock" class="form-control" id="stock" placeholder="Stock"  value="' . $stock . '">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter produit</button>
    </form>
    </div>';
?>