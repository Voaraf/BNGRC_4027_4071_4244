<?php
class DashboardRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getDashboardData() {
        $st = $this->pdo->prepare(
            "SELECT b.type_besoin, b.besoin, b.quantite_besoin, v.nom_ville
             FROM BNGRC_besoin b
             JOIN BNGRC_ville v ON b.id_ville = v.id_ville"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}  