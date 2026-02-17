<?php

class AchatsRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function insertAchat($id_besoin, $quantite_achetee) {
        $st_prod = $this->pdo->prepare("
            SELECT p.prix_unitaire 
            FROM BNGRC_besoin b 
            JOIN BNGRC_produits p ON b.id_produit = p.id_produit 
            WHERE b.id_besoin = ?
        ");
        $st_prod->execute([$id_besoin]);
        $res = $st_prod->fetch(PDO::FETCH_ASSOC);
        
        if (!$res) {
            return false;
        }
        
        $prix_unitaire = $res['prix_unitaire'] ?? 0;
        $montant_total = $quantite_achetee * $prix_unitaire;
        
        $st = $this->pdo->prepare(
            "INSERT INTO BNGRC_achats (id_besoin, quantite_achetee, montant_total) VALUES (?, ?, ?)"
        );
        return $st->execute([$id_besoin, $quantite_achetee, $montant_total]);
    }
}