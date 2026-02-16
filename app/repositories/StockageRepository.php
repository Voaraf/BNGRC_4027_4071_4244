<?php
class StockageRepository {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getStockByDetails($nom_besoin, $id_ville, $id_type) {
        $nom_besoin = strtolower(trim($nom_besoin));
        $stmt = $this->pdo->prepare('SELECT * FROM BNGRC_stock WHERE nom_besoin = ? AND id_ville = ? AND id_type = ?');
        $stmt->execute([$nom_besoin, $id_ville, $id_type]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function ajouterStock($nom_besoin, $id_ville, $id_type, $quantite) {
        $nom_besoin = strtolower(trim($nom_besoin));
        $stock = $this->getStockByDetails($nom_besoin, $id_ville, $id_type);
        if ($stock) {
            $stmt = $this->pdo->prepare('UPDATE BNGRC_stock SET quantite = quantite + ? WHERE id_stock = ?');
            $stmt->execute([$quantite, $stock['id_stock']]);
        } else {
            $stmt = $this->pdo->prepare('INSERT INTO BNGRC_stock (nom_besoin, id_ville, id_type, quantite) VALUES (?, ?, ?, ?)');
            $stmt->execute([$nom_besoin, $id_ville, $id_type, $quantite]);
        }
    }

    public function retirerStock($nom_besoin, $id_ville, $id_type, $quantite) {
        $nom_besoin = strtolower(trim($nom_besoin));
        $stock = $this->getStockByDetails($nom_besoin, $id_ville, $id_type);
        if ($stock && $stock['quantite'] >= $quantite) {
            $stmt = $this->pdo->prepare('UPDATE BNGRC_stock SET quantite = quantite - ? WHERE id_stock = ?');
            $stmt->execute([$quantite, $stock['id_stock']]);
        }
    }

    public function getStockDetails() {
        $sql = 'SELECT s.id_stock, s.nom_besoin, s.quantite, s.date_maj, v.nom_ville, t.nom_type
                FROM BNGRC_stock s
                JOIN BNGRC_ville v ON s.id_ville = v.id_ville
                JOIN BNGRC_type t ON s.id_type = t.id_type
                ORDER BY v.nom_ville, t.nom_type, s.nom_besoin';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
