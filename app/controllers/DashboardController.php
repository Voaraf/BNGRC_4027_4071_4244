<?php 
class DashboardController {
    public static function showDashboard() {
        $pdo = Flight::db();
        $repo = new UtilRepository($pdo);
        $data = $repo->getAllVille();

        Flight::render('dashboard', [
            'data' => $data
        ]);
    }
    
    public static function showVilleById($id) {
        $pdo = Flight::db();
        $repo = new UtilRepository($pdo);
        $ville = $repo->getVilleById($id);

        if (!$ville) {
            Flight::notFound();
            return;
        }

        Flight::render('villeById', [
            'ville' => $ville
        ]);
    }
}
