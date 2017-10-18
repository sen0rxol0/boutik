<?php 
$content .= "<h2>Catalogue</h2>";

// $produits = $pdo->query('SELECT * FROM produit')->fetchAll(PDO::FETCH_ASSOC);

$content .= '<div class="container-fluid">';
foreach($produits as $produit) {
    $content .= '<div class="row col-md-6">
                    <div class="produit">
                        <h3>' . $produit['titre'] . '</h3>
                        <img src="' . $produit['photo'] . '">
                        <p>' . $produit['description'] . '</p>
                        
                        <ul class="produit-liste">
                            <li><b>Taille:</b> ' . $produit['taille'] . ' </li>
                            <li><b>Couleur:</b> ' . $produit['couleur'] . '</li>
                            <li><b>Sexe:</b> ' . $produit['sexe'] . '</li>
                            <li><b>Prix:</b> ' . $produit['prix'] . '</li>
                            <li><b>En stock:</b> ' . $produit['stock'] . '</li>
                        </ul>
                    </div>
                </div>';

}

require_once('../layouts/base.php');
?>
