<?php

$GLOBALS['config'] = require 'config.php';
// echo $_SERVER['SERVER_PORT'];

define('URL', 'http://' . $_SERVER['SERVER_NAME'] . ':8080/');
define('RACINE', $_SERVER['DOCUMENT_ROOT'] . '/');

// echo 'url : ' . URL . '<br>';
// echo 'racine : ' . RACINE . '<br>';

require '../app/Database.php';

$db = new App\Database($config['db']);

// Récupération des fonctions
require_once('fonctions.php');

// Démarrage de la session
session_start();

// definition des variables partages
$content = '';

$titrepage = '';
?>