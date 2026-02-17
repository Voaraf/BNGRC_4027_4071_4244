<?php
class BesoinRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function insererBesoin($id_produit, $quantite, $lieu) {
        $st = $this->pdo->prepare(
            "INSERT INTO BNGRC_besoin (id_produit, quantite_besoin, id_ville) VALUES (?, ?, ?)"
        );
        return $st->execute([$id_produit, $quantite, $lieu]);
    }

    public function getAllBesoinVille() {
        $st = $this->pdo->prepare(
            "SELECT p.nom_produit as besoin, t.nom_type, v.nom_ville, v.id_ville, b.id_besoin, b.quantite_besoin 
            FROM BNGRC_besoin b 
            JOIN BNGRC_produits p ON b.id_produit = p.id_produit
            JOIN BNGRC_type t ON p.id_type = t.id_type 
            JOIN BNGRC_ville v ON b.id_ville = v.id_ville 
            WHERE t.id_type != 3 AND b.quantite_besoin > 0"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBesoinById($id) {
        $st = $this->pdo->prepare("SELECT * FROM BNGRC_besoin WHERE id_besoin = ?");
        $st->execute([$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function diminuerQuantiteBesoin($id_besoin, $quantite) {
        $st = $this->pdo->prepare("UPDATE BNGRC_besoin SET quantite_besoin = quantite_besoin - ? WHERE id_besoin = ?");
        return $st->execute([$quantite, $id_besoin]);
    }

}