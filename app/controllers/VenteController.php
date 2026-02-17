<?php

class VenteController {
    public static function showVente() {
        $pdo = Flight::db();

        $venteRepo = new VenteRepository($pdo);
        $stockDispo = $venteRepo->getAllStockDispo();
        Flight::render(
            'vente', ['stockDispo' => $stockDispo]
        );
    }

    public static function insererVente() {
        $pdo = Flight::db();
        $venteRepo = new VenteRepository($pdo);
        
        $id_stock = $_POST['id_stock'] ?? null;
        $quantite = $_POST['quantite'] ?? null;
        $prix_unitaire = $_POST['prix_unitaire'] ?? null;
        
        if (!$id_stock || !$quantite || !$prix_unitaire) {
            Flight::redirect('/vente?error=missing_fields');
            return;
        }
        
        $montant_total = $quantite * $prix_unitaire;
        
        try {
            $venteRepo->insertVente($id_stock, $quantite, $montant_total);
            Flight::redirect('/vente?success=1');
        } catch (Exception $e) {
            Flight::redirect('/vente?error=insertion_failed');
        }
    }
}