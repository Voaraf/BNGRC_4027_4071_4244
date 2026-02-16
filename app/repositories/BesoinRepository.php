<?php
class BesoinRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function insererBesoin($description, $quantite, $type, $lieu) {
        $st = $this->pdo->prepare(
            "INSERT INTO BNGRC_besoin (type_besoin, besoin, quantite_besoin, id_ville) VALUES (?, ?, ?, ?)"
        );
        return $st->execute([$type, $description, $quantite, $lieu]);
    }
}