<?php
// Fichier : app/models/FiltrageModel.php
namespace app\models;

use PDO;
use DateTime;

class FiltrageModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function traiterCandidats() {
        $candidats = $this->getCandidatsATraiter();
        $retenus = 0;
        $rejetes = 0;

        foreach ($candidats as $candidat) {
            $criteres = $this->getCriteresPourAnnonce($candidat['id_annonce']);
            $exigences = $this->getNiveauxExigencePourAnnonce($candidat['id_annonce']);

            if ($this->verifierCandidat($candidat, $criteres, $exigences)) {
                $this->insererCandidatRetenu($candidat);
                $retenus++;
            } else {
                $rejetes++;
            }
        }

        return array('retenus' => $retenus, 'rejetes' => $rejetes);
    }

    public function getCandidatsATraiter($tri = 'age', $searchParams = array()) {
        $query = "SELECT c.id_candidat, c.id_annonce, c.nom, c.prenom, c.mail, c.telephone, c.niveau_etude, c.experience, 
                         TIMESTAMPDIFF(YEAR, c.date_de_naissance, CURDATE()) AS age, 
                         c.date_de_naissance, c.adresse, c.sexe, c.date_candidature, c.photo
                  FROM candidat c
                  WHERE c.id_candidat NOT IN (SELECT id_candidat FROM candidat_retenu)";
        $params = array();
        $conditions = array();

        // Recherche multicritère
        if (!empty($searchParams['nom_prenom'])) {
            $conditions[] = "(c.nom LIKE ? OR c.prenom LIKE ?)";
            $params[] = "%" . $searchParams['nom_prenom'] . "%";
            $params[] = "%" . $searchParams['nom_prenom'] . "%";
        }
        if (!empty($searchParams['email'])) {
            $conditions[] = "c.mail LIKE ?";
            $params[] = "%" . $searchParams['email'] . "%";
        }
        if (!empty($searchParams['niveau_etude'])) {
            $conditions[] = "c.niveau_etude = ?";
            $params[] = $searchParams['niveau_etude'];
        }
        if (!empty($searchParams['experience_min'])) {
            $conditions[] = "c.experience >= ?";
            $params[] = $searchParams['experience_min'];
        }
        if (!empty($searchParams['experience_max'])) {
            $conditions[] = "c.experience <= ?";
            $params[] = $searchParams['experience_max'];
        }
        if (!empty($searchParams['age_min'])) {
            $conditions[] = "TIMESTAMPDIFF(YEAR, c.date_de_naissance, CURDATE()) >= ?";
            $params[] = $searchParams['age_min'];
        }
        if (!empty($searchParams['age_max'])) {
            $conditions[] = "TIMESTAMPDIFF(YEAR, c.date_de_naissance, CURDATE()) <= ?";
            $params[] = $searchParams['age_max'];
        }
        if (!empty($searchParams['sexe'])) {
            $conditions[] = "c.sexe = ?";
            $params[] = $searchParams['sexe'];
        }
        if (!empty($searchParams['date_candidature'])) {
            $conditions[] = "DATE(c.date_candidature) = ?";
            $params[] = $searchParams['date_candidature'];
        }

        if (!empty($conditions)) {
            $query .= " AND " . implode(" AND ", $conditions);
        }

        // Tri
        switch ($tri) {
            case 'diplome':
                $query .= " ORDER BY c.niveau_etude";
                break;
            case 'experience':
                $query .= " ORDER BY c.experience DESC";
                break;
            case 'age':
            default:
                $query .= " ORDER BY age";
                break;
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCandidatsRetenus($tri = 'age', $searchParams = array()) {
        $query = "SELECT cr.id_candidat, cr.nom, cr.prenom, cr.mail, cr.telephone, cr.niveau_etude, cr.experience, 
                         TIMESTAMPDIFF(YEAR, cr.date_de_naissance, CURDATE()) AS age, 
                         cr.date_de_naissance, cr.adresse, cr.sexe, cr.photo, cr.date_creation,
                         s.score_total
                  FROM candidat_retenu cr
                  INNER JOIN scoring s ON cr.id_candidat = s.id_candidat";
        $params = array();
        $conditions = array();

        // Recherche multicritère
        if (!empty($searchParams['nom_prenom'])) {
            $conditions[] = "(cr.nom LIKE ? OR cr.prenom LIKE ?)";
            $params[] = "%" . $searchParams['nom_prenom'] . "%";
            $params[] = "%" . $searchParams['nom_prenom'] . "%";
        }
        if (!empty($searchParams['email'])) {
            $conditions[] = "cr.mail LIKE ?";
            $params[] = "%" . $searchParams['email'] . "%";
        }
        if (!empty($searchParams['niveau_etude'])) {
            $conditions[] = "cr.niveau_etude = ?";
            $params[] = $searchParams['niveau_etude'];
        }
        if (!empty($searchParams['experience_min'])) {
            $conditions[] = "cr.experience >= ?";
            $params[] = $searchParams['experience_min'];
        }
        if (!empty($searchParams['experience_max'])) {
            $conditions[] = "cr.experience <= ?";
            $params[] = $searchParams['experience_max'];
        }
        if (!empty($searchParams['age_min'])) {
            $conditions[] = "TIMESTAMPDIFF(YEAR, cr.date_de_naissance, CURDATE()) >= ?";
            $params[] = $searchParams['age_min'];
        }
        if (!empty($searchParams['age_max'])) {
            $conditions[] = "TIMESTAMPDIFF(YEAR, cr.date_de_naissance, CURDATE()) <= ?";
            $params[] = $searchParams['age_max'];
        }
        if (!empty($searchParams['sexe'])) {
            $conditions[] = "cr.sexe = ?";
            $params[] = $searchParams['sexe'];
        }
        if (!empty($searchParams['date_candidature'])) {
            $conditions[] = "DATE(cr.date_creation) = ?";
            $params[] = $searchParams['date_candidature'];
        }

        if (!empty($conditions)) {
            $query .= " AND " . implode(" AND ", $conditions);
        }

        // Tri
        switch ($tri) {
            case 'diplome':
                $query .= " ORDER BY cr.niveau_etude";
                break;
            case 'experience':
                $query .= " ORDER BY cr.experience DESC";
                break;
            case 'score':
                $query .= " ORDER BY s.score_total DESC";
                break;
            case 'age':
            default:
                $query .= " ORDER BY age";
                break;
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCriteresPourAnnonce($id_annonce) {
        $stmt = $this->db->prepare("SELECT * FROM criteres WHERE id_critere = (SELECT id_critere FROM annonce WHERE id_annonce = ?)");
        $stmt->execute([$id_annonce]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getNiveauxExigencePourAnnonce($id_annonce) {
        $stmt = $this->db->prepare("SELECT * FROM niveau_exigence WHERE id_annonce = ?");
        $stmt->execute([$id_annonce]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verifierCandidat($candidat, $criteres, $exigences) {
        $niveaux = array(
            'CEPE' => 1,
            'BEPC' => 2,
            'BAC' => 3,
            'LICENCE' => 4,
            'MASTER' => 5,
            'DOCTORAT' => 6
        );

        foreach ($exigences as $type => $exigence) {
            if ($exigence == 0) {
                continue;
            }

            if ($type == 'experience') {
                if ($candidat['experience'] < $criteres['experience_requise']) {
                    return false;
                }
            } else if ($type == 'age') {
                $age = $this->calculerAge($candidat['date_de_naissance']);
                if ($age < $criteres['age_minimum'] || $age > $criteres['age_maximum']) {
                    return false;
                }
            } else if ($type == 'diplome') {
                $niveauCandidat = isset($niveaux[$candidat['niveau_etude']]) ? $niveaux[$candidat['niveau_etude']] : 0;
                $niveauRequis = isset($niveaux[$criteres['diplome_requis']]) ? $niveaux[$criteres['diplome_requis']] : 0;
                if ($niveauCandidat < $niveauRequis) {
                    return false;
                }
            } else if ($type == 'lieu') {
                if (strpos($candidat['adresse'], $criteres['lieu_a_proximite']) === false) {
                    return false;
                }
            }
        }
        return true;
    }

    public function calculerAge($dateNaissanceStr) {
        $dateNaissance = new DateTime($dateNaissanceStr);
        $dateActuelle = new DateTime();
        $diff = $dateActuelle->diff($dateNaissance);
        return $diff->y;
    }

    public function insererCandidatRetenu($candidat) {
        // Insérer dans candidat_retenu
        $stmt = $this->db->prepare("
            INSERT INTO candidat_retenu (id_candidat, nom, prenom, mail, telephone, niveau_etude, experience, date_de_naissance, adresse, sexe, photo, date_creation)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute(array(
            $candidat['id_candidat'],
            $candidat['nom'],
            $candidat['prenom'],
            $candidat['mail'],
            $candidat['telephone'],
            $candidat['niveau_etude'],
            $candidat['experience'],
            $candidat['date_de_naissance'],
            $candidat['adresse'],
            $candidat['sexe'],
            $candidat['photo']
        ));

        // Insérer un score par défaut dans scoring
        /* $stmt = $this->db->prepare("
            INSERT INTO scoring (id_candidat, score_total)
            VALUES (?, 0)
        ");
        $stmt->execute([$candidat['id_candidat']]); */
    }
}
?>