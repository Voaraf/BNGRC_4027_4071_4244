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
      'type_donation' => '',
      'donneur' => '',
      'donation' => '',
      'quantite_donnee' => ''
    ];

    $values = [
      'type_donation' => trim((string)($input['type_donation'] ?? '')),
      'donneur' => trim((string)($input['donneur'] ?? '')),
      'donation' => trim((string)($input['donation'] ?? '')),
      'quantite_donnee' => trim((string)($input['quantite_donnee'] ?? ''))
    ];

    if ($values['type_donation'] === '') $errors['type_donation'] = "Le type de donation est obligatoire.";
    if ($values['donneur'] === '') $errors['donneur'] = "Le nom du donneur est obligatoire.";
    if ($values['donation'] === '') $errors['donation'] = "La besoin de la donation est obligatoire.";
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
      'type' => '',
      'besoin' => '',
      'quantite' => '',
      'ville' => ''
    ];

    $values = [
      'type' => trim((string)($input['type'] ?? '')),
      'besoin' => trim((string)($input['besoin'] ?? '')),
      'quantite' => trim((string)($input['quantite'] ?? '')),
      'ville' => trim((string)($input['ville'] ?? ''))
    ];

    if ($values['type'] === '') $errors['type'] = "Le type de besoin est obligatoire.";
    if ($values['besoin'] === '') $errors['besoin'] = "La besoin du besoin est obligatoire.";
    if ($values['quantite'] === '') $errors['quantite'] = "La quantité de besoin est obligatoire.";
    elseif (!is_numeric($values['quantite']) || $values['quantite'] <= 0) {
      $errors['quantite'] = "La quantité doit être un nombre positif.";
    }
    if ($values['ville'] === '') $errors['ville'] = "La ville est obligatoire.";
    elseif (!is_numeric($values['ville'])) {
      $errors['ville'] = "La ville doit être un identifiant numérique.";
    }

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
    if ($values['type'] === '') $errors['type'] = "Le type est obligatoire.";
    elseif (!is_numeric($values['type'])) {
      $errors['type'] = "Le type doit être un identifiant numérique.";
    }

    $ok = true;
    foreach ($errors as $m) { if ($m !== '') { $ok = false; break; } }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }
}