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

}