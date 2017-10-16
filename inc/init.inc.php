<?php

$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ]);

define('URL', 'http://localhost/base_site/');
define('RACINE', $_SERVER['DOCUMENT_ROOT'] . 'base_site/');


echo 'url : ' . URL . '<br>';
echo 'racine : ' . RACINE . '<br>';