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
}