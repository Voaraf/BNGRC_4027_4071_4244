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
require_once __DIR__ . '/../controllers/DistributionController.php';
require_once __DIR__ . '/../repositories/DistributionRepository.php';
require_once __DIR__ . '/../repositories/StockageRepository.php';
require_once __DIR__ . '/../repositories/AchatsRepository.php';
require_once __DIR__ . '/../controllers/ResetController.php';
require_once __DIR__ . '/../controllers/VenteController.php';
require_once __DIR__ . '/../repositories/VenteRepository.php';

Flight::route('GET /', ['LoginController', 'showLogin']);
Flight::route('POST /login', ['LoginController', 'postLogin']);

Flight::route('GET /dashboard', ['DashboardController', 'afficherTableauDeBord']);

Flight::route('GET /insererBesoin', ['BesoinController', 'showInsererBesoin']);
Flight::route('POST /traitementinsererBesoin', ['BesoinController', 'insererBesoin']);

Flight::route('GET /insererDon', ['DonController', 'showInsererDon']);
Flight::route('POST /traitementinsererDon', ['DonController', 'insererDon']);

Flight::route('GET /ville/@id', ['DashboardController', 'afficherVilleParId']);
Flight::route('GET /villes', ['DashboardController', 'afficherListeVilles']);

Flight::route('GET /achats', ['AchatsController', 'showAchats']);
Flight::route('POST /traitementinsererAchat', ['AchatsController', 'insererAchat']);

Flight::route('GET /dashboard/recap', ['DashboardController', 'recapitulatifJSON']);

Flight::route('GET /insererDistribution', ['DistributionController', 'showInsererDistribution']);
Flight::route('POST /traitementinsererDistribution', ['DistributionController', 'insererDistribution']);    

Flight::route('GET /reset', ['ResetController', 'resetDatabase']);

Flight::route('GET /vente', ['VenteController', 'showVente']);
Flight::route('POST /traitementinsererVente', ['VenteController', 'insererVente']);