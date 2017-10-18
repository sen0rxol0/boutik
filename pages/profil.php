<?php
if (!isset($_SESSION['membre'])) {
    header('location:' . URL . '?page=connexion');
}
extract($_SESSION['membre']);

// Affichage des informations du membre
$content .= 'Bonjour <strong>' . $pseudo . '</strong><hr>';

$content .= '<ul class="info-liste" style="list-style: none;">
                <li class="info-item">Nom: <b>' . $nom . '</b></li>
                <li class="info-item">Prenom: <b>' . $prenom . '</b></li>
                <li class="info-item">Email: <b>' . $email . '</b></li>
                <li class="info-item">Civilite: <b>' . $civilite . '</b></li>
                <li class="info-item">Ville: <b>' . $ville . '</b></li>
                <li class="info-item">Code Postal: <b>' . $code_postal . '</b></li>
                <li class="info-item">Adresse: <b> ' . $adresse . '</b></li>
            </ul>';

require_once('../layouts/base.php');
?>

