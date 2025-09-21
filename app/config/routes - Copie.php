<?php

use app\controllers\ApiExampleController;
use app\controllers\FrontController;
use app\controllers\AnnonceController;
use app\controllers\PostulerController;
use app\controllers\UtilisateurController;
use app\controllers\HomeController;
use app\controllers\RecrutementController;
use app\controllers\FiltrageController;

use flight\Engine;
use flight\net\Router;

require_once 'route_manda.php';
//use Flight;

/** 
 * @var Router $router 
 * @var Engine $app
 */
/*$router->get('/', function() use ($app) {
	$Welcome_Controller = new WelcomeController($app);
	$app->render('welcome', [ 'message' => 'It works!!' ]);
});*/

session_start();
$Annonce_Controller = new AnnonceController();
$router->get('/annonces', [$Annonce_Controller, 'getAnnonces']);

$Postuler_Controller = new PostulerController();
$router->get('/postuler/@id', [$Postuler_Controller, 'formPostuler']);
$router->post('/postuler/submit', [$Postuler_Controller, 'submitPostuler']);

$UtilisateurController = new UtilisateurController();
$router->get('/login', [ $UtilisateurController, 'afficherLogin' ]);
$router->post('/login', [ $UtilisateurController, 'traiterLogin' ]);
$router->get('/logout', [ $UtilisateurController, 'logout' ]);

$HomeController = new HomeController();
$router->get('/', [ $HomeController, 'home']);

$router->get('/rh/dashboard', function() {
    if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
        Flight::redirect('/login');
    }
    Flight::render('rh/dashboard');
});

$router->get('/production/dashboard', function() {
    // Vérifier si l'utilisateur est connecté et a la fonction Production
    if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Production') {
        Flight::redirect('/login');
    }
    
    // Afficher le tableau de bord Production
    Flight::render('production/dashboard');
});

$router->get('/achat-vente/dashboard', function() {
    // Vérifier si l'utilisateur est connecté et a la fonction Achat et vente
    if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Achat et vente') {
        Flight::redirect('/login');
    }
    
    // Afficher le tableau de bord Achat et vente
    Flight::render('achat-vente/dashboard');
});

$router->get('/stock/dashboard', function() {
    // Vérifier si l'utilisateur est connecté et a la fonction Gestion de stock
    if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Gestion de stock') {
        Flight::redirect('/login');
    }
    
    // Afficher le tableau de bord Gestion de stock
    Flight::render('stock/dashboard');
});

$router->get('/immobilisation/dashboard', function() {
    // Vérifier si l'utilisateur est connecté et a la fonction Gestion d'immobilisation
    if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Gestion d\'immobilisation') {
        Flight::redirect('/login');
    }
    
    // Afficher le tableau de bord Gestion d'immobilisation
    Flight::render('immobilisation/dashboard');
});

$RecrutementController = new RecrutementController();
$router->get('/rh/recrutement', [ $RecrutementController, 'afficherMenuRecrutement' ]);

$FiltrageController = new FiltrageController();
$router->get('/rh/recrutement/candidats-non-retenus', [ $FiltrageController, 'afficherCandidatsNonRetenus' ]);
$router->post('/rh/recrutement/traiter-candidats', [ $FiltrageController, 'traiterCandidats' ]);
$router->get('/rh/recrutement/candidats-retenus', [ $FiltrageController, 'afficherCandidatsRetenus' ]);