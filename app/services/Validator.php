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

    $password = (string)($input['password'] ?? '');

    if ($values['email'] === '') $errors['email'] = "L'email est obligatoire.";
    elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL))
      $errors['email'] = "L'email n'est pas valide (ex: nom@domaine.com).";

    if ($password === '') $errors['password'] = "Le mot de passe est obligatoire.";

    $ok = true;
    foreach ($errors as $m) { if ($m !== '') { $ok = false; break; } }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }


}
