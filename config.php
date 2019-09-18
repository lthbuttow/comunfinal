<?php
require 'environment.php';

$config = array();
if(ENVIRONMENT == 'development') {
    define("BASE_URL", "http://localhost/projetocomun/");
    $config['dbname'] = 'projeto_comun';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    define("BASE_URL", "https://www.projetocomun.com/");
    $config['dbname'] = 'u781441844_mvc';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'u781441844_lth';
    $config['dbpass'] = ']u@w8/oM';
}


global $db;
try {
    // $db = new PDO('mysql:host=127.0.0.1;dbname=mvc_psr4', 'root', '');
    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
    echo "ERRO: ".$e->getMessage();
    exit;
}