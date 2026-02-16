<?php

class DistributionController {
     public static function showDistribution() {
        
        $pdo = Flight::db();
        $repo = new UtilRepository($pdo);
        $data = $repo->getAllVille();
        Flight::render('insererBesoin', [
     
        ]);
    }
}