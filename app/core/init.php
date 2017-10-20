<?php

$GLOBALS['config'] = include './config.php';

// echo $_SERVER['SERVER_PORT'];

define('URL', 'http://' . $_SERVER['SERVER_NAME'] . ':8080/');
define('RACINE', $_SERVER['DOCUMENT_ROOT'] . '/');

// echo 'url : ' . URL . '<br>';
// echo 'racine : ' . RACINE . '<br>';

$db = "mysql:host={$config['dbhost']};port={$config['dbport']};dbname={$config['dbname']}";

$options =  [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
];

$pdo = new PDO($db, $config['dbuser'], $config['dbpass'], $options);

// Récupération des fonctions
require_once('fonctions.php');

// Démarrage de la session
session_start();

// definition des variables partages
$content = '';

$titrepage = '';
?>