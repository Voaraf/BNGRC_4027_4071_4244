<?php
require_once __DIR__ . '/../controllers/LoginController.php';
require_once __DIR__ . '/../services/Validator.php';
require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../controllers/BesoinController.php';
require_once __DIR__ . '/../controllers/DonController.php'; 
require_once __DIR__ . '/../repositories/BesoinRepository.php';
require_once __DIR__ . '/../repositories/DonRepository.php';
require_once __DIR__ . '/../repositories/DashboardRepository.php';
require_once __DIR__ . '/../controllers/DashboardController.php';
require_once __DIR__ . '/../repositories/UtilRepository.php';
require_once __DIR__ . '/../controllers/AchatsController.php';


Flight::route('GET /', ['LoginController', 'showLogin']);
Flight::route('POST /login', ['LoginController', 'postLogin']);

Flight::route('GET /dashboard', ['DashboardController', 'showDashboard']);

Flight::route('GET /insererBesoin', ['BesoinController', 'showInsererBesoin']);
Flight::route('POST /traitementinsererBesoin', ['BesoinController', 'insererBesoin']);

Flight::route('GET /insererDon', ['DonController', 'showInsererDon']);
Flight::route('POST /traitementinsererDon', ['DonController', 'insererDon']);

Flight::route('GET /ville/@id', ['DashboardController', 'showVilleById']);

Flight::route('GET /achats', ['AchatsController', 'showAchats']);