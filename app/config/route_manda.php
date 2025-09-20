<?php

use app\controllers\MandaController;

Flight::route('GET /test/@id_fonction', function($id_fonction) {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Adjust credentials
    $controller = new MandaController($pdo);
    $controller->startTest((int)$id_fonction);
});

Flight::route('POST /test/@id_fonction', function($id_fonction) {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Adjust
    $controller = new MandaController($pdo);
    $controller->handleResponse((int)$id_fonction);
});

Flight::route('GET /resultatqcm/@id_candidat', function($id_candidat) {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Adjust
    $controller = new MandaController($pdo);
    $controller->showResult((int)$id_candidat);
});

Flight::route('GET /entretien/@id_candidat', function($id_candidat) {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Ajuster
    $controller = new MandaController($pdo);
    $controller->planEntretien((int)$id_candidat);
});

Flight::route('POST /enregistrer_entretien', function() {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Adjust
    $controller = new MandaController($pdo);
    $controller->saveEntretien();
});

Flight::route('GET /modifier_pourcentages', function() {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Ajuster
    $controller = new MandaController($pdo);
    $controller->afficherModifierPourcentages();
});

Flight::route('POST /modifier_pourcentages', function() {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Ajuster
    $controller = new MandaController($pdo);
    $controller->enregistrerPourcentages();
});

Flight::route('GET /question_test', function() {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Ajuster
    $controller = new MandaController($pdo);
    $controller->afficherQuestions();
});

Flight::route('POST /question_test/add', function() {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Ajuster
    $controller = new MandaController($pdo);
    $controller->ajouterQuestion();
});

Flight::route('POST /question_test/update/@id_question', function($id_question) {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Ajuster
    $controller = new MandaController($pdo);
    $controller->modifierQuestion($id_question);
});

Flight::route('POST /question_test/delete/@id_question', function($id_question) {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Ajuster
    $controller = new MandaController($pdo);
    $controller->supprimerQuestion($id_question);
});

Flight::route('GET /liste_fonctions', function() {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Ajuster
    $controller = new MandaController($pdo);
    $controller->afficherListeFonctions();
});

Flight::route('POST /set_fonction', function() {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Ajuster
    $controller = new MandaController($pdo);
    $controller->setFonction();
});

Flight::route('GET /liste_candidat', function() {
    $pdo = new PDO('mysql:host=localhost;dbname=rh', 'root', ''); // Ajuster
    $controller = new MandaController($pdo);
    $controller->afficherListeCandidats();
});

?>