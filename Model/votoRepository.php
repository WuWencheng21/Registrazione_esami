<?php
namespace Model;

use Util\Connection;

class VotoRepository{

    private function __construct()
    {
    }

    public static function inserisciVoto(float $voto,
                                         int $matricola,
                                         int $tipologia,
                                         int $id_professore):bool {
        $connection = Connection::getInstance();
        $idStudente = StudenteRepository::getIdFromMatricola($matricola);
        $sql = 'INSERT INTO prova (valutazione, tipologia, id_studente, id_professore) '.
            'VALUES(:voto, :tipologia, :id_professore)';
        $stmt = $connection->prepare($sql);
        return $stmt->execute([
            'voto' => $voto,
            'tipologia' => $tipologia,
            'id_studente' => $idStudente,
            'id_professore' => $id_professore,
        ]);
    }

}