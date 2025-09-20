<?php

namespace app\controllers;

use app\models\PostulerModel;
use app\models\FiltrageModel;
use Flight;

class PostulerController {
    public function __construct() {
       
    }

    public function formPostuler($id_annonce) {
        $annonce = Flight::PostulerModel()->getAnnonceById($id_annonce);
        $data = ['id_annonce' => $id_annonce, 'annonce' => $annonce];
        Flight::render('postuler', $data);
    }

    public function submitPostuler() {
        $id_annonce = Flight::request()->data->id_annonce;
        $nom = Flight::request()->data->nom;
        $prenom = Flight::request()->data->prenom;
        $mail = Flight::request()->data->mail;
        $tel = Flight::request()->data->telephone;
        $niveau_etude = Flight::request()->data->niveau_etude;
        $experience = Flight::request()->data->experience;
        $date_naissance = Flight::request()->data->date_naissance;
        $adresse = Flight::request()->data->adresse;
        $sexe = Flight::request()->data->sexe;

        $message = '';
        $message_type = '';
        $photoPath = null;

        // Validation simple
        if (empty($nom) || empty($prenom) || empty($mail) || empty($sexe)) {
            $message = 'Nom, prénom, email et sexe sont requis.';
            $message_type = 'error';
        } else {
            // Gestion de l'upload de l'image
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/uploads/';
                $fileName = uniqid() . '_' . basename($_FILES['photo']['name']);
                $uploadFile = $uploadDir . $fileName;

                // Vérifiez et déplacez le fichier uploadé
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    $photoPath = '/uploads/' . $fileName;
                } else {
                    $message = 'Erreur lors de l\'upload de la photo.';
                    $message_type = 'error';
                }
            }

            // Enregistrement du candidat
            if (empty($message)) {
                try {
                    $candidat_id = Flight::PostulerModel()->createCandidat(
                        $id_annonce,
                        $nom,
                        $prenom,
                        $mail,
                        $tel,
                        $niveau_etude,
                        $experience,
                        $date_naissance,
                        $adresse,
                        $sexe,
                        $photoPath
                    );

                    if ($candidat_id) {
                        // Créer un tableau candidat pour la vérification
                        $candidat = [
                            'id_candidat' => $candidat_id,
                            'id_annonce' => $id_annonce,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'mail' => $mail,
                            'telephone' => $tel,
                            'niveau_etude' => $niveau_etude,
                            'experience' => $experience,
                            'date_de_naissance' => $date_naissance,
                            'adresse' => $adresse,
                            'sexe' => $sexe,
                            'photo' => $photoPath,
                            'date_candidature' => date('Y-m-d'),
                            'langues_maitrisees' => '' // Champ non inclus dans le formulaire, défini comme vide
                        ];

                        // Utiliser FiltrageModel pour vérifier le candidat
                        $filtrageModel = new FiltrageModel(Flight::db());
                        $criteres = $filtrageModel->getCriteresPourAnnonce($id_annonce);
                        $exigences = $filtrageModel->getNiveauxExigencePourAnnonce($id_annonce);

                        if ($filtrageModel->verifierCandidat($candidat, $criteres, $exigences)) {
                            // Insérer dans candidat_retenu
                            $filtrageModel->insererCandidatRetenu($candidat);
                            // Rediriger vers la page de confirmation
                            $_SESSION['id_candidat'] = $candidat['id_candidat'];
                            Flight::redirect('/confirmation');
                            return;
                        } else {
                            $message = 'Votre candidature ne répond pas aux critères requis.';
                            $message_type = 'error';
                        }
                    } else {
                        $message = 'Erreur lors de la soumission de la candidature.';
                        $message_type = 'error';
                    }
                } catch (Exception $e) {
                    $message = 'Erreur lors de la soumission de la candidature : ' . $e->getMessage();
                    $message_type = 'error';
                }
            }
        }

        // Rendre la vue avec les données en cas d'erreur
        $annonce = Flight::PostulerModel()->getAnnonceById($id_annonce);
        $data = [
            'id_annonce' => $id_annonce,
            'annonce' => $annonce,
            'message' => $message,
            'message_type' => $message_type
        ];
        Flight::render('postuler', $data);
    }

    public function afficherCandidatures() {
        // Fetch all candidatures from the database
        $candidatures = Flight::PostulerModel()->getAllCandidatures();
    
        // Render the view and pass the data
        Flight::render('rh/candidatures', ['candidatures' => $candidatures]);
    }
}