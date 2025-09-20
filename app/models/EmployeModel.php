<?php

namespace app\models;
use Flight;
use PDO;

class EmployeModel {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Mila atambatra am contrat
    public function getAllEmployesSousContrat() {
        $stmt = $this->db->prepare("SELECT * FROM employe");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEmployesSousContratEssai() {
        $stmt = $this->db->prepare("SELECT ca.*,ce.* FROM candidat_retenu ca JOIN contrat_essai ce ON ca.id_candidat_retenu = ce.id_candidat_retenu");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* public function getCandidatRetenuByContratEssaiId($id_contrat_essai) {
        $stmt = $this->db->prepare("SELECT * FROM contrat_essai WHERE id_contrat_essai = :id_contrat_essai");
        $stmt->execute([':id_contrat_essai' => $id_contrat_essai]);
        $contrat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $contrat ? $contrat['id_candidat_retenu'] : null;
    } */

    public function getContratEssaiById($id_contrat_essai) {
        $stmt = $this->db->prepare("SELECT * FROM contrat_essai WHERE id_contrat_essai = :id_contrat_essai");
        $stmt->execute([':id_contrat_essai' => $id_contrat_essai]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCandidatByIdCandidatRetenu($id_candidat_retenu) {
        $stmt = $this->db->prepare("SELECT * FROM candidat_retenu WHERE id_candidat_retenu = :id_candidat_retenu");
        $stmt->execute([':id_candidat_retenu' => $id_candidat_retenu]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createEmploye($nom, $prenom, $sexe, $mail, $tel, $date_naissance, $adresse) {
        try {
            $stmt = $this->db->prepare("INSERT INTO employe (nom, prenom, sexe, mail, telephone, date_naissance, adresse) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nom, $prenom, $sexe, $mail, $tel, $date_naissance, $adresse]);
            $id = $this->db->lastInsertId();
            if ($id == 0) {
                error_log("Insertion employe échouée : lastInsertId = 0");
                return false;
            }
            return $id;
        } catch (PDOException $e) {
            error_log("Erreur PDO dans createEmploye: " . $e->getMessage());
            return false;
        }
    }

    public function createContrat($id_employe, $salaire, $date_debut) {
        $stmt = $this->db->prepare("INSERT INTO contrat (id_employe, salaire, date_debut, date_fin) VALUES (:id_employe, :salaire, :date_debut, NULL)");
        $stmt->execute([
            ':id_employe' => $id_employe,
            ':salaire' => $salaire,
            ':date_debut' => $date_debut
        ]);
        return $this->db->lastInsertId();
    }

    public function terminerContratEssai($id_contrat_essai, $date_fin) {
        $stmt = $this->db->prepare("UPDATE contrat_essai SET date_fin = :date_fin WHERE id_contrat_essai = :id_contrat_essai");
        return $stmt->execute([
            ':date_fin' => $date_fin,
            ':id_contrat_essai' => $id_contrat_essai
        ]);
    }

    
}