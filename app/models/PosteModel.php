<?php

namespace app\models;

class PosteModel {
    
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    /**
     * Récupère tous les postes avec leurs critères associés
     * 
     * @return array Liste des postes
     */
    public function getAllPostes() {
        $query = "SELECT p.*, c.age_min, c.age_max, c.sexe, c.experience, c.diplome_requis, c.langues_maitrisees
                 FROM poste p 
                 JOIN criteres c ON p.id_critere = c.id_critere 
                 ORDER BY p.nom";
        
        $statement = $this->db->prepare($query);
        $statement->execute();
        
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère un poste par son ID
     * 
     * @param int $id ID du poste
     * @return array|false Détails du poste ou false si non trouvé
     */
    public function getPosteById($id) {
        $query = "SELECT p.*, c.age_min, c.age_max, c.sexe, c.experience, c.diplome_requis, c.langues_maitrisees
                 FROM poste p 
                 JOIN criteres c ON p.id_critere = c.id_critere 
                 WHERE p.id_poste = :id";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Ajoute un nouveau poste
     * 
     * @param string $nom Nom du poste
     * @param int|null $id_critere ID du critère associé (peut être null)
     * @return int|false ID du nouveau poste ou false en cas d'échec
     */
    public function ajouterPoste($nom, $id_critere) {
        // Vérifie si id_critere est NULL et ajuste la requête en conséquence
        if ($id_critere === null) {
            $query = "INSERT INTO poste (nom) VALUES (:nom)";
            
            $statement = $this->db->prepare($query);
            $params = [':nom' => $nom];
        } else {
            $query = "INSERT INTO poste (nom, id_critere) VALUES (:nom, :id_critere)";
            
            $statement = $this->db->prepare($query);
            $params = [
                ':nom' => $nom,
                ':id_critere' => $id_critere
            ];
        }
        
        if ($statement->execute($params)) {
            return $this->db->lastInsertId();
        }
        
        return false;
    }
    
    /**
     * Met à jour un poste
     * 
     * @param int $id_poste ID du poste
     * @param string $nom Nouveau nom du poste
     * @param int $id_critere ID du critère associé
     * @return bool Succès ou échec de la mise à jour
     */
    public function updatePoste($id_poste, $nom, $id_critere) {
        $query = "UPDATE poste SET nom = :nom, id_critere = :id_critere WHERE id_poste = :id_poste";
        
        $statement = $this->db->prepare($query);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':id_critere', $id_critere, \PDO::PARAM_INT);
        $statement->bindParam(':id_poste', $id_poste, \PDO::PARAM_INT);
        
        return $statement->execute();
    }
    
    /**
     * Supprime un poste
     * 
     * @param int $id ID du poste à supprimer
     * @return bool Succès ou échec de la suppression
     */
    public function supprimerPoste($id) {
        // Vérifier si le poste est utilisé dans des annonces
        $query1 = "SELECT COUNT(*) FROM annonce WHERE poste_voulu = (SELECT nom FROM poste WHERE id_poste = :id)";
        $statement1 = $this->db->prepare($query1);
        $statement1->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement1->execute();
        
        if ($statement1->fetchColumn() > 0) {
            // Le poste est utilisé, ne pas supprimer
            return false;
        }
        
        // Le poste n'est pas utilisé, on peut le supprimer
        $query2 = "DELETE FROM poste WHERE id_poste = :id";
        $statement2 = $this->db->prepare($query2);
        $statement2->bindParam(':id', $id, \PDO::PARAM_INT);
        
        return $statement2->execute();
    }
}