<?php

namespace app\models;
use Flight;
use PDO;

class AnnonceModel {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAnnoncesAvecCriteres() {
        $stmt = $this->db->prepare("
            SELECT a.*, c.age_min, c.sexe, c.experience, c.diplome_requis, c.langues_maitrisees, c.age_max,c.lieu_a_proximite
            FROM annonce a
            JOIN criteres c ON a.id_critere = c.id_critere
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAnnonces() {
        $stmt = $this->db->prepare("SELECT * FROM annonce");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer toutes les fonctions
    public function getAllFonctions() {
        $stmt = $this->db->prepare("SELECT * FROM fonction ORDER BY nom_fonction");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Ajouter une nouvelle annonce avec les critères déjà créés
    public function ajouterAnnonce($poste, $date_limite, $critere_id, $id_fonction) {
        $stmt = $this->db->prepare("
            INSERT INTO annonce (poste_voulu, date_depot_limite, id_critere, id_fonction) 
            VALUES ('".$poste."', '".$date_limite."', ".$critere_id." , ".$id_fonction.")
        ");
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function ajouterPoste($nom,$id_fonction) {
        $stmt = $this->db->prepare("
            INSERT INTO poste (id_fonction,nom) 
            VALUES ('".$id_fonction."', '".$nom."')
        ");
        $stmt->execute();
        return $this->db->lastInsertId();
    }
    
    // Ajouter des critères pour une annonce
    public function ajouterCriteres($age_min, $age_max, $sexe, $experience, $diplome, $langues, $lieu_a_proximite = '') {
        $stmt = $this->db->prepare("
            INSERT INTO criteres (age_min, age_max, sexe, experience, diplome_requis, langues_maitrisees, lieu_a_proximite) 
            VALUES (".$age_min.", ".$age_max.", '".$sexe."', ".$experience.", '".$diplome."', '".$langues."', '".$lieu_a_proximite."')
        ");
        $stmt->execute();
        return $this->db->lastInsertId();
    }
    
    // Ajouter les niveaux d'exigence
    public function ajouterNiveauxExigence($id_annonce, $niveaux) {
        foreach ($niveaux as $type_critere => $niveau) {
            $stmt = $this->db->prepare("
                INSERT INTO niveau_exigence (id_annonce, type_critere, niveau) 
                VALUES (".$id_annonce.", '".$type_critere."', '".$niveau."')
            ");
            $stmt->execute();
        }
        return true;
    }
    
    // Récupérer les niveaux d'exigence pour une annonce
    public function getNiveauxExigence($id_annonce) {
        $stmt = $this->db->prepare("
            SELECT * FROM niveau_exigence 
            WHERE id_annonce = ".$id_annonce
        );
        $stmt->execute();
        $niveaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $result = [];
        foreach ($niveaux as $niveau) {
            $result[$niveau['type_critere']] = $niveau['niveau'];
        }
        
        return $result;
    }


}