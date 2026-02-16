<?php
class UtilRepository{
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllVille() {
        $st = $this->pdo->prepare(
            "SELECT * FROM BNGRC_ville"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getType() {
        $st = $this->pdo->prepare(
            "SELECT * FROM BNGRC_type"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVilleById($id) {
        $st = $this->pdo->prepare(
            "SELECT * FROM BNGRC_ville WHERE id_ville = ?"
        );
        $st->execute([$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
        
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

    public function argentDisponible() {
        $st = $this->pdo->prepare(
            "SELECT SUM(d.quantite_donnee) AS total_argent_globale
            FROM BNGRC_donation d WHERE d.type_donation IN (SELECT id_type FROM BNGRC_type WHERE nom_type = 'Argent')"
        );
        $st->execute();
        $result = $st->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['total_argent_globale'] : 0;

    }

    public function getAllAchats() {
        $st = $this->pdo->prepare(
            "SELECT a.id_achat, b.besoin, b.quantite_besoin, t.nom_type, a.montant_total, a.date_achat
            FROM BNGRC_achats a
            JOIN BNGRC_besoin b ON a.id_besoin = b.id_besoin
            JOIN BNGRC_type t ON b.type_besoin = t.id_type
            ORDER BY a.date_achat DESC"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    
}