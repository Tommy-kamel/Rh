<?php

namespace app\models;
use Flight;
use PDO;

class FrontModel {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /* public function getMaisons() {
        $stmt = $this->db->prepare("SELECT * FROM Habitations");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMaisonsType($type) {
        $stmt = $this->db->prepare("SELECT * FROM Habitations WHERE type = :type");
        $stmt->execute(['type' => $type]); // Associe le paramètre :type à la valeur de $type
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDetails($id) {
        $stmt = $this->db->prepare("SELECT * FROM Habitations WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function reservation($habitation_id, $client_id, $date_arrivee, $date_depart)
    {
        $stmt = $this->db->prepare("
        INSERT INTO Reservations (habitation_id, client_id, date_arrivee, date_depart, statut) 
        VALUES (?, ?, ?, ?, 'confirme')");

        if ($stmt->execute([$habitation_id, $client_id, $date_arrivee, $date_depart])) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function getReservations($idHabitation){
        $stmt = $this->db->prepare("SELECT * FROM Reservations WHERE habitation_id = :id");
        $stmt->execute(['id' => $idHabitation]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peutReserver($idHabitation, $reservationArrivee, $reservationDepart): bool {
        $reservations = $this->getReservations($idHabitation);

        $nouvelleArrivee = new \DateTime($reservationArrivee);
        $nouveauDepart = new \DateTime($reservationDepart);

        foreach ($reservations as $reservation) {
            $dateArriveeReservee = new \DateTime($reservation['date_arrivee']);
            $dateDepartReservee = new \DateTime($reservation['date_depart']);

            if (
                ($nouvelleArrivee >= $dateArriveeReservee && $nouvelleArrivee < $dateDepartReservee) ||
                ($nouveauDepart > $dateArriveeReservee && $nouveauDepart <= $dateDepartReservee) ||
                ($nouvelleArrivee <= $dateArriveeReservee && $nouveauDepart >= $dateDepartReservee)
            ) {
                return false;
            }
        }

        return true;
    } */

}