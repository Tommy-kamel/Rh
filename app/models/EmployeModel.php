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

    
    public function getAllEmployesSousContrat() {
        $stmt = $this->db->prepare("SELECT e.*, c.* FROM employe e JOIN contrat c ON e.id_employe = c.id_employe WHERE c.date_fin IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEmployesSousContratEssai() {
        $stmt = $this->db->prepare("SELECT ca.*,ce.* FROM candidat_retenu ca JOIN contrat_essai ce ON ca.id_candidat_retenu = ce.id_candidat_retenu WHERE ce.date_fin IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


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

    public function getCandidatById($id_candidat) {
        $stmt = $this->db->prepare("SELECT * FROM candidat WHERE id_candidat = :id_candidat");
        $stmt->execute([':id_candidat' => $id_candidat]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPosteByIdAnnonce($id_annonce) {
        $stmt = $this->db->prepare("SELECT p.* FROM poste p JOIN annonce a ON p.nom = a.poste_voulu WHERE a.id_annonce = :id_annonce");
        $stmt->execute([':id_annonce' => $id_annonce]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getFonctionByIdPoste($id_poste){
        $stmt = $this->db->prepare("SELECT f.* FROM fonction f JOIN poste p ON f.id_fonction = p.id_fonction WHERE p.id_poste = :id_poste");
        $stmt->execute([':id_poste' => $id_poste]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCandidatRetenuById($id_candidat) {
        $stmt = $this->db->prepare("SELECT * FROM candidat_retenu WHERE id_candidat = :id_candidat");
        $stmt->execute([':id_candidat' => $id_candidat]);
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

    public function getContratById($id_contrat) {
        $stmt = $this->db->prepare("SELECT * FROM contrat WHERE id_contrat = :id_contrat");
        $stmt->execute([':id_contrat' => $id_contrat]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getEmployeById($id_employe) {
        $stmt = $this->db->prepare("SELECT * FROM employe WHERE id_employe = :id_employe");
        $stmt->execute([':id_employe' => $id_employe]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllEmployesSousContratEssaiFiltered($filters = []) {
        $sql = "SELECT ca.*, ce.* FROM candidat_retenu ca JOIN contrat_essai ce ON ca.id_candidat_retenu = ce.id_candidat_retenu WHERE ce.date_fin IS NULL";
        $params = [];

        if (!empty($filters['nom'])) {
            $sql .= " AND ca.nom LIKE :nom";
            $params[':nom'] = '%' . $filters['nom'] . '%';
        }
        if (!empty($filters['prenom'])) {
            $sql .= " AND ca.prenom LIKE :prenom";
            $params[':prenom'] = '%' . $filters['prenom'] . '%';
        }
        if (!empty($filters['date_debut_debut'])) {
            $sql .= " AND ce.date_debut >= :date_debut_debut";
            $params[':date_debut_debut'] = $filters['date_debut_debut'];
        }
        if (!empty($filters['date_debut_fin'])) {
            $sql .= " AND ce.date_debut <= :date_debut_fin";
            $params[':date_debut_fin'] = $filters['date_debut_fin'];
        }
        if (!empty($filters['date_fin_debut'])) {
            $sql .= " AND ce.date_fin >= :date_fin_debut";
            $params[':date_fin_debut'] = $filters['date_fin_debut'];
        }
        if (!empty($filters['date_fin_fin'])) {
            $sql .= " AND ce.date_fin <= :date_fin_fin";
            $params[':date_fin_fin'] = $filters['date_fin_fin'];
        }
        if (!empty($filters['salaire_min'])) {
            $sql .= " AND ce.salaire >= :salaire_min";
            $params[':salaire_min'] = $filters['salaire_min'];
        }
        if (!empty($filters['salaire_max'])) {
            $sql .= " AND ce.salaire <= :salaire_max";
            $params[':salaire_max'] = $filters['salaire_max'];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEmployesSousContratFiltered($filters = []) {
        $sql = "SELECT e.*, c.* FROM employe e JOIN contrat c ON e.id_employe = c.id_employe WHERE c.date_fin IS NULL";
        $params = [];

        if (!empty($filters['nom'])) {
            $sql .= " AND e.nom LIKE :nom";
            $params[':nom'] = '%' . $filters['nom'] . '%';
        }
        if (!empty($filters['prenom'])) {
            $sql .= " AND e.prenom LIKE :prenom";
            $params[':prenom'] = '%' . $filters['prenom'] . '%';
        }
        if (!empty($filters['date_debut_debut'])) {
            $sql .= " AND c.date_debut >= :date_debut_debut";
            $params[':date_debut_debut'] = $filters['date_debut_debut'];
        }
        if (!empty($filters['date_debut_fin'])) {
            $sql .= " AND c.date_debut <= :date_debut_fin";
            $params[':date_debut_fin'] = $filters['date_debut_fin'];
        }
        if (!empty($filters['salaire_min'])) {
            $sql .= " AND c.salaire >= :salaire_min";
            $params[':salaire_min'] = $filters['salaire_min'];
        }
        if (!empty($filters['salaire_max'])) {
            $sql .= " AND c.salaire <= :salaire_max";
            $params[':salaire_max'] = $filters['salaire_max'];
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function creerContratEssai($id_candidat_retenu, $salaire) {
        $date_debut = date('Y-m-d');
        $stmt = $this->db->prepare("INSERT INTO contrat_essai (id_candidat_retenu, date_debut, date_fin, salaire) VALUES (:id_candidat_retenu, :date_debut, NULL, :salaire)");
        $stmt->execute([
            ':id_candidat_retenu' => $id_candidat_retenu,
            ':salaire' => $salaire,
            ':date_debut' => $date_debut
        ]);
        return $this->db->lastInsertId();
    }

    public function terminerContrat($id_contrat, $date_fin) {
        $stmt = $this->db->prepare("UPDATE contrat SET date_fin = :date_fin WHERE id_contrat = :id_contrat");
        return $stmt->execute([
            ':date_fin' => $date_fin,
            ':id_contrat' => $id_contrat
        ]);
    }
}