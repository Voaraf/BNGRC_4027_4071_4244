<?php

class VenteRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllStockDispo() {
        $st = $this->pdo->prepare("SELECT * FROM v_verifierSiStockDispo");
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);   
    }
}