<?php
class AchatsController {

    public static function showAchats() {
        $pdo = Flight::db();
        $repo = new UtilRepository($pdo);
        $besoinRepo = new BesoinRepository($pdo);
        $data = $repo->getAllAchats();
        $besoin = $besoinRepo->getAllBesoinVille();
        $villes = $repo->getAllVille();
        Flight::render('achats', [
            'villes' => $villes,
            'data' => $data,
            'besoin' => $besoin
        ]);
        
    }

    public static function insererAchat() {
        $pdo = Flight::db();
        $repo = new BesoinRepository($pdo);
        $stockageRepo = new StockageRepository($pdo);
        $produitRepo = new ProduitRepository($pdo);
        $achatsRepo = new AchatsRepository($pdo);

        $req = Flight::request();
        $input = [
            'besoin_ville' => $req->data->besoin_ville,
            'quantite' => $req->data->quantite
        ];
        
        $res = Validator::validateAchat($input);
        if ($res['ok']) {
            $achatsRepo->insertAchat($res['values']['besoin_ville'], $res['values']['quantite']);
            
            $besoinDetails = $repo->getBesoinById($res['values']['besoin_ville']);
            if ($besoinDetails) {
                $produit = $produitRepo->getProduitById($besoinDetails['id_produit']);
                $stockageRepo->ajouterStock($produit['nom_produit'], $produit['id_type'], $res['values']['quantite']);
            }
            Flight::redirect('/achats');
            return;
        }
        
        $utilRepo = new UtilRepository($pdo);
        Flight::render('achats', [
            'besoin' => $repo->getAllBesoinVille(),
            'villes' => $utilRepo->getAllVille(),
            'data' => $utilRepo->getAllAchats(),
            'values' => $res['values'],
            'errors' => $res['errors']
        ]);
    }

}