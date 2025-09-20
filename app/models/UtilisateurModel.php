<?php
namespace app\models;
use Flight;

class UtilisateurModel {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    /**
     * Vérifie les identifiants de l'utilisateur
     * 
     * @param string $nom_utilisateur Nom d'utilisateur
     * @param string $mot_de_passe Mot de passe (non hashé)
     * @return array|false Données de l'utilisateur ou false si non trouvé
     */
    public function verifierIdentifiants($nom_utilisateur, $mot_de_passe) {
        $sql = "SELECT * FROM user WHERE nom_utilisateur = :nom_utilisateur AND mot_de_passe = :mot_de_passe";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom_utilisateur' => $nom_utilisateur,
            ':mot_de_passe' => $mot_de_passe
        ]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function getFonction($nom, $mot_de_passe){
        $sql = "SELECT f.* FROM fonction f JOIN user u 
        ON f.id_fonction = u.id_fonction 
        WHERE u.nom_utilisateur = :nom_utilisateur AND u.mot_de_passe = :mot_de_passe";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nom_utilisateur' => $nom, ':mot_de_passe' => $mot_de_passe]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    /**
     * Récupère un utilisateur par son ID
     * 
     * @param int $id_user ID de l'utilisateur
     * @return array|false Données de l'utilisateur ou false si non trouvé
     */
    public function getUtilisateurParId($id_user) {
        $sql = "SELECT * FROM user WHERE id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_user' => $id_user]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupère tous les utilisateurs
     * 
     * @return array Liste des utilisateurs
     */
    public function getAllUtilisateurs() {
        $sql = "SELECT * FROM user";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Crée un nouvel utilisateur
     * 
     * @param string $nom_utilisateur Nom d'utilisateur
     * @param string $mot_de_passe Mot de passe (sera stocké en clair)
     * @param string $fonction Fonction de l'utilisateur
     * @return int|false ID du nouvel utilisateur ou false en cas d'échec
     */
    public function creerUtilisateur($nom_utilisateur, $mot_de_passe, $fonction) {
        $sql = "INSERT INTO user (nom_utilisateur, mot_de_passe, fonction) 
                VALUES (:nom_utilisateur, :mot_de_passe, :fonction)";
        
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            ':nom_utilisateur' => $nom_utilisateur,
            ':mot_de_passe' => $mot_de_passe,
            ':fonction' => $fonction
        ]);
        
        return $result ? $this->db->lastInsertId() : false;
    }
    
    /**
     * Modifie un utilisateur existant
     * 
     * @param int $id_user ID de l'utilisateur
     * @param array $donnees Données à modifier
     * @return bool Résultat de la modification
     */
    public function modifierUtilisateur($id_user, $donnees) {
        // Construction de la requête SQL dynamique
        $sets = [];
        $params = [':id_user' => $id_user];
        
        foreach ($donnees as $champ => $valeur) {
            $sets[] = "$champ = :$champ";
            $params[":$champ"] = $valeur;
        }
        
        $sql = "UPDATE user SET " . implode(', ', $sets) . " WHERE id_user = :id_user";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
    
    /**
     * Supprime un utilisateur
     * 
     * @param int $id_user ID de l'utilisateur à supprimer
     * @return bool Résultat de la suppression
     */
    public function supprimerUtilisateur($id_user) {
        $sql = "DELETE FROM user WHERE id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id_user' => $id_user]);
    }
}