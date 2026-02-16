<?php
session_start();
class LoginController {

  public static function showLogin() {
    Flight::render('login', [
      'values' => ['email' => ''],
      'errors' => ['email' => ''],
      'success' => false
    ]);
  }
  
public static function postLogin() {
    $pdo  = Flight::db();
    $repo = new UserRepository($pdo);

    $req = Flight::request();

    $input = [
        'email' => $req->data->email,
    ];

    $res = Validator::validateLogin($input);

    if ($res['ok']) {

        $user = $repo->insertOrFindByEmail($res['values']['email']);

        if ($user) {

            $_SESSION['user_id'] = $user['id_users'];
            $_SESSION['email']   = $user['email'];

            Flight::redirect('/dashboard');
            return;
        }

        $res['errors']['email'] = 'Email incorrect.';
    }

      Flight::render('login', [
        'values'  => $res['values'],
        'errors'  => $res['errors'],
        'success' => false
    ]);
}
}
