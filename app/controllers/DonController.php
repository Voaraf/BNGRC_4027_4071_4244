<?php
session_start();
class DonController {

  public static function showinsererDon() {
    $pdo = Flight::db();
    $utilRepo = new UtilRepository($pdo);
    $produitRepo = new ProduitRepository($pdo);
    
    Flight::render('insererDon', [
      'data' => $utilRepo->getAllVille(),
      'produits' => $produitRepo->getAllProduits(),
      'values' => [
        'id_produit' => '',
        'donneur' => '',
        'quantite_donnee' => '' 
      ],
      'errors' => [
        'id_produit' => '',
        'donneur' => '',
        'quantite_donnee' => ''
      ],
      'success' => false
    ]);
  }

  public static function insererDon() {
    $pdo  = Flight::db();
    $repo = new DonRepository($pdo);
    $stockageRepo = new StockageRepository($pdo);
    $produitRepo = new ProduitRepository($pdo);

    $req = Flight::request();

    $input = [
        'id_produit' => $req->data->id_produit,
        'donneur' => $req->data->donneur,
        'quantite_donnee' => $req->data->quantite_donnee,
    ];

    $res = Validator::validateDon($input);

    if ($res['ok']) {
        $repo->insertDon($res['values']);
        
        $produit = $produitRepo->getProduitById($res['values']['id_produit']);
        $stockageRepo->ajouterStock($produit['nom_produit'], $produit['id_type'], $res['values']['quantite_donnee']);

        Flight::redirect('/');
        return;
    }

    $utilRepo = new UtilRepository($pdo);
    Flight::render('insererDon', [
      'data' => $utilRepo->getAllVille(),
      'produits' => $produitRepo->getAllProduits(),
      'values' => $res['values'],
      'errors' => $res['errors'],
      'success' => false
    ]);
  }

}