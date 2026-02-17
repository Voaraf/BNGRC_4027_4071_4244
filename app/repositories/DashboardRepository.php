<?php
class DashboardRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function obtenirDonneesTableauDeBord() {
        $st = $this->pdo->prepare(
            "SELECT b.type_besoin, b.besoin, b.quantite_besoin, v.nom_ville
             FROM BNGRC_besoin b
             JOIN BNGRC_ville v ON b.id_ville = v.id_ville"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterBesoinsParVilleId($id) {
        $st = $this->pdo->prepare(
            "SELECT b.type_besoin, b.besoin, b.quantite_besoin, t.icone_type, t.nom_type
             FROM BNGRC_besoin b
            JOIN BNGRC_type t ON b.type_besoin = t.id_type
             WHERE b.id_ville = ? AND b.quantite_besoin > 0"
        );
        $st->execute([$id]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenirDonneesRecapitulatif() {
        $st = $this->pdo->prepare("SELECT * FROM v_statistiques_recap");
        $st->execute();
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenirVillesAvecStatistiques() {
        $st = $this->pdo->prepare(
            "SELECT v.*, 
            (SELECT COALESCE(SUM(a.montant_total), 0) 
             FROM BNGRC_achats a 
             JOIN BNGRC_besoin b ON a.id_besoin = b.id_besoin 
             WHERE b.id_ville = v.id_ville) as total_achats
             FROM BNGRC_ville v"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenirDistributionsParVilleId($id) {
        $st = $this->pdo->prepare(
            "SELECT d.quantite_donnee as quantite, d.date_distribution as date_mouv, b.besoin, t.nom_type, 'Distribution' as source
             FROM BNGRC_distribution d
             JOIN BNGRC_besoin b ON d.id_besoin = b.id_besoin
             JOIN BNGRC_type t ON b.type_besoin = t.id_type
             WHERE b.id_ville = ?
             
             UNION ALL
             
             SELECT a.quantite_achetee as quantite, a.date_achat as date_mouv, b.besoin, t.nom_type, 'Achat' as source
             FROM BNGRC_achats a
             JOIN BNGRC_besoin b ON a.id_besoin = b.id_besoin
             JOIN BNGRC_type t ON b.type_besoin = t.id_type
             WHERE b.id_ville = ?
             
             ORDER BY date_mouv DESC"
        );
        $st->execute([$id, $id]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}  