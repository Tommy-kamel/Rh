<?php
namespace app\controllers;
use Flight;

class UtilisateurController {
    
    public function __construct() {
        // Initialisation du contrôleur
    }
    
    /**
     * Affiche la page de connexion
     */
    public function afficherLogin() {
        
        // Inclure directement le fichier pour contourner temporairement le problème
        include Flight::get('flight.views.path') . "/login.php";
        exit;
        
        // Cette ligne ne sera pas exécutée pour le moment
        // Flight::render('login');
    }
    
    /**
     * Traite le formulaire de connexion
     */
    public function traiterLogin() {
        $nom_utilisateur = Flight::request()->data->nom_utilisateur;
        $mot_de_passe = Flight::request()->data->mot_de_passe;
        
        // Vérification des identifiants
        $utilisateur = Flight::UtilisateurModel()->verifierIdentifiants($nom_utilisateur, $mot_de_passe);
        $fonction = Flight::UtilisateurModel()->getFonction($nom_utilisateur,$mot_de_passe);
        
        // Affichage de la fonction pour le débogage
        
        if ($utilisateur) {
            // Création de la session
            $_SESSION['utilisateur'] = [
                'id' => $utilisateur['id_user'],
                'nom_utilisateur' => $utilisateur['nom_utilisateur'],
                'fonction' => $fonction['nom_fonction'],
            ];
            
            // Redirection selon la fonction de l'utilisateur
            $this->redirigerSelonFonction($fonction['nom_fonction']);
        } else {
            // Affichage d'un message d'erreur
            Flight::render('login', ['error' => 'Identifiants incorrects. Veuillez réessayer.']);
        }
    }
    
    /**
     * Redirige l'utilisateur selon sa fonction
     */
    private function redirigerSelonFonction($fonction) {
        switch ($fonction) {
            case 'Ressources Humaines':
                Flight::redirect('/rh/dashboard');
                break;
            case 'Production':
                Flight::redirect('/production/dashboard');
                break;
            case 'Achat et vente':
                Flight::redirect('/achat-vente/dashboard');
                break;
            case 'Gestion de stock':
                Flight::redirect('/stock/dashboard');
                break;
            case 'Gestion d\'immobilisation':
                Flight::redirect('/immobilisation/dashboard');
                break;
            default:
                Flight::redirect('/');
                break;
        }
    }
    
    /**
     * Déconnecte l'utilisateur
     */
    public function logout() {
        session_destroy();
        Flight::redirect('/login');
    }
    
    /**
     * Vérifie si l'utilisateur est connecté
     */
    public function estConnecte() {
        return isset($_SESSION['utilisateur']);
    }
    
    /**
     * Vérifie si l'utilisateur a une fonction spécifique
     */
    public function aFonction($fonction) {
        if (!$this->estConnecte()) {
            return false;
        }
        
        return $_SESSION['utilisateur']['fonction'] === $fonction;
    }
}