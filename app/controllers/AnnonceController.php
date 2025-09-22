<?php

namespace app\controllers;
use app\models\AnnonceModel;
use Flight;
class AnnonceController{

    public function __construct()
    {

    }
    public function getAnnonces() {
        $annonces = Flight::AnnonceModel()->getAnnoncesAvecCriteres();
        $data = ['annonces' => $annonces];
        Flight::render('annonces', $data);
    }

    public function afficherFormAnnonce() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['utilisateur'])) {
            Flight::redirect('/login');
            return;
        }
        
        // Récupérer la liste des fonctions pour le formulaire
        $fonctions = Flight::AnnonceModel()->getAllFonctions();
        
        Flight::render('rh/annonces_creation', [
            'fonctions' => $fonctions
        ]);
    }
    
    public function creerAnnonce() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['utilisateur'])) {
            Flight::redirect('/login');
            return;
        }
        
        // Récupérer les données du formulaire
        $poste = Flight::request()->data->poste_voulu;
        $date_limite = Flight::request()->data->date_depot_limite;
        $id_fonction = Flight::request()->data->id_fonction;
        
        // Récupérer les critères
        $age_min = Flight::request()->data->age_min ?: 0;
        $age_max = Flight::request()->data->age_max ?: 0;
        $sexe = Flight::request()->data->sexe ?: 'Indifférent';
        $experience = Flight::request()->data->experience ?: 0;
        $diplome = Flight::request()->data->diplome_requis ?: '';
        $langues = Flight::request()->data->langues_maitrisees ?: '';
        $lieu_a_proximite = Flight::request()->data->lieu_a_proximite ?: '';
        
        // Récupérer les niveaux d'exigence
        $niveaux = [
            'age' => Flight::request()->data->niveau_age ?: 'tolerable',
            'sexe' => Flight::request()->data->niveau_sexe ?: 'pas_important',
            'experience' => Flight::request()->data->niveau_experience ?: 'tolerable',
            'diplome' => Flight::request()->data->niveau_diplome ?: 'tolerable',
            'langues' => Flight::request()->data->niveau_langues ?: 'tolerable',
            'lieu' => Flight::request()->data->niveau_lieu ?: 'pas_important'
        ];
        
        // D'abord créer les critères
        $critere_id = Flight::AnnonceModel()->ajouterCriteres($age_min, $age_max, $sexe, $experience, $diplome, $langues, $lieu_a_proximite);
        
        // Ensuite créer l'annonce
        $annonce_id = Flight::AnnonceModel()->ajouterAnnonce($poste, $date_limite, $critere_id, $id_fonction);

        $id_poste = Flight::AnnonceModel()->ajouterPoste($poste, $id_fonction);
        
        // Enfin, ajouter les niveaux d'exigence
        if ($annonce_id) {
            Flight::AnnonceModel()->ajouterNiveauxExigence($annonce_id, $niveaux);
            Flight::redirect('/annonces?success=Annonce créée avec succès');
        } else {
            Flight::redirect('/rh/annonces/creer?error=Erreur lors de la création de l\'annonce');
        }
    }

}