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

    public static function inserisciStudente(string $matricola,
                                              string $nome,
                                              string $cognome,
                                              int $id_corso):bool{
        $connection = Connection::getInstance();
        $sql = 'INSERT INTO studente (matricola, nome, cognome, id_corso)'.'
        VALUES(:matricola, :nome, :cognome, :id_corso)';
        $stmt = $connection->prepare($sql);
        return $stmt->execute([
            'matricola' => $matricola,
            'nome' => $nome,
            'cognome' => $cognome,
            'id_corso' => $id_corso
        ]);
    }
}