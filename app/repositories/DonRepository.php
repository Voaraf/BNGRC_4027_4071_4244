<?php
class DonRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function insertDon($data) {
        $st = $this->pdo->prepare(
            "INSERT INTO BNGRC_donation (type_donation, donneur, donation, quantite_donnee) VALUES (?, ?, ?, ?)"
        );
        $donation_normalisee = strtolower(trim($data['donation']));
        $st->execute([
            $data['type_donation'],
            $data['donneur'],
            $donation_normalisee,
            $data['quantite_donnee']
        ]);

        
        return $this->pdo->lastInsertId();
    }

    public function getAllDons() {
        $st = $this->pdo->prepare(
            "SELECT * FROM BNGRC_donation ORDER BY created_at DESC"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}
