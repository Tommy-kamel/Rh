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
        $query = "SELECT c.id_candidat,c.id_annonce, c.nom, c.prenom, c.mail, c.telephone, c.niveau_etude, c.experience, 
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
            $conditions[] = "c.date_candidature = ?";
            $params[] = $searchParams['date_candidature'];
        }

        if (!empty($conditions)) {
            $query .= " AND " . implode(" AND ", $conditions);
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        $candidats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->trierCandidats($candidats, $tri);
    }

    public function getCandidatsRetenus($tri = 'age', $searchParams = array()) {
        $query = "SELECT cr.id_candidat_retenu, cr.id_candidat, cr.nom, cr.prenom, cr.mail, cr.telephone, cr.niveau_etude, cr.experience, 
                     TIMESTAMPDIFF(YEAR, cr.date_de_naissance, CURDATE()) AS age, 
                     cr.date_de_naissance, cr.adresse, cr.sexe, cr.photo, cr.date_creation,
                     COALESCE(s.score_total, 0) AS score
              FROM candidat_retenu cr
            JOIN candidat c ON cr.id_candidat = c.id_candidat
              LEFT JOIN scoring s ON cr.id_candidat = s.id_candidat";
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


        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        $candidats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->trierCandidats($candidats, $tri);
    }

    public function getScoreCandidatRetenu($candidat) {
        $id_candidat = $candidat['id_candidat'];
        $stmt = $this->db->prepare("
            SELECT s.score_total
            FROM scoring s
            INNER JOIN candidat_retenu cr ON s.id_candidat = cr.id_candidat
            WHERE s.id_candidat = ?
        ");
        $stmt->execute([$id_candidat]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['score_total'] : 0; // Retourne 0 si aucun score ou si le candidat n'est pas retenu
    }

    private function trierCandidats($candidats, $tri) {
        $n = count($candidats);
        $niveaux = array('CEPE' => 1, 'BEPC' => 2, 'BAC' => 3, 'LICENCE' => 4, 'MASTER' => 5, 'DOCTORAT' => 6);

        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                $swap = false;

                if ($tri == 'age') {
                    if ($candidats[$i]['age'] < $candidats[$j]['age']) {
                        $swap = true;
                    }
                } else if ($tri == 'diplome') {
                    $niveauA = 0;
                    $niveauB = 0;
                    if (isset($niveaux[$candidats[$i]['niveau_etude']])) {
                        $niveauA = $niveaux[$candidats[$i]['niveau_etude']];
                    }
                    if (isset($niveaux[$candidats[$j]['niveau_etude']])) {
                        $niveauB = $niveaux[$candidats[$j]['niveau_etude']];
                    }
                    if ($niveauA < $niveauB) {
                        $swap = true;
                    }
                } else if ($tri == 'experience') {
                    if ($candidats[$i]['experience'] < $candidats[$j]['experience']) {
                        $swap = true;
                    }
                } else if ($tri == 'score') {
                    $scoreA = $this->getScoreCandidatRetenu($candidats[$i]);
                    $scoreB = $this->getScoreCandidatRetenu($candidats[$j]);
                    if ($scoreA < $scoreB) {
                        $swap = true;
                    }
                }

                if ($swap) {
                    $temp = $candidats[$i];
                    $candidats[$i] = $candidats[$j];
                    $candidats[$j] = $temp;
                }
            }
        }

        return $candidats;
    }


    public function getCriteresPourAnnonce($id_annonce) {
        $stmt = $this->db->prepare("
            SELECT cr.* FROM criteres cr
            JOIN annonce a ON a.id_critere = cr.id_critere
            WHERE a.id_annonce = ?
        ");
        $stmt->execute(array($id_annonce));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : array();
    }

    public function getNiveauxExigencePourAnnonce($id_annonce) {
        $stmt = $this->db->prepare("SELECT * FROM niveau_exigence WHERE id_annonce = ?");
        $stmt->execute(array($id_annonce));
        $exigences = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $map = array();
        foreach ($exigences as $ex) {
            $map[$ex['type_critere']] = $ex['niveau'];
        }
        return $map;
    }

    public function verifierCandidat($candidat, $criteres, $exigences) {
        if (empty($criteres) || empty($exigences)) {
            return false;
        }

        foreach ($exigences as $type => $niveau) {
            $satisfait = $this->verifierCritere($type, $candidat, $criteres);
            if ($niveau == 'obligatoire' && !$satisfait) {
                return false;
            }
        }
        return true;
    }

    public function verifierCritere($type, $candidat, $criteres) {
        if ($type == 'age') {
            $ageCandidat = $this->calculerAge($candidat['date_de_naissance']);
            return ($ageCandidat >= $criteres['age_min']) && ($ageCandidat <= $criteres['age_max']);
        } else if ($type == 'sexe') {
            return $candidat['sexe'] == $criteres['sexe'];
        } else if ($type == 'experience') {
            return $candidat['experience'] >= $criteres['experience'];
        } else if ($type == 'diplome') {
            $niveaux = array('CEPE' => 1, 'BEPC' => 2, 'BAC' => 3, 'LICENCE' => 4, 'MASTER' => 5, 'DOCTORAT' => 6);
            $niveauCandidat = 0;
            $niveauRequis = 0;
            if (isset($niveaux[$candidat['niveau_etude']])) {
                $niveauCandidat = $niveaux[$candidat['niveau_etude']];
            }
            if (isset($niveaux[$criteres['diplome_requis']])) {
                $niveauRequis = $niveaux[$criteres['diplome_requis']];
            }
            return $niveauCandidat >= $niveauRequis;
        } else if ($type == 'lieu') {
            return strpos($candidat['adresse'], $criteres['lieu_a_proximite']) !== false;
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
    }
}

?>