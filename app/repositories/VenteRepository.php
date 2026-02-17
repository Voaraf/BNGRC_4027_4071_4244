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

    public function insertVente($id_stock, $quantite_vendue, $montant_total) {
        $st = $this->pdo->prepare("INSERT INTO BNGRC_vente (id_stock, quantite_vendue, montant_total) VALUES (?, ?, ?)");
        return $st->execute([$id_stock, $quantite_vendue, $montant_total]);
    }
}