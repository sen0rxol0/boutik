<?php

// Connexion a la BDD
$bdd = 'mysql:host=db;port=3306;dbname=boutique';
$options =  [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
];

$pdo = new PDO($bdd, 'root', 'secret', $options);

// echo $_SERVER['SERVER_PORT'];

define('URL', 'http://' . $_SERVER['SERVER_NAME'] . ':8080/');
define('RACINE', $_SERVER['DOCUMENT_ROOT'] . '/');

// echo 'url : ' . URL . '<br>';
// echo 'racine : ' . RACINE . '<br>';

// Récupération des fonctions
require_once('fonctions.core.php');

// Démarrage de la session
session_start();

// definition des variables partages
$content = '';

$titrepage = '';
?>