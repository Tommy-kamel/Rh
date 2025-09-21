<?php

namespace app\models;
use Flight;
use PDO;

class PostulerModel {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAnnonceById($id) {
        $stmt = $this->db->prepare("SELECT * FROM annonce WHERE id_annonce = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function createCandidat($id_annonce, $nom, $prenom, $mail, $tel, $niveau_etude, $experience, $date_naissance, $adresse, $sexe, $photo) {
        $stmt = $this->db->prepare("
            INSERT INTO candidat (id_annonce, nom, prenom, mail, telephone, niveau_etude, experience, date_de_naissance, adresse, sexe, photo, date_candidature)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([$id_annonce, $nom, $prenom, $mail, $tel, $niveau_etude, $experience, $date_naissance, $adresse, $sexe, $photo]);
        return $this->db->lastInsertId();
    }


    public function getAllCandidatures()
    {
        $sql = "SELECT * FROM candidat";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCandidaturesFiltered($filters = []) {
        $sql = "SELECT * FROM candidat WHERE 1=1";
        $params = [];

        if (!empty($filters['nom_prenom'])) {
            $sql .= " AND (nom LIKE :nom_prenom OR prenom LIKE :nom_prenom)";
            $params[':nom_prenom'] = '%' . $filters['nom_prenom'] . '%';
        }
        if (!empty($filters['email'])) {
            $sql .= " AND mail LIKE :email";
            $params[':email'] = '%' . $filters['email'] . '%';
        }
        if (!empty($filters['niveau_etude'])) {
            $sql .= " AND niveau_etude = :niveau_etude";
            $params[':niveau_etude'] = $filters['niveau_etude'];
        }
        if (!empty($filters['experience'])) {
            $sql .= " AND experience = :experience";
            $params[':experience'] = $filters['experience'];
        }
        if (!empty($filters['sexe'])) {
            $sql .= " AND sexe = :sexe";
            $params[':sexe'] = $filters['sexe'];
        }
        if (!empty($filters['date_debut'])) {
            $sql .= " AND date_candidature >= :date_debut";
            $params[':date_debut'] = $filters['date_debut'];
        }
        if (!empty($filters['date_fin'])) {
            $sql .= " AND date_candidature <= :date_fin";
            $params[':date_fin'] = $filters['date_fin'];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}