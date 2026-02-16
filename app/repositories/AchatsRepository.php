<?php

class AchatsRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

     public function getPrixUnitaireByType($typeId) {
        $st = $this->pdo->prepare(
            "SELECT prix FROM BNGRC_prix_unitaire WHERE type = ? ORDER BY date_mise_a_jour DESC LIMIT 1"

        );
        $st->execute([$typeId]);
        $result = $st->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['prix'] : null;
    }

    public function insertAchat($id_besoin, $quantite_achetee) {
        $montant_total = $quantite_achetee * $this->getPrixUnitaireByType($id_besoin);
        
        $st = $this->pdo->prepare(
            "INSERT INTO BNGRC_achats (id_besoin, quantite_achetee, montant_total) VALUES (?, ?, ?)"
        );
        return $st->execute([$id_besoin, $quantite_achetee, $montant_total]);

    }
}