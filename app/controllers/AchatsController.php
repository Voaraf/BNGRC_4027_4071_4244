<?php
class AchatsController {

    public static function showAchats() {
        $pdo = Flight::db();
        $repo = new UtilRepository($pdo);
        $besoinRepo = new BesoinRepository($pdo);
        $data = $repo->getAllAchats();
        $besoin = $besoinRepo->getAllBesoinVille();
        Flight::render('achats', [
            'data' => $data,
            'besoin' => $besoin
        ]);
        
    }

}