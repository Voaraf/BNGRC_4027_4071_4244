<?php
class AchatsController {

    public static function showAchats() {
        $pdo = Flight::db();
        $repo = new UtilRepository($pdo);
        $data = $repo->getAllAchats();
        Flight::render('achats', [
            'data' => $data
        ]);
        
    }

}