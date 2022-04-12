<?php

require '../conf/config.php';
require '../vendor/autoload.php';
use League\Plates\Engine;

$dsn = 'mysql:host=' . HOSTNAME . ';dbname=' . DBNAME . ';charset=utf8';

try {
    $pdo = new PDO($dsn, USERNAME, PASSWORD);
} catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
}

$stmt = $pdo->query('SELECT id, cognome, nome, matricola, voto, id_corso FROM studente GROUP BY nome');

$result = $stmt->fetchAll();
var_dump($result);

$templates = new League\Plates\Engine('templates', 'phtml');


echo $templates->render('studente_elenco',
    [
        'studente' => $result
    ]);