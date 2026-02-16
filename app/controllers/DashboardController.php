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
    
}