<?php
// Fichier : app/controllers/FiltrageController.php
namespace app\controllers;

use Flight;

class FiltrageController {
    public function __construct() {
        // Pas d'initialisation, comme dans AnnonceController
    }

    public function afficherMenuRecrutement() {
        Flight::render('rh/recrutement/menu');
    }

    public function afficherCandidatures() {
        Flight::render('rh/recrutement/candidatures');
    }

    public function afficherEntretiens() {
        Flight::render('rh/recrutement/entretiens');
    }

    public function afficherCandidatsNonRetenus() {
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] != 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }

        $candidatsNonRetenus = Flight::FiltrageModel()->getCandidatsATraiter();

        Flight::render('candidats_non_retenus', array(
            'candidats' => $candidatsNonRetenus,
            'message' => isset($_SESSION['message_traitement']) ? $_SESSION['message_traitement'] : null
        ));
        unset($_SESSION['message_traitement']);
    }

    public function traiterCandidats() {
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] != 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }

        $result = Flight::FiltrageModel()->traiterCandidats();

        $_SESSION['message_traitement'] = "Traitement terminé : {$result['retenus']} candidats retenus, {$result['rejetes']} candidats rejetés.";
        Flight::redirect('/rh/recrutement/candidats-non-retenus');
    }

    public function afficherCandidatsRetenus() {
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] != 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }

        // Récupérer le filtre, le tri et les paramètres de recherche
        $filtre = Flight::request()->query->filtre ? Flight::request()->query->filtre : 'retenus';
        $tri = Flight::request()->query->tri ? Flight::request()->query->tri : 'age';
        $searchParams = array();
        if (Flight::request()->query->nom_prenom) {
            $searchParams['nom_prenom'] = Flight::request()->query->nom_prenom;
        }
        if (Flight::request()->query->email) {
            $searchParams['email'] = Flight::request()->query->email;
        }
        if (Flight::request()->query->niveau_etude) {
            $searchParams['niveau_etude'] = Flight::request()->query->niveau_etude;
        }
        if (Flight::request()->query->experience_min) {
            $searchParams['experience_min'] = Flight::request()->query->experience_min;
        }
        if (Flight::request()->query->experience_max) {
            $searchParams['experience_max'] = Flight::request()->query->experience_max;
        }
        if (Flight::request()->query->age_min) {
            $searchParams['age_min'] = Flight::request()->query->age_min;
        }
        if (Flight::request()->query->age_max) {
            $searchParams['age_max'] = Flight::request()->query->age_max;
        }
        if (Flight::request()->query->sexe) {
            $searchParams['sexe'] = Flight::request()->query->sexe;
        }
        if (Flight::request()->query->date_candidature) {
            $searchParams['date_candidature'] = Flight::request()->query->date_candidature;
        }

        // Récupérer les candidats en fonction du filtre
        if ($filtre == 'retenus') {
            $candidats = Flight::FiltrageModel()->getCandidatsRetenus($tri, $searchParams);
        } else {
            $candidats = Flight::FiltrageModel()->getCandidatsATraiter($tri, $searchParams);
        }

        Flight::render('candidats_retenus', array(
            'candidats' => $candidats,
            'filtre' => $filtre,
            'tri' => $tri
        ));
    }
}
?>