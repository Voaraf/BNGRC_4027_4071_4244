<?php
class LoginController {

  public static function showLogin() {
    Flight::render('login', [
      'values' => ['email' => '', 'password' => ''],
      'errors' => ['email' => '', 'password' => ''],
      'success' => false
    ]);
  }
  
public static function postLogin() {
    $pdo  = Flight::db();
    $repo = new UserRepository($pdo);

    $req = Flight::request();

    $input = [
        'email' => $req->data->email,
        'password' => $req->data->password,
    ];

    $res = Validator::validateLogin($input);

    if ($res['ok']) {

        $user = $repo->insertOrFindByEmail($res['values']['email'], $res['values']['password']);

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
