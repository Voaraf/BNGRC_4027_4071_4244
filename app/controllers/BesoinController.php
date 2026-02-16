<?php

class BesoinController {

    public static function insererBesoin() {
        $pdo = Flight::db();
        $repo = new BesoinRepository($pdo);

        $req = Flight::request();

        $input = [
            'besoin' => $req->data->besoin,
            'ville' => $req->data->ville,
            'quantite' => $req->data->quantite,
            'type' => $req->data->type,
        ];

        $res = Validator::validateBesoin($input);

        if ($res['ok']) {
            $besoin = $repo->insererBesoin($res['values']['besoin'], $res['values']['quantite'], $res['values']['type'], $res['values']['ville']);

            if ($besoin) {
                Flight::redirect('/dashboard');
                return;
            }

            $res['errors']['besoin'] = 'Erreur lors de l\'insertion du besoin.';
        }

        Flight::render('insererBesoin', [
            'values' => $res['values'],
            'errors' => $res['errors'],
            'success' => false
        ]);
    }

    public static function showinsererbesoin() {
        
        $pdo = Flight::db();
        $repo = new UtilRepository($pdo);
        $data = $repo->getAllVille();
        $types = $repo->getType();
        Flight::render('insererBesoin', [
            'values' => ['besoin' => '', 'quantite' => '', 'type' => '', 'ville' => ''],
            'errors' => ['besoin' => '', 'quantite' => '', 'type' => '', 'ville' => ''],
            'success' => false
        ]);
    }
  
}