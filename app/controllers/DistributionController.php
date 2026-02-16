<?php

class DistributionController {
     public static function showInsererDistribution() {
        
        $pdo = Flight::db();
        $repo = new UtilRepository($pdo);
        $data = $repo->getAllVille();
        Flight::render('insererDistribution', [
            'data' => $data,
            'values' => ['besoin' => '', 'quantite' => '', 'type' => '', 'ville' => ''],
            'errors' => ['besoin' => '', 'quantite' => '', 'type' => '', 'ville' => ''],
            'success' => false   
        ]);
    }
}