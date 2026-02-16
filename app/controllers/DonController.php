<?php
session_start();
class DonController {

  public static function showinsererDon() {

    $pdo = Flight::db();
    $repo = new UtilRepository($pdo);
    $data = $repo->getAllVille();
    $types = $repo->getType();
    Flight::render('insererDon', [
      'data' => $data,
      'types' => $types,
      'values' => [
        'type_donation' => '',
        'donneur' => '',
        'donation' => '',
        'quantite_donnee' => ''
      ],
      'errors' => [
        'type_donation' => '',
        'donneur' => '',
        'donation' => '',
        'quantite_donnee' => ''
      ],
      'success' => false
    ]);
  }

  public static function insererDon() {
    $pdo  = Flight::db();
    $repo = new DonRepository($pdo);

    $req = Flight::request();

    $input = [
        'type_donation' => $req->data->type_donation,
        'donneur' => $req->data->donneur,
        'donation' => $req->data->donation,
        'quantite_donnee' => $req->data->quantite_donnee,
    ];

    $res = Validator::validateDon($input);

    if ($res['ok']) {
        $repo->insertDon($res['values']);

        Flight::render('dashboard', [
          'values' => $res['values'],
          'errors' => [
            'type_donation' => '',
            'donneur' => '',
            'donation' => '',
            'quantite_donnee' => ''
          ],
          'success' => true
        ]);
        return;
    }

    Flight::render('insererDon', [
      'values' => $res['values'],
      'errors' => $res['errors'],
      'success' => false
    ]);
  }

}