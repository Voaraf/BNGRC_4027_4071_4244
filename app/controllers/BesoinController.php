<?php

class BesoinController {

    public static function insererBesoin() {
        $pdo = Flight::db();
        $repo = new BesoinRepository($pdo);

        $req = Flight::request();

        $input = [
            'description' => $req->data->description,
            'ville' => $req->data->ville,
            'quantite' => $req->data->quantite,
            'type' => $req->data->type,
        ];

        $res = Validator::validateBesoin($input);

        if ($res['ok']) {
            $besoin = $repo->insererBesoin($res['values']['description'], $res['values']['quantite'], $res['values']['type'], $res['values']['ville']);

            if ($besoin) {
                Flight::redirect('/besoin');
                return;
            }

            $res['errors']['description'] = 'Erreur lors de l\'insertion du besoin.';
        }

        Flight::render('besoin_form', [
            'values' => $res['values'],
            'errors' => $res['errors'],
            'success' => false
        ]);
    }

    public static function showinsererbesoin() {
        Flight::render('besoin_form', [
            'values' => ['description' => '', 'quantite' => '', 'type' => '', 'ville' => ''],
            'errors' => ['description' => '', 'quantite' => '', 'type' => '', 'ville' => ''],
            'success' => false
        ]);
    }
  
}