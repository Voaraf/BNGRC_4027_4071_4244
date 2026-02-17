<?php
class AchatsController {

    public static function showAchats() {
        $pdo = Flight::db();
        $repo = new UtilRepository($pdo);
        $besoinRepo = new BesoinRepository($pdo);
        
        $req = Flight::request();
        $villeId = $req->query->ville;
        
        $data = $repo->getAllAchats($villeId);
        $besoin = $besoinRepo->getAllBesoinVille();
        $villes = $repo->getAllVille();

        Flight::render('achats', [
            'data' => $data,
            'besoin' => $besoin,
            'villes' => $villes,
            'selected_ville' => $villeId
        ]);
        
    }

    public static function insererAchat() {
        $pdo = Flight::db();
        $repo = new BesoinRepository($pdo);
        $stockageRepo = new StockageRepository($pdo);
        $achatsRepo = new AchatsRepository($pdo);
        
        $req = Flight::request();
        $input = [
            'besoin_ville' => $req->data->besoin_ville,
            'quantite' => $req->data->quantite
        ];
        
        $res = Validator::validateAchat($input);
        if ($res['ok']) {
            $id_besoin = $res['values']['besoin_ville'];
            $quantite = $res['values']['quantite'];
            
            $besoinDetails = $repo->getBesoinById($id_besoin);
            
            if ($achatsRepo->insertAchat($id_besoin, $quantite)) {
                if ($besoinDetails) {
                     $stockageRepo->ajouterStock($besoinDetails['besoin'], $besoinDetails['id_ville'], $besoinDetails['type_besoin'], $quantite);
                     $repo->diminuerQuantiteBesoin($id_besoin, $quantite);
                }
                Flight::redirect('/achats');
                return;
            }
        }
        
        $besoin = $repo->getAllBesoinVille();
        $repoUtil = new UtilRepository($pdo);
        $villes = $repoUtil->getAllVille();
        $data = $repoUtil->getAllAchats(); 

        Flight::render('achats', [
            'besoin' => $besoin,
            'villes' => $villes,
            'data' => $data, 
            'values' => $res['values'],
            'errors' => $res['errors']
        ]);
        
    }

}