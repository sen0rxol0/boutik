<?php

// Connexion a la BDD

$bdd = 'mysql:host=localhost;dbname=boutique';
$options =  [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
];

$pdo = new PDO($bdd, 'root', '', $options);

define('URL', 'http://localhost/base_site/');
define('RACINE', $_SERVER['DOCUMENT_ROOT'] . '/base_site/');

// echo 'url : ' . URL . '<br>';
// echo 'racine : ' . RACINE . '<br>';

// Récupération des fonctions
require_once('fonctions.inc.php');

// Démarrage de la session
session_start();

// definition des variables partages
$content = '';

$titrepage = '';

?>