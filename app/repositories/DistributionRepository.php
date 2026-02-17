<?php
class DistributionRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findBesoin($besoin_nom, $id_ville) {
        $st = $this->pdo->prepare("SELECT * FROM BNGRC_besoin WHERE besoin = ? AND id_ville = ? LIMIT 1");
        $st->execute([$besoin_nom, $id_ville]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function insertDistribution($id_besoin, $quantite) {
        $st = $this->pdo->prepare("INSERT INTO BNGRC_distribution (id_donation, id_besoin, quantite_donnee) VALUES (NULL, ?, ?)");
        return $st->execute([$id_besoin, $quantite]);
    }

    
}
