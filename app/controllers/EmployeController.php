<?php

namespace app\controllers;
use Flight;
class EmployeController{

    public function __construct()
    {

    }

    public function showMenu() {
        Flight::render('rh/menu_employe');
    }

    public function listeEmployeSousContrat(){
        $listeEmployes = Flight::EmployeModel()->getAllEmployesSousContrat();
        Flight::render('rh/liste_employe_sous_contrat', ['employes' => $listeEmployes]);
    }

    public function listeEmployeSousContratEssai(){
        $listeEmployesEssai = Flight::EmployeModel()->getAllEmployesSousContratEssai();
        Flight::render('rh/liste_employe_sous_contrat_essai', ['employesEssai' => $listeEmployesEssai]);
    }
    

    /* public function embaucherEmploye($id_contrat_essai) {
        $contrat = Flight::EmployeModel()->getContratEssaiById($id_contrat_essai);
        if ($contrat) {
            $salaire = $contrat['salaire'];
            $date_embauche = date('Y-m-d'); // Date actuelle
            $id_candidat_retenu = $contrat['id_candidat_retenu'];

            // Récupérer les informations du candidat
            $candidat = Flight::EmployeModel()->getCandidatByIdCandidatRetenu($id_candidat_retenu);
            $nom = $candidat['nom'];
            $prenom = $candidat['prenom'];
            $mail = $candidat['mail'];
            $tel = $candidat['telephone'];
            $date_naissance = $candidat['date_de_naissance'];
            $adresse = $candidat['adresse'];
            $sexe = $candidat['sexe'];

            // Créer l'employé et récupérer son ID
            $id_employe = Flight::EmployeModel()->createEmploye(
                $nom,
                $prenom,
                $sexe,
                $mail,
                $tel,
                $date_naissance,
                $adresse
            );

            if ($id_employe) {
                // Créer le contrat permanent
                $id_contrat = Flight::EmployeModel()->createContrat($id_employe, $salaire, $date_embauche);
                if ($id_contrat) {
                    // Terminer le contrat d'essai
                    Flight::EmployeModel()->terminerContratEssai($id_contrat_essai, $date_embauche);

                    // Récupérer la liste mise à jour des employés en essai
                    $listeEmployesEssai = Flight::EmployeModel()->getAllEmployesSousContratEssai();

                    // Message de succès avec lien
                    $message = "L'employé $prenom $nom a été embauché avec succès. <a href='/contrat-essai/export-pdf?id_contrat=$id_contrat' class='alert-link'>Générer le contrat</a>";
                    $message_type = 'success';

                    // Rendre la page avec le message et la liste
                    Flight::render('rh/liste_employe_sous_contrat_essai', [
                        'employesEssai' => $listeEmployesEssai,
                        'message' => $message,
                        'message_type' => $message_type
                    ]);
                } else {
                    $message = "Erreur lors de la création du contrat.";
                    $message_type = 'error';
                    Flight::render('rh/confirmation_embauche', [
                        'message' => $message,
                        'message_type' => $message_type
                    ]);
                }
            } else {
                $message = "Erreur lors de la création de l'employé.";
                $message_type = 'error';
                Flight::render('rh/confirmation_embauche', [
                    'message' => $message,
                    'message_type' => $message_type
                ]);
            }
        } else {
            $message = "Contrat d'essai introuvable.";
            $message_type = 'error';
            Flight::render('rh/confirmation_embauche', [
                'message' => $message,
                'message_type' => $message_type
            ]);
        }
    } */

    public function embaucherEmploye($id_contrat_essai) {
        $contrat = Flight::EmployeModel()->getContratEssaiById($id_contrat_essai);
        if ($contrat) {
            $salaire = $contrat['salaire'];
            $date_embauche = date('Y-m-d'); // Date actuelle
            $id_candidat_retenu = $contrat['id_candidat_retenu'];

            // Récupérer les informations du candidat
            $candidat = Flight::EmployeModel()->getCandidatByIdCandidatRetenu($id_candidat_retenu);
            $nom = $candidat['nom'];
            $prenom = $candidat['prenom'];
            $mail = $candidat['mail'];
            $tel = $candidat['telephone'];
            $date_naissance = $candidat['date_de_naissance'];
            $adresse = $candidat['adresse'];
            $sexe = $candidat['sexe'];

            // Créer l'employé et récupérer son ID
            $id_employe = Flight::EmployeModel()->createEmploye(
                $nom,
                $prenom,
                $sexe,
                $mail,
                $tel,
                $date_naissance,
                $adresse
            );

            if ($id_employe) {
                error_log("Employé créé avec succès: ID $id_employe, $nom $prenom");

                // Créer le contrat permanent
                $id_contrat = Flight::EmployeModel()->createContrat($id_employe, $salaire, $date_embauche);
                if ($id_contrat) {
                    error_log("Contrat créé avec succès: ID $id_contrat pour employé ID $id_employe");

                    // Terminer le contrat d'essai
                    Flight::EmployeModel()->terminerContratEssai($id_contrat_essai, $date_embauche);

                    // Récupérer la liste mise à jour des employés en essai
                    $listeEmployesEssai = Flight::EmployeModel()->getAllEmployesSousContratEssai();

                    // Message de succès avec lien
                    $message = "L'employé $prenom $nom a été embauché avec succès. <a href='/contrat-essai/export-pdf?id_contrat=$id_contrat' class='alert-link'>Générer le contrat</a>";
                    $message_type = 'success';

                    // Rendre la page avec le message et la liste
                    Flight::render('rh/liste_employe_sous_contrat_essai', [
                        'employesEssai' => $listeEmployesEssai,
                        'message' => $message,
                        'message_type' => $message_type
                    ]);
                } else {
                    error_log("Erreur lors de la création du contrat pour l'employé ID: $id_employe, salaire: $salaire, date: $date_embauche");
                    $message = "Erreur lors de la création du contrat.";
                    $message_type = 'error';
                    Flight::render('rh/confirmation_embauche', [
                        'message' => $message,
                        'message_type' => $message_type
                    ]);
                }
            } else {
                error_log("Erreur lors de la création de l'employé: $nom $prenom, email: $mail, sexe: $sexe, tel: $tel, naissance: $date_naissance, adresse: $adresse");
                $message = "Erreur lors de la création de l'employé.";
                $message_type = 'error';
                Flight::render('rh/confirmation_embauche', [
                    'message' => $message,
                    'message_type' => $message_type
                ]);
            }
        } else {
            error_log("Contrat d'essai introuvable pour ID: $id_contrat_essai");
            $message = "Contrat d'essai introuvable.";
            $message_type = 'error';
            Flight::render('rh/confirmation_embauche', [
                'message' => $message,
                'message_type' => $message_type
            ]);
        }
    }
}