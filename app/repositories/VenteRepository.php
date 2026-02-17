<?php

class VenteRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllStockDispo() {
        $st = $this->pdo->prepare("
            SELECT * FROM v_verifierSiStockDispo
        ");
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);   
    }

    public function getStockById($id) {
        $st = $this->pdo->prepare("
            SELECT 
                s.*,
                t.nom_type,
                COALESCE((
                    SELECT prix FROM BNGRC_prix_unitaire pu 
                    WHERE pu.type = s.id_type 
                    ORDER BY pu.date_mise_a_jour DESC LIMIT 1
                ), 0) as prix_unitaire
            FROM BNGRC_stock s
            JOIN BNGRC_type t ON s.id_type = t.id_type
            WHERE s.id_stock = ?
        ");
        $st->execute([$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function getRemises() {
        $st = $this->pdo->prepare("SELECT * FROM BNGRC_remise ORDER BY pourcentage ASC");
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertVente($id_stock, $quantite_vendue, $montant_total) {
        try {
            $this->pdo->beginTransaction();
            
            // Insert vente
            $st = $this->pdo->prepare("INSERT INTO BNGRC_vente (id_stock, quantite_vendue, montant_total) VALUES (?, ?, ?)");
            $st->execute([$id_stock, $quantite_vendue, $montant_total]);
            
            // Update stock quantity
            $st = $this->pdo->prepare("UPDATE BNGRC_stock SET quantite = quantite - ? WHERE id_stock = ?");
            $st->execute([$quantite_vendue, $id_stock]);
            
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}