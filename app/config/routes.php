<?php
require_once __DIR__ . '/../controllers/LoginController.php';
require_once __DIR__ . '/../services/Validator.php';
require_once __DIR__ . '/../repositories/UserRepository.php';


Flight::route('GET /', ['LoginController', 'showLogin']);
Flight::route('POST /message', ['LoginController', 'postLogin']);


