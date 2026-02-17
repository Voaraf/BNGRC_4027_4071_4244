<?php

class VenteRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllStockDispo() {
        $st = $this->pdo->prepare("
            SELECT 
                v.*,
                COALESCE((
                    SELECT prix FROM BNGRC_prix_unitaire pu 
                    WHERE pu.type = v.id_type 
                    ORDER BY pu.date_mise_a_jour DESC LIMIT 1
                ), 0) as prix_unitaire
            FROM v_verifierSiStockDispo v
        ");
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