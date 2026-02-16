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