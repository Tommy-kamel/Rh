<?php
// manda_model.php
namespace app\models;

use Exception;

class MandaModel {
    public $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getRandomQuestions($id_fonction, $nb_standard = 3, $nb_special = 2) {
        $standard_id = 5;
        $nb_standard = (int) $nb_standard;
        if ($nb_standard <= 0) {
            throw new Exception("Nombre de questions standard invalide.");
        }

        $stmt_standard = $this->pdo->prepare("
            SELECT id_question FROM question 
            WHERE id_fonction = :id_fonction 
            ORDER BY RAND() 
            LIMIT :limit
        ");
        $stmt_standard->bindValue(':id_fonction', $standard_id, \PDO::PARAM_INT);
        $stmt_standard->bindValue(':limit', $nb_standard, \PDO::PARAM_INT);
        $stmt_standard->execute();
        $standard_questions = $stmt_standard->fetchAll(\PDO::FETCH_COLUMN);

        $nb_special = (int) $nb_special;
        if ($nb_special <= 0) {
            throw new Exception("Nombre de questions spéciales invalide.");
        }

        $stmt_special = $this->pdo->prepare("
            SELECT id_question FROM question 
            WHERE id_fonction = :id_fonction 
            ORDER BY RAND() 
            LIMIT :limit
        ");
        $stmt_special->bindValue(':id_fonction', $id_fonction, \PDO::PARAM_INT);
        $stmt_special->bindValue(':limit', $nb_special, \PDO::PARAM_INT);
        $stmt_special->execute();
        $special_questions = $stmt_special->fetchAll(\PDO::FETCH_COLUMN);

        $all_questions = array_merge($standard_questions, $special_questions);
        $all_questions = array_unique($all_questions);

        // if (count($all_questions) < ($nb_standard + $nb_special)) {
        //     throw new Exception("Pas assez de questions disponibles.");
        // }

        shuffle($all_questions);
        return array_slice($all_questions, 0, $nb_standard + $nb_special);
    }

    public function getQuestionWithChoices($id_question) {
        $stmt = $this->pdo->prepare("
            SELECT q.id_question, q.intitule, q.duree_max,
                   c.id_choix, c.texte, c.est_correct
            FROM question q
            LEFT JOIN choix c ON q.id_question = c.id_question
            WHERE q.id_question = :id_question
            AND c.texte IS NOT NULL
            ORDER BY RAND()
        ");
        $stmt->execute(['id_question' => $id_question]);
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($results)) {
    $question = [
        'id' => 0,
        'intitule' => 'Question non définie',
        'duree_max' => 0,
        'choices' => []
    ];
} else {
    $question = [
        'id' => $results[0]['id_question'],
        'intitule' => $results[0]['intitule'] ?? 'Question non définie',
        'duree_max' => $results[0]['duree_max'] ?? 60,
        'choices' => []
    ];
}

        foreach ($results as $row) {
            if ($row['id_choix'] !== null) {
                $question['choices'][] = [
                    'id' => $row['id_choix'],
                    'texte' => $row['texte'] ?? 'Choix non défini',
                    'est_correct' => $row['est_correct']
                ];
            }
        }

        if (count($question['choices']) < 4) {
            // throw new Exception("Pas assez de choix valides pour la question ID $id_question.");
        }

        shuffle($question['choices']);
        return $question;
    }

    public function createTest($id_candidat, $score, $id_fonction) {
        $stmt = $this->pdo->prepare("
            INSERT INTO test (id_candidat, score, date_test, id_fonction) 
            VALUES (:id_candidat, :score, CURRENT_DATE, :id_fonction)
        ");
        $stmt->execute([
            'id_candidat' => $id_candidat,
            'score' => $score,
            'id_fonction' => $id_fonction
        ]);
        return $this->pdo->lastInsertId();
    }

    public function saveEntretien($id_candidat, $id_fonction ,$date_entretien ,$note ,$commentaire) {
        $stmt = $this->pdo->prepare("
            INSERT INTO entretien (id_candidat, id_fonction ,date_entretien ,note ,commentaire) 
            VALUES (:id_candidat, :id_fonction ,:date_entretien ,:note ,:commentaire)
        ");
        $stmt->execute([
            'id_candidat' => $id_candidat,
            'id_fonction' => $id_fonction,
            'date_entretien' => $date_entretien,
            'note' => $note,
            'commentaire' => $commentaire,
        ]);
        return $this->pdo->lastInsertId();
    }

    public function saveScore($id_candidat, $id_fonction ,$score_total) {
        $stmt = $this->pdo->prepare("
            INSERT INTO scoring (id_candidat, id_fonction, score_total) 
            VALUES (:id_candidat, :id_fonction ,:score_total)
        ");
        $stmt->execute([
            'id_candidat' => $id_candidat,
            'id_fonction' => $id_fonction,
            'score_total' => $score_total
        ]);
        return $this->pdo->lastInsertId();
    }

    public function saveResponses($id_test, $responses) {
        $stmt = $this->pdo->prepare("
            INSERT INTO reponse (id_test, id_question, id_choix) 
            VALUES (:id_test, :id_question, :id_choix)
        ");
        foreach ($responses as $id_question => $id_choix) {
            $stmt->execute([
                'id_test' => $id_test,
                'id_question' => $id_question,
                'id_choix' => $id_choix
            ]);
        }
    }

    public function getLastTestScore($id_candidat, $id_fonction) {
        $stmt = $this->pdo->prepare("
            SELECT score FROM test
            WHERE id_candidat = :id_candidat AND id_fonction = :id_fonction
            ORDER BY date_test DESC
            LIMIT 1
        ");
        $stmt->execute([
            'id_candidat' => $id_candidat,
            'id_fonction' => $id_fonction
        ]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result['score'] : null;
    }

    public function getTestScore($id_candidat) {
        $stmt = $this->pdo->prepare("
            SELECT score FROM test 
            WHERE id_candidat = :id_candidat 
            ORDER BY date_test DESC 
            LIMIT 1
        ");
        $stmt->execute(['id_candidat' => $id_candidat]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result['score'] : 0;
    }

    public function isChoiceCorrect($id_choix) {
        $stmt = $this->pdo->prepare("SELECT est_correct FROM choix WHERE id_choix = :id_choix");
        $stmt->execute(['id_choix' => $id_choix]);
        $result = $stmt->fetchColumn();
        return $result ? true : false;
    }

    public function getVariable() {
        $stmt = $this->pdo->prepare("
            SELECT nb_question, pourcentage_test, pourcentage_entretien
            FROM variable
            ORDER BY date_changement DESC
            LIMIT 1
        ");
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ?: [
            'nb_question' => 5,
            'pourcentage_test' => 0.60,
            'pourcentage_entretien' => 0.40
        ];
    }

    public function updatePourcentages($pourcentage_test, $pourcentage_entretien) {
    $stmt = $this->pdo->prepare("
        INSERT INTO variable (nb_question, pourcentage_test, pourcentage_entretien, date_changement)
        VALUES (:nb_question, :pourcentage_test, :pourcentage_entretien, CURRENT_DATE)
    ");
    $stmt->execute([
        'nb_question' => $this->getVariable()['nb_question'], // Conserver la valeur actuelle
        'pourcentage_test' => $pourcentage_test,
        'pourcentage_entretien' => $pourcentage_entretien
    ]);
    return $this->pdo->lastInsertId();
}

public function getQuestionsByFonction($id_fonction) {
    $stmt = $this->pdo->prepare("
        SELECT q.id_question, q.intitule, q.duree_max
        FROM question q
        WHERE q.id_fonction = :id_fonction
        ORDER BY q.id_question
    ");
    $stmt->execute(['id_fonction' => $id_fonction]);
    $questions = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($questions as &$question) {
        $question['choices'] = $this->getQuestionWithChoices($question['id_question'])['choices'];
        $question['id'] = $question['id_question'];
    }
    return $questions;
}

public function addQuestion($id_fonction, $intitule, $duree_max, $choix_texte, $choix_correct) {
    $stmt = $this->pdo->prepare("
        INSERT INTO question (intitule, id_fonction, duree_max)
        VALUES (:intitule, :id_fonction, :duree_max)
    ");
    $stmt->execute([
        'intitule' => $intitule,
        'id_fonction' => $id_fonction,
        'duree_max' => $duree_max
    ]);
    $id_question = $this->pdo->lastInsertId();

    $stmt = $this->pdo->prepare("
        INSERT INTO choix (id_question, texte, est_correct)
        VALUES (:id_question, :texte, :est_correct)
    ");
    foreach ($choix_texte as $index => $texte) {
        $stmt->execute([
            'id_question' => $id_question,
            'texte' => $texte,
            'est_correct' => isset($choix_correct[$index]) ? 1 : 0
        ]);
    }
    return $id_question;
}

public function updateQuestion($id_question, $intitule, $duree_max, $choix_id, $choix_texte, $choix_correct) {
    $stmt = $this->pdo->prepare("
        UPDATE question
        SET intitule = :intitule, duree_max = :duree_max
        WHERE id_question = :id_question
    ");
    $stmt->execute([
        'intitule' => $intitule,
        'duree_max' => $duree_max,
        'id_question' => $id_question
    ]);

    $stmt_delete = $this->pdo->prepare("DELETE FROM choix WHERE id_question = :id_question");
    $stmt_delete->execute(['id_question' => $id_question]);

    $stmt_insert = $this->pdo->prepare("
        INSERT INTO choix (id_question, texte, est_correct)
        VALUES (:id_question, :texte, :est_correct)
    ");
    foreach ($choix_texte as $index => $texte) {
        $stmt_insert->execute([
            'id_question' => $id_question,
            'texte' => $texte,
            'est_correct' => isset($choix_correct[$index]) ? 1 : 0
        ]);
    }
}

public function deleteQuestion($id_question) {
    $stmt = $this->pdo->prepare("DELETE FROM choix WHERE id_question = :id_question");
    $stmt->execute(['id_question' => $id_question]);

    $stmt = $this->pdo->prepare("DELETE FROM question WHERE id_question = :id_question");
    $stmt->execute(['id_question' => $id_question]);
}

public function getAllFonctions() {
    $stmt = $this->pdo->prepare("SELECT id_fonction, nom_fonction FROM fonction ORDER BY nom_fonction");
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function getAllCandidatsWithScoring($id_fonction) {
    $stmt = $this->pdo->prepare("
        SELECT c.id_candidat, c.nom, c.prenom, c.mail, 
               t.score AS test_score, 
               COALESCE(s.score_total, -1) AS score_total, 
               s.decision,
               (SELECT COUNT(*) FROM entretien e WHERE e.id_candidat = c.id_candidat AND e.id_fonction = :id_fonction) AS has_entretien
        FROM candidat c
        LEFT JOIN test t ON c.id_candidat = t.id_candidat AND t.id_fonction = :id_fonction
        LEFT JOIN scoring s ON c.id_candidat = s.id_candidat AND s.id_fonction = :id_fonction
        JOIN annonce a ON c.id_annonce = a.id_annonce
        WHERE a.id_fonction = :id_fonction
    ");
    $stmt->execute(['id_fonction' => $id_fonction]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function getCandidatsWithScoreByFonction($id_fonction) {
    $stmt = $this->pdo->prepare("
        SELECT c.id_candidat, c.nom, c.prenom, c.mail, 
               COALESCE(s.score_total, -1) AS score_total, 
               s.decision
        FROM candidat c
        JOIN scoring s ON c.id_candidat = s.id_candidat AND s.id_fonction = :id_fonction
        JOIN annonce a ON c.id_annonce = a.id_annonce
        WHERE a.id_fonction = :id_fonction
        ORDER BY c.nom, c.prenom
    ");
    $stmt->execute(['id_fonction' => $id_fonction]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
}
?>