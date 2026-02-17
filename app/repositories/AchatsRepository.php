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
        $st_type = $this->pdo->prepare("SELECT type_besoin FROM BNGRC_besoin WHERE id_besoin = ?");
        $st_type->execute([$id_besoin]);
        $res_type = $st_type->fetch(PDO::FETCH_ASSOC);
        
        if (!$res_type) {
            return false;
        }
        
        $type_besoin = $res_type['type_besoin'];

        $prix_unitaire = $this->getPrixUnitaireByType($type_besoin);
        
        if ($prix_unitaire === null) {
            $prix_unitaire = 0;
        }

        $montant_total = $quantite_achetee * $prix_unitaire;
        
        $st = $this->pdo->prepare(
            "INSERT INTO BNGRC_achats (id_besoin, quantite_achetee, montant_total) VALUES (?, ?, ?)"
        );
        return $st->execute([$id_besoin, $quantite_achetee, $montant_total]);

    }
}