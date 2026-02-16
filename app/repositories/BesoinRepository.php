<?php
class BesoinRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function insererBesoin($description, $quantite, $type, $lieu) {
        // Normalisation : tout en minuscules, trim espaces
        $description_normalisee = strtolower(trim($description));
        $st = $this->pdo->prepare(
            "INSERT INTO BNGRC_besoin (type_besoin, besoin, quantite_besoin, id_ville) VALUES (?, ?, ?, ?)"
        );
        return $st->execute([$type, $description_normalisee, $quantite, $lieu]);
    }

    public function getAllBesoinVille() {
        $st = $this->pdo->prepare(
            "SELECT b.besoin, t.nom_type, v.nom_ville, v.id_ville, b.quantite_besoin FROM BNGRC_besoin b 
            JOIN BNGRC_type t ON b.type_besoin = t.id_type 
            JOIN BNGRC_ville v ON b.id_ville = v.id_ville 
            WHERE t.id_type != 3"
        );
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

}