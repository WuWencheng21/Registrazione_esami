<?php

namespace Model;

use Util\Connection;

class VotoRepository{

    private function __construct()
    {
    }

    public static function inserisciVoto(float $voto,
                                         int $matricola_studente,
                                         string $esito,
                                         string $tipo_esame,
                                         string $dataEsame,
                                         string $id_professore):bool {
        $dataEsame = strtotime($dataEsame);
        $data = date('Y-m-d',$dataEsame);
        $connection = Connection::getInstance();
        $sql = 'INSERT INTO esame (matricola_studente, id_professore, voto, data, esito, tipo_esame)'.'
        VALUES(:matricola_studente, :id_professore, :voto, :data, :esito, :tipo_esame)';
        $stmt = $connection->prepare($sql);
        return $stmt->execute([
            'voto' => $voto,
            'matricola_studente' => $matricola_studente,
            'esito' => $esito,
            'id_professore' => $id_professore,
            'data' => $data,
            'tipo_esame' => $tipo_esame
        ]);
    }

    public static function visualizzaElencoVoto(string $matricola):array{
        $connection = Connection::getInstance();
        $sql = 'SELECT * FROM esame
WHERE matricola_studente = :matricola';
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            'matricola' => $matricola
        ]);
        $data = $stmt->fetch();
        return $data;
    }
}