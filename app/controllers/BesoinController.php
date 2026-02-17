<?php

class BesoinController {

    public static function insererBesoin() {
        $pdo = Flight::db();
        $repo = new BesoinRepository($pdo);

        $req = Flight::request();

        $input = [
            'id_produit' => $req->data->id_produit,
            'ville' => $req->data->ville,
            'quantite' => $req->data->quantite
        ];

        $res = Validator::validateBesoin($input);

        if ($res['ok']) {
            $ok = $repo->insererBesoin($res['values']['id_produit'], $res['values']['quantite'], $res['values']['ville']);

            if ($ok) {
                Flight::redirect('/');
                return;
            }

            $res['errors']['id_produit'] = 'Erreur lors de l\'insertion du besoin.';
        }
        
        $utilRepo = new UtilRepository($pdo);
        $produitRepo = new ProduitRepository($pdo);
        
        Flight::render('insererBesoin', [
            'data' => $utilRepo->getAllVille(),
            'produits' => $produitRepo->getAllProduits(),
            'values' => $res['values'],
            'errors' => $res['errors'],
            'success' => false
        ]);
    }

    public static function showinsererbesoin() {
        $pdo = Flight::db();
        $utilRepo = new UtilRepository($pdo);
        $produitRepo = new ProduitRepository($pdo);
        
        Flight::render('insererBesoin', [
            'data' => $utilRepo->getAllVille(),
            'produits' => $produitRepo->getAllProduits(),
            'values' => ['id_produit' => '', 'quantite' => '', 'ville' => ''],
            'errors' => ['id_produit' => '', 'quantite' => '', 'ville' => ''],
            'success' => false
        ]);
    }

    

    

  
}