<?php

namespace app\controllers;
use app\models\FrontModel;
use Flight;
class FrontController{

    public function __construct()
    {

    }
    /* public function getMaisons() {
        $type = Flight::request()->query->type ?? null;
        if ($type) {
            $typeMaisons = Flight::FrontModel()->getMaisonsType($type);
            $data = ['maisons' => $typeMaisons];
            Flight::render('accueil', $data);
        } else {
            $maisons = Flight::FrontModel()->getMaisons();
            $data = ['maisons' => $maisons];
            Flight::render('accueil', $data);
        }
    }

    public function getDetails() {
        $id = Flight::request()->query->id ?? null;

        if (!$id || !is_numeric($id)) {
            Flight::halt(400, "ID invalide ou manquant.");
            return;
        }

        $id = (int) $id;

        $details = Flight::FrontModel()->getDetails($id);

        if (!$details) {
            Flight::halt(404, "Détails non trouvés pour l'ID $id.");
            return;
        }

        Flight::render('details', ['details' => $details]);
    }

    public function reservation() {
        $idHabitation = Flight::request()->data['habitation_id'] ?? Flight::request()->query['habitation_id'];
        $date_arrivee = Flight::request()->data['date_arrivee'] ?? Flight::request()->query['date_arrivee'];
        $date_depart = Flight::request()->data['date_depart'] ?? Flight::request()->query['date_depart'];

        $details = Flight::FrontModel()->getDetails($idHabitation);
        $messageErreur = null;
        $messageReussite = null;

        if (empty($idHabitation) || empty($date_arrivee) || empty($date_depart)) {
            $messageErreur = "Données de réservation manquantes ou invalides.";
        } elseif (!Flight::FrontModel()->peutReserver($idHabitation, $date_arrivee, $date_depart)) {
            $messageErreur = "La réservation n'est pas possible pour les dates sélectionnées.";
        } else {
            $reservation = Flight::FrontModel()->reservation($idHabitation, null, $date_arrivee, $date_depart);

            if ($reservation) {
                $messageReussite = "Réservation effectuée avec succès.";
            } else {
                $messageErreur = "Une erreur s'est produite lors de la réservation.";
            }
        }

        Flight::render('details', [
            'details' => $details,
            'messageErreur' => $messageErreur,
            'messageReussite' => $messageReussite
        ]);
    } */

}