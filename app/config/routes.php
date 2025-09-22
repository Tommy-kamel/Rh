<?php

use app\controllers\ApiExampleController;
use app\controllers\FrontController;
use app\controllers\AnnonceController;
use app\controllers\PostulerController;
use app\controllers\UtilisateurController;
use app\controllers\HomeController;
use app\controllers\RecrutementController;
use app\controllers\ContratEssaiController;
use app\controllers\EmployeController;
use app\controllers\FiltrageController;
use flight\Engine;
use flight\net\Router;
//use Flight;

require_once 'route_manda.php';

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
$router->get('/rh/annonces/creer', [$Annonce_Controller, 'afficherFormAnnonce']);
$router->post('/rh/annonces/creer', [$Annonce_Controller, 'creerAnnonce']);

$router->get('/confirmation', function() {
    Flight::render('confirmation');
});


$Postuler_Controller = new PostulerController();
$router->get('/postuler/@id', [$Postuler_Controller, 'formPostuler']);
$router->post('/postuler/submit', [$Postuler_Controller, 'submitPostuler']);
$router->get('/rh/recrutement/candidatures', [ $Postuler_Controller, 'afficherCandidatures' ]);

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
    
// Routes pour la gestion des candidatures
$router->get('/rh/recrutement/candidatures', [ $RecrutementController, 'afficherCandidatures' ]);   
// Routes pour la gestion des entretiens
$router->get('/rh/recrutement/entretiens', [ $RecrutementController, 'afficherEntretiens' ]);


$ContratEssaiController = new ContratEssaiController();
$router->get('/contrat-essai/export-pdf', [ $ContratEssaiController, 'exportPdf' ]);
$router->get('/contrat-essai/@id_candidat', [ $ContratEssaiController, 'showForm' ]);
$router->post('/contrat-essai/submit', [ $ContratEssaiController, 'submitForm' ]);

$EmployeController = new EmployeController();
$router->get('/rh/menu_employe', [$EmployeController, 'showMenu']);
$router->get('/rh/menu_employe/employes-contrat', [$EmployeController, 'listeEmployeSousContrat']);
$router->get('/rh/menu_employe/employes-contrat-essai', [$EmployeController, 'listeEmployeSousContratEssai']);
$router->get('/rh/employe-essai/embaucher/@id', [$EmployeController, 'embaucherEmploye']);
$router->get('/rh/contrat/export-pdf/@id_contrat', [ $EmployeController, 'exportContratPdf' ]);
$router->get('/rh/contrat/@id_contrat', [ $EmployeController, 'showContrat' ]);
// $router->get('/rh/employe/@id_employe', [ $EmployeController, 'showEmployeDetails' ]);
$router->get('/rh/employe/terminer/@id_employe', [ $EmployeController, 'terminerContrat' ]);


$FiltrageController = new FiltrageController();
$router->get('/rh/recrutement/candidats-non-retenus', [ $FiltrageController, 'afficherCandidatsNonRetenus' ]);
$router->post('/rh/recrutement/traiter-candidats', [ $FiltrageController, 'traiterCandidats' ]);
$router->get('/rh/recrutement/candidats-retenus', [ $FiltrageController, 'afficherCandidatsRetenus' ]);