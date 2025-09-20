<?php

namespace app\controllers;

use Flight;

class RecrutementController {
    
    private $annonceModel;
    private $posteModel;
    private $critereModel;
    
    public function __construct(/* $annonceModel, $posteModel, $critereModel */) {
        /* $this->annonceModel = $annonceModel;
        $this->posteModel = $posteModel;
        $this->critereModel = $critereModel; */
    }
    
    /**
     * Affiche la page principale du module de recrutement
     */
    public function afficherMenuRecrutement() {
        // Vérification de la session
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }
        
        Flight::render('rh/recrutement'); 
    }
    
    /**
     * Affiche la page de gestion des annonces
     */
    public function afficherAnnonces() {
        // Vérification de la session
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }
        
        // Récupérer la liste des annonces
        $annonces = $this->annonceModel->getAllAnnonces();
        
        // Passer les messages de succès ou d'erreur à la vue
        $successMessage = Flight::request()->query->success;
        $errorMessage = Flight::request()->query->error;
        
        Flight::render('rh/annonces', [
            'annonces' => $annonces,
            'successMessage' => $successMessage,
            'errorMessage' => $errorMessage
        ]);
    }
    
    /**
     * Affiche le formulaire pour créer une nouvelle annonce
     */
    public function afficherFormAnnonce() {
        // Vérification de la session
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }
        
        Flight::render('rh/annonce_form', [
            'titre' => 'Nouvelle annonce de recrutement'
        ]);
    }
    
    /**
     * Traite l'ajout d'une nouvelle annonce
     */
    public function ajouterAnnonce() {
        // Vérification de la session
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }
        
        // Récupérer les données du formulaire pour l'annonce
        $poste_voulu = Flight::request()->data->poste_voulu;
        $date_depot_limite = Flight::request()->data->date_depot_limite;
        
        // Valider les données
        if (empty($poste_voulu) || empty($date_depot_limite)) {
            Flight::redirect('/rh/recrutement/annonces?error=Le poste et la date limite sont obligatoires');
            return;
        }
        
        // Insérer l'annonce sans critère pour le moment
        $annonceId = $this->annonceModel->ajouterAnnonce(null, $date_depot_limite, $poste_voulu);
        
        if (!$annonceId) {
            Flight::redirect('/rh/recrutement/annonces?error=Erreur lors de la création de l\'annonce');
            return;
        }
        
        // Créer le poste si nécessaire
        $this->posteModel->ajouterPoste($poste_voulu, null);
        
        // Rediriger vers la page de détail de l'annonce pour ajouter des critères
        Flight::redirect('/rh/recrutement/annonce/' . $annonceId . '?success=Annonce créée avec succès. Vous pouvez maintenant ajouter des critères.');
    }
    
    /**
     * Affiche la page de détail d'une annonce
     */
    public function afficherDetailAnnonce($id) {
        // Vérification de la session
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }
        
        // Récupérer les détails de l'annonce
        $annonce = $this->annonceModel->getAnnonceById($id);
        
        if (!$annonce) {
            Flight::redirect('/rh/recrutement/annonces?error=Annonce introuvable');
            return;
        }
        
        // Récupérer les critères pour cette annonce
        $criteres = $this->critereModel->getCriteresForAnnonce($id);
        
        // Récupérer les candidatures pour cette annonce (à implémenter plus tard)
        $candidatures = [];
        
        // Passer les messages de succès ou d'erreur à la vue
        $successMessage = Flight::request()->query->success;
        $errorMessage = Flight::request()->query->error;
        
        Flight::render('rh/annonce_detail', [
            'annonce' => $annonce,
            'criteres' => $criteres,
            'candidatures' => $candidatures,
            'successMessage' => $successMessage,
            'errorMessage' => $errorMessage
        ]);
    }
    
    /**
     * Affiche le formulaire pour ajouter un critère à une annonce
     */
    public function afficherFormCritere($id_annonce) {
        // Vérification de la session
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }
        
        // Vérifier que l'annonce existe
        $annonce = $this->annonceModel->getAnnonceById($id_annonce);
        
        if (!$annonce) {
            Flight::redirect('/rh/recrutement/annonces?error=Annonce introuvable');
            return;
        }
        
        Flight::render('rh/critere_form', [
            'id_annonce' => $id_annonce
        ]);
    }
    
    /**
     * Traite l'ajout d'un critère à une annonce
     */
    public function ajouterCritere() {
        // Vérification de la session
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }
        
        // Récupérer les données du formulaire
        $id_annonce = Flight::request()->data->id_annonce;
        $nom_critere = Flight::request()->data->nom_critere;
        $coefficient = Flight::request()->data->coefficient;
        
        // Valider les données
        if (empty($id_annonce) || empty($nom_critere) || empty($coefficient)) {
            Flight::redirect('/rh/recrutement/annonce/' . $id_annonce . '?error=Tous les champs sont obligatoires');
            return;
        }
        
        // Ajouter le critère
        $id_critere = $this->critereModel->ajouterCritere($nom_critere, $coefficient, $id_annonce);
        
        if (!$id_critere) {
            Flight::redirect('/rh/recrutement/annonce/' . $id_annonce . '?error=Erreur lors de l\'ajout du critère');
            return;
        }
        
        // Rediriger vers la page de détail de l'annonce
        Flight::redirect('/rh/recrutement/annonce/' . $id_annonce . '?success=Critère ajouté avec succès');
    }
    
    /**
     * Affiche le formulaire pour modifier un critère
     */
    public function afficherFormModifierCritere($id_critere) {
        // Vérification de la session
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }
        
        // Récupérer les détails du critère
        $critere = $this->critereModel->getCritereById($id_critere);
        
        if (!$critere) {
            Flight::redirect('/rh/recrutement/annonces?error=Critère introuvable');
            return;
        }
        
        // Récupérer l'ID de l'annonce associée
        $id_annonce = $critere['id_annonce'];
        
        Flight::render('rh/critere_form', [
            'critere' => $critere,
            'id_annonce' => $id_annonce
        ]);
    }
    
    /**
     * Traite la modification d'un critère
     */
    public function modifierCritere($id_critere) {
        // Vérification de la session
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }
        
        // Récupérer les données du formulaire
        $id_annonce = Flight::request()->data->id_annonce;
        $nom_critere = Flight::request()->data->nom_critere;
        $coefficient = Flight::request()->data->coefficient;
        
        // Valider les données
        if (empty($id_annonce) || empty($nom_critere) || empty($coefficient)) {
            Flight::redirect('/rh/recrutement/criteres/' . $id_critere . '/modifier?error=Tous les champs sont obligatoires');
            return;
        }
        
        // Mettre à jour le critère
        $success = $this->critereModel->updateCritere($id_critere, $nom_critere, $coefficient);
        
        if (!$success) {
            Flight::redirect('/rh/recrutement/criteres/' . $id_critere . '/modifier?error=Erreur lors de la mise à jour du critère');
            return;
        }
        
        // Rediriger vers la page de détail de l'annonce
        Flight::redirect('/rh/recrutement/annonce/' . $id_annonce . '?success=Critère mis à jour avec succès');
    }
    
    /**
     * Supprime un critère
     */
    public function supprimerCritere($id_critere) {
        // Vérification de la session
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }
        
        // Récupérer les détails du critère pour avoir l'ID de l'annonce
        $critere = $this->critereModel->getCritereById($id_critere);
        
        if (!$critere) {
            Flight::redirect('/rh/recrutement/annonces?error=Critère introuvable');
            return;
        }
        
        $id_annonce = $critere['id_annonce'];
        
        // Supprimer le critère
        $success = $this->critereModel->deleteCritere($id_critere);
        
        if (!$success) {
            Flight::redirect('/rh/recrutement/annonce/' . $id_annonce . '?error=Erreur lors de la suppression du critère');
            return;
        }
        
        // Rediriger vers la page de détail de l'annonce
        Flight::redirect('/rh/recrutement/annonce/' . $id_annonce . '?success=Critère supprimé avec succès');
    }
    
    /**
     * Affiche la page de gestion des candidatures
     */
    public function afficherCandidatures() {
        // Vérification de la session
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }
        
        // TODO: Implémenter la gestion des candidatures
        Flight::render('rh/candidatures');
    }
    
    /**
     * Affiche la page de gestion des entretiens
     */
    public function afficherEntretiens() {
        // Vérification de la session
        if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
            Flight::redirect('/login');
            return;
        }
        
        // TODO: Implémenter la gestion des entretiens
        Flight::render('rh/entretiens');
    }
}