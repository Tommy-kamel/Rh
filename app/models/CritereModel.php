<?php

namespace app\models;

class CritereModel {
    
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    /**
     * Récupère tous les critères
     * 
     * @return array Liste des critères
     */
    public function getAllCriteres() {
        $query = "SELECT * FROM criteres ORDER BY id_critere";
        
        $statement = $this->db->prepare($query);
        $statement->execute();
        
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère un critère par son ID
     * 
     * @param int $id ID du critère
     * @return array|false Détails du critère ou false si non trouvé
     */
    public function getCritereById($id) {
        $query = "SELECT * FROM criteres WHERE id_critere = :id";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère les critères pour une annonce spécifique
     * 
     * @param int $id_annonce ID de l'annonce
     * @return array Liste des critères associés à l'annonce
     */
    public function getCriteresForAnnonce($id_annonce) {
        $query = "SELECT * FROM criteres WHERE id_annonce = :id_annonce ORDER BY coefficient DESC";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id_annonce', $id_annonce, \PDO::PARAM_INT);
        $statement->execute();
        
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Ajoute un nouveau critère simple
     * 
     * @param string $nom_critere Nom du critère
     * @param int $coefficient Coefficient d'importance (1-10)
     * @param int $id_annonce ID de l'annonce associée
     * @return int|false ID du nouveau critère ou false en cas d'échec
     */
    public function ajouterCritere($nom_critere, $coefficient, $id_annonce) {
        $query = "INSERT INTO criteres (nom_critere, coefficient, id_annonce) 
                 VALUES (:nom_critere, :coefficient, :id_annonce)";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':nom_critere', $nom_critere);
        $statement->bindParam(':coefficient', $coefficient, \PDO::PARAM_INT);
        $statement->bindParam(':id_annonce', $id_annonce, \PDO::PARAM_INT);
        
        if ($statement->execute()) {
            return $this->db->lastInsertId();
        }
        
        return false;
    }
    
    /**
     * Met à jour un critère simple
     * 
     * @param int $id_critere ID du critère
     * @param string $nom_critere Nom du critère
     * @param int $coefficient Coefficient d'importance (1-10)
     * @return bool Succès ou échec de la mise à jour
     */
    public function updateCritere($id_critere, $nom_critere, $coefficient) {
        $query = "UPDATE criteres 
                 SET nom_critere = :nom_critere, coefficient = :coefficient
                 WHERE id_critere = :id_critere";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':nom_critere', $nom_critere);
        $statement->bindParam(':coefficient', $coefficient, \PDO::PARAM_INT);
        $statement->bindParam(':id_critere', $id_critere, \PDO::PARAM_INT);
        
        return $statement->execute();
    }
    
    /**
     * Supprime un critère
     * 
     * @param int $id_critere ID du critère à supprimer
     * @return bool Succès ou échec de la suppression
     */
    public function deleteCritere($id_critere) {
        $query = "DELETE FROM criteres WHERE id_critere = :id_critere";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id_critere', $id_critere, \PDO::PARAM_INT);
        
        return $statement->execute();
    }
    
    /**
     * Supprime tous les critères associés à une annonce
     * 
     * @param int $id_annonce ID de l'annonce
     * @return bool Succès ou échec de la suppression
     */
    public function deleteCriteresForAnnonce($id_annonce) {
        $query = "DELETE FROM criteres WHERE id_annonce = :id_annonce";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id_annonce', $id_annonce, \PDO::PARAM_INT);
        
        return $statement->execute();
    }
    
    /**
     * Méthode de compatibilité pour l'ancienne structure de table
     * À utiliser uniquement si la structure de la table n'a pas été mise à jour
     */
    public function ajouterCritereAncienneVersion($age_min, $sexe, $experience, $diplome_requis, $langues_maitrisees, $age_max) {
        $query = "INSERT INTO criteres (age_min, sexe, experience, diplome_requis, langues_maitrisees, age_max) 
                 VALUES (:age_min, :sexe, :experience, :diplome_requis, :langues_maitrisees, :age_max)";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':age_min', $age_min, \PDO::PARAM_INT);
        $statement->bindParam(':sexe', $sexe);
        $statement->bindParam(':experience', $experience, \PDO::PARAM_INT);
        $statement->bindParam(':diplome_requis', $diplome_requis);
        $statement->bindParam(':langues_maitrisees', $langues_maitrisees);
        $statement->bindParam(':age_max', $age_max, \PDO::PARAM_INT);
        
        if ($statement->execute()) {
            return $this->db->lastInsertId();
        }
        
        return false;
    }
}




