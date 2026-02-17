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
        $req = Flight::request();
        $input = [
            'besoin_ville' => $req->data->besoin_ville,
            'quantite' => $req->data->quantite,
            'type' => $req->data->type
        ];
        $achatsRepo = new AchatsRepository($pdo);
        $res = Validator::validateAchat($input);
        if ($res['ok']) {
            $achatsRepo->insertAchat($res['values']['besoin_ville'], $res['values']['quantite'], $res['values']['type']);
            // Récupérer le nom du besoin et le type (ville ignorée pour le stock global)
            $besoinDetails = $repo->getBesoinById($res['values']['besoin_ville']);
            if ($besoinDetails) {
                $stockageRepo->ajouterStock($besoinDetails['besoin'], $besoinDetails['type_besoin'], $res['values']['quantite']);
            }
            Flight::redirect('/achats');
            return;
        }
        $besoin = $repo->getAllBesoinVille();
        Flight::render('achats', [
            'besoin' => $besoin,
            'values' => $res['values'],
            'errors' => $res['errors']
        ]);
        
    }

}