<?php
class Validator {
  public static function validateLogin(array $input) {
    $errors = [
      'email' => '',
      'password' => ''
    ];

    $values = [
      'email' => trim((string)($input['email'] ?? '')),
      'password' => trim((string)($input['password'] ?? ''))
    ];


    if ($values['email'] === '') $errors['email'] = "L'email est obligatoire.";
    elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL))
      $errors['email'] = "L'email n'est pas valide (ex: nom@domaine.com).";

    if ($values['password'] === '') $errors['password'] = "Le mot de passe est obligatoire.";

    $ok = true;
    foreach ($errors as $m) { if ($m !== '') { $ok = false; break; } }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }

    public static function validateDon(array $input) {
    $errors = [
      'id_produit' => '',
      'donneur' => '',
      'quantite_donnee' => ''
    ];

    $values = [
      'id_produit' => trim((string)($input['id_produit'] ?? '')),
      'donneur' => trim((string)($input['donneur'] ?? '')),
      'quantite_donnee' => trim((string)($input['quantite_donnee'] ?? ''))
    ];

    if ($values['id_produit'] === '') $errors['id_produit'] = "Le produit est obligatoire.";
    if ($values['donneur'] === '') $errors['donneur'] = "Le nom du donneur est obligatoire.";
    if ($values['quantite_donnee'] === '') $errors['quantite_donnee'] = "La quantité donnée est obligatoire.";
    elseif (!is_numeric($values['quantite_donnee']) || $values['quantite_donnee'] <= 0) {
      $errors['quantite_donnee'] = "La quantité doit être un nombre positif.";
    }

    $ok = true;
    foreach ($errors as $m) { if ($m !== '') { $ok = false; break; } }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }

  public static function validateBesoin(array $input) {
    $errors = [
      'id_produit' => '',
      'quantite' => '',
      'ville' => ''
    ];

    $values = [
      'id_produit' => trim((string)($input['id_produit'] ?? '')),
      'quantite' => trim((string)($input['quantite'] ?? '')),
      'ville' => trim((string)($input['ville'] ?? ''))
    ];

    if ($values['id_produit'] === '') $errors['id_produit'] = "Le produit est obligatoire.";
    if ($values['quantite'] === '') $errors['quantite'] = "La quantité de besoin est obligatoire.";
    elseif (!is_numeric($values['quantite']) || $values['quantite'] <= 0) {
      $errors['quantite'] = "La quantité doit être un nombre positif.";
    }
    if ($values['ville'] === '') $errors['ville'] = "La ville est obligatoire.";

    $ok = true;
    foreach ($errors as $m) { if ($m !== '') { $ok = false; break; } }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }
  
  public static function validateAchat(array $input) {
    $errors = [
      'besoin_ville' => '',
      'quantite' => '',
      'type' => ''
    ];

    $values = [
      'besoin_ville' => trim((string)($input['besoin_ville'] ?? '')),
      'quantite' => trim((string)($input['quantite'] ?? '')),
      'type' => trim((string)($input['type'] ?? ''))
    ];

    if ($values['besoin_ville'] === '') $errors['besoin_ville'] = "Le besoin et la ville sont obligatoires.";
    if ($values['quantite'] === '') $errors['quantite'] = "La quantité est obligatoire.";
    elseif (!is_numeric($values['quantite']) || $values['quantite'] <= 0) {
      $errors['quantite'] = "La quantité doit être un nombre positif.";
    }

    $ok = true;
    foreach ($errors as $m) { if ($m !== '') { $ok = false; break; } }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }

  public static function validateDistribution(array $input) {
    $errors = [
      'besoin' => '',
      'quantite' => '',
      'ville' => ''
    ];

    $values = [
      'besoin' => trim((string)($input['besoin'] ?? '')),
      'quantite' => trim((string)($input['quantite'] ?? '')),
      'ville' => trim((string)($input['ville'] ?? ''))
    ];

    if ($values['besoin'] === '') $errors['besoin'] = "Le besoin est obligatoire.";
    if ($values['quantite'] === '') $errors['quantite'] = "La quantité est obligatoire.";
    elseif (!is_numeric($values['quantite']) || $values['quantite'] <= 0) {
      $errors['quantite'] = "La quantité doit être un nombre positif.";
    }
    if ($values['ville'] === '') $errors['ville'] = "La ville est obligatoire.";

    $ok = true;
    foreach ($errors as $m) { if ($m !== '') { $ok = false; break; } }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }
  public static function validateVente(array $input, $maxQuantite) {
    $errors = [
      'quantite' => '',
      'id_stock' => ''
    ];

    $values = [
      'quantite' => trim((string)($input['quantite'] ?? '')),
      'id_stock' => trim((string)($input['id_stock'] ?? ''))
    ];

    if ($values['id_stock'] === '') $errors['id_stock'] = "Le produit est obligatoire.";
    if ($values['quantite'] === '') $errors['quantite'] = "La quantité est obligatoire.";
    elseif (!is_numeric($values['quantite']) || $values['quantite'] <= 0) {
      $errors['quantite'] = "La quantité doit être un nombre positif.";
    } elseif ($values['quantite'] > $maxQuantite) {
      $errors['quantite'] = "Quantité insuffisante en stock (Max: $maxQuantite).";
    }

    $ok = true;
    foreach ($errors as $m) { if ($m !== '') { $ok = false; break; } }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }
}