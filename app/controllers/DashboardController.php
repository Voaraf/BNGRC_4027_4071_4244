<?php 
class DashboardController {
    public static function afficherTableauDeBord() {
        Flight::render('dashboard');
    }

    public static function afficherListeVilles() {
        $pdo = Flight::db();
        $repo = new DashboardRepository($pdo);
        $data = $repo->obtenirVillesAvecStatistiques();

        Flight::render('villes', [
            'data' => $data
        ]);
    }

    public static function recapitulatifJSON() {
        $pdo = Flight::db();
        $repo = new DashboardRepository($pdo);
        $data = $repo->obtenirDonneesRecapitulatif();
        Flight::json($data);
    }
    
    public static function afficherVilleParId($id) {
        $pdo = Flight::db();
        $repoUtil = new UtilRepository($pdo);
        $ville = $repoUtil->getVilleById($id);
        
        $repo = new DashboardRepository($pdo);
        $data = $repo->obterBesoinsParVilleId($id);
        $distributions = $repo->obtenirDistributionsParVilleId($id);

        if (!$ville) {
            Flight::notFound();
            return;
        }

        Flight::render('villeById', [
            'ville' => $ville,
            'data' => $data,
            'distributions' => $distributions
        ]);
    }

   
}
