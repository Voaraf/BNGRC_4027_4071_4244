<?php
require_once __DIR__ . '/../controllers/LoginController.php';
require_once __DIR__ . '/../services/Validator.php';
require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../repositories/MessageRepository.php';
require_once __DIR__ . '/../controllers/MessagesController.php'; 


Flight::route('GET /', ['LoginController', 'showLogin']);
Flight::route('POST /message', ['LoginController', 'postLogin']);
Flight::route('GET /messages', ['MessagesController', 'showMessages']);
Flight::route('POST /messages', ['MessagesController', 'postMessages']);


