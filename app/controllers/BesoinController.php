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
            $besoin = $repo->insererBesoin($res['values']['description'], $res['values']['quantite'], $res['values']['type'], $res['values']['ville']);

            if ($besoin) {
                Flight::redirect('/dashboard');
                return;
            }

            $res['errors']['description'] = 'Erreur lors de l\'insertion du besoin.';
        }

        Flight::render('insererBesoin', [
            'values' => $res['values'],
            'errors' => $res['errors'],
            'success' => false
        ]);
    }

    public static function showinsererbesoin() {
        Flight::render('insererBesoin', [
            'values' => ['description' => '', 'quantite' => '', 'type' => '', 'ville' => ''],
            'errors' => ['description' => '', 'quantite' => '', 'type' => '', 'ville' => ''],
            'success' => false
        ]);
    }
  
}