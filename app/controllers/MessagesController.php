<?php
class MessagesController {

  public static function showMessages() {
    $pdo = Flight::db();
    $messageRepo = new MessageRepository($pdo);
    $userRepo = new UserRepository($pdo);
    
    $currentUserId = $_SESSION['user_id'];
    $users = $userRepo->getAllUsersExcept($currentUserId);
    
    // Récupérer l'utilisateur sélectionné (par défaut le premier)
    $selectedUserId = $_GET['user_id'] ?? ($users[0]['id_users'] ?? null);
    
    $messages = [];
    if ($selectedUserId) {
        $messages = $messageRepo->getAllMessage($currentUserId, $selectedUserId);
        // Marquer les messages reçus comme lus
        $messageRepo->markMessagesAsRead($selectedUserId, $currentUserId);
    }
    
    // Compter les messages non lus pour chaque utilisateur
    $unreadCounts = [];
    foreach ($users as $user) {
        $unreadCounts[$user['id_users']] = $messageRepo->getUnreadCount($user['id_users']);
    }
    
    Flight::render('messages', [
      'messages' => $messages,
      'currentUserId' => $currentUserId,
      'users' => $users,
      'selectedUserId' => $selectedUserId,
      'unreadCounts' => $unreadCounts
    ]);
  }
  
  public static function postMessages() {
    $id_send = $_SESSION['user_id'];
    $id_receiver = $_POST['id_receiver'];
    $message = $_POST['message'];
    $pdo  = Flight::db();
    
    $messageRepo = new MessageRepository($pdo);
    $messageRepo->insertMessage($id_send, $id_receiver, $message);

    Flight::redirect('/messages?user_id=' . $id_receiver);
  }

}