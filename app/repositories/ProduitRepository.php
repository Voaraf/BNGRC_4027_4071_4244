<?php
class ProduitRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function insertProduit($nom, $id_type, $prix_unitaire) {
        $st = $this->pdo->prepare(
            "INSERT INTO BNGRC_produits (nom_produit, id_type, prix_unitaire) VALUES (?, ?, ?)"
        );
        return $st->execute([$nom, $id_type, $prix_unitaire]);
    }

    public function getAllProduits() {
        $st = $this->pdo->prepare(
            "SELECT p.*, t.nom_type 
             FROM BNGRC_produits p 
             JOIN BNGRC_type t ON p.id_type = t.id_type 
             ORDER BY p.nom_produit ASC"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduitById($id) {
        $st = $this->pdo->prepare("SELECT * FROM BNGRC_produits WHERE id_produit = ?");
        $st->execute([$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }
}
