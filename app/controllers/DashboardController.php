<?php 
class DashboardController {
    public static function showDashboard() {
        $pdo = Flight::db();
        $repo = new DashboardRepository($pdo);
        $data = $repo->getDashboardData();

        Flight::render('dashboard', [
            'data' => $data
        ]);
    }
    
}