<?php

class DistributionController {
     public static function showInsererDistribution() {
        
        $pdo = Flight::db();
        $repo = new UtilRepository($pdo);
        $stockRepo = new StockageRepository($pdo);
        $stock = $stockRepo->viewStock();
        $data = $repo->getAllVille();
        Flight::render('insererDistribution', [
            'stock' => $stock,
            'data' => $data,
            'values' => ['besoin' => '', 'quantite' => '', 'ville' => ''],
            'errors' => ['besoin' => '', 'quantite' => '', 'ville' => ''],
            'success' => false   
        ]);
    }

    public static function insererDistribution() {
        $pdo = Flight::db();
        $repo = new DistributionRepository($pdo);
        $stockRepo = new StockageRepository($pdo);
        $req = Flight::request();
        $repoUtil = new UtilRepository($pdo);

        $input = [
            'besoin' => strtolower(trim((string)$req->data->besoin)),
            'quantite' => $req->data->quantite,
            'ville' => $req->data->ville
        ];

        $res = Validator::validateDistribution($input);

        if ($res['ok']) {
            $besoin = $repo->findBesoin($res['values']['besoin'], $res['values']['ville']);
            
            if ($besoin) {
                $repo->insertDistribution($besoin['id_besoin'], $res['values']['quantite']);
                $stockRepo->retirerStock($res['values']['besoin'], $besoin['type_besoin'], $res['values']['quantite']);
                $besoinRepo = new BesoinRepository($pdo);
                $besoinRepo->diminuerQuantiteBesoin($besoin['id_besoin'], $res['values']['quantite']);
                Flight::redirect('/');
                return;
            } else {
                $res['errors']['besoin'] = "Aucun besoin trouvé avec ce nom.";
            }
        }
        
        $data = $repoUtil->getAllVille();
        $st = $stockRepo->viewStock();
        Flight::render('insererDistribution', [
            'stock' => $st,
            'data' => $data,
            'values' => $res['values'],
            'errors' => $res['errors'],
            'success' => false
        ]);
    }
}