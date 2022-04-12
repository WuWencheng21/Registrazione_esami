<?php

namespace Model;

use Util\Connection;

class StudenteRepository{

    private function __construct()
    {
    }

    public static function getIdFromMatricola(string $matricola):array{
        $connection = Connection::getInstance();
        $sql = 'SELECT id, matricola, nome, cognome, id_corso FROM studente WHERE matricola = :matricola';
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            'matricola' => $matricola
        ]);
        $data = $stmt->fetch();
        return $data;
    }
}