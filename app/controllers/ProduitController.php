<?php
class ProduitController {
    public static function showInsererProduit() {
        $pdo = Flight::db();
        $utilRepo = new UtilRepository($pdo);
        $produitRepo = new ProduitRepository($pdo);
        
        $types = $utilRepo->getType();
        $produits = $produitRepo->getAllProduits();
        
        Flight::render('insererProduit', [
            'types' => $types,
            'produits' => $produits,
            'errors' => []
        ]);
    }

    public static function insererProduit() {
        $pdo = Flight::db();
        $produitRepo = new ProduitRepository($pdo);
        
        $nom_produit = $_POST['nom_produit'] ?? '';
        $id_type = $_POST['id_type'] ?? '';
        $prix_unitaire = $_POST['prix_unitaire'] ?? 0;
        
        $errors = [];
        if (empty($nom_produit)) $errors['nom_produit'] = "Le nom du produit est obligatoire.";
        if (empty($id_type)) $errors['id_type'] = "le type est obligatoire.";
        if ($prix_unitaire <= 0) $errors['prix_unitaire'] = "Le prix doit être positif.";
        
        if (!empty($errors)) {
            $utilRepo = new UtilRepository($pdo);
            $types = $utilRepo->getType();
            $produits = $produitRepo->getAllProduits();
            Flight::render('insererProduit', [
                'types' => $types,
                'produits' => $produits,
                'errors' => $errors
            ]);
            return;
        }

        try {
            $produitRepo->insertProduit($nom_produit, $id_type, $prix_unitaire);
            Flight::redirect('/insererProduit?success=1');
        } catch (Exception $e) {
            Flight::error($e);
        }
    }
}
