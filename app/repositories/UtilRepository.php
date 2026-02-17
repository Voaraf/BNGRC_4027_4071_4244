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

    public function argentDisponible() {
        $st = $this->pdo->prepare(
            "SELECT SUM(d.quantite_donnee) AS total_argent_globale
            FROM BNGRC_donation d WHERE d.type_donation IN (SELECT id_type FROM BNGRC_type WHERE nom_type = 'Argent')"
        );
        $st->execute();
        $result = $st->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['total_argent_globale'] : 0;

    }

    public function getAllAchats($id_ville = null) {
        $sql = "SELECT a.id_achat, b.besoin, b.quantite_besoin, t.nom_type, a.montant_total, a.date_achat, v.nom_ville
            FROM BNGRC_achats a
            JOIN BNGRC_besoin b ON a.id_besoin = b.id_besoin
            JOIN BNGRC_type t ON b.type_besoin = t.id_type
            JOIN BNGRC_ville v ON b.id_ville = v.id_ville";
        
        $params = [];
        if ($id_ville) {
            $sql .= " WHERE b.id_ville = ?";
            $params[] = $id_ville;
        }

        $sql .= " ORDER BY a.date_achat DESC";
        
        $st = $this->pdo->prepare($sql);
        $st->execute($params);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}