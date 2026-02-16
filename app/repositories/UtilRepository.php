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

    public function getTypeDonation() {
        $st = $this->pdo->prepare(
            "SELECT * FROM BNGRC_type"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVilleById($id) {
        $st = $this->pdo->prepare(
            "SELECT * FROM BNGRC_ville WHERE id = ?"
        );
        $st->execute([$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
        
    }
}