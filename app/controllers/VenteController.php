<?php

class VenteController {
    public static function showVente() {
        $pdo = Flight::db();
        $venteRepo = new VenteRepository($pdo);
        
        $id_stock = $_GET['id_stock'] ?? null;
        
        if ($id_stock) {
            $item = $venteRepo->getStockById($id_stock);
            $remises = $venteRepo->getRemises();
            Flight::render('vente', [
                'item' => $item,
                'remises' => $remises,
                'errors' => []
            ]);
        } else {
            $stockDispo = $venteRepo->getAllStockDispo();
            Flight::render('catalogue', [
                'stockDispo' => $stockDispo
            ]);
        }
    }

    public static function insererVente() {
        $pdo = Flight::db();
        $venteRepo = new VenteRepository($pdo);
        
        $id_stock = $_POST['id_stock'] ?? null;
        $quantite = $_POST['quantite'] ?? 0;
        $id_remise = $_POST['id_remise'] ?? 0;
        
        $item = $venteRepo->getStockById($id_stock);
        if (!$item) {
            Flight::redirect('/vente?error=not_found');
            return;
        }

        $res = Validator::validateVente(['quantite' => $quantite, 'id_stock' => $id_stock], $item['quantite']);

        if (!$res['ok']) {
            $remises = $venteRepo->getRemises();
            Flight::render('vente', [
                'item' => $item,
                'remises' => $remises,
                'errors' => $res['errors']
            ]);
            return;
        }

        $base_total = $quantite * $item['prix_unitaire'];
        $pourcentage = 0;
        
        if ($id_remise > 0) {
            $remises = $venteRepo->getRemises();
            foreach($remises as $r) {
                if ($r['id_remise'] == $id_remise) {
                    $pourcentage = $r['pourcentage'];
                    break;
                }
            }
        }
        
        $montant_total = $base_total * (1 - ($pourcentage / 100));

        try {
            $venteRepo->insertVente($id_stock, $quantite, $montant_total);
            Flight::redirect('/vente?success=1');
        } catch (Exception $e) {
            Flight::error($e);
        }
    }
}