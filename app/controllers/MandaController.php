<?php
// manda_controller.php
namespace app\controllers;
use app\models\MandaModel;

use Flight;
use Exception;

class MandaController {
    private $model;
    public $nb_questions = 5; // Variable modifiable
    public $pourcentage_test = 60 / 100; // 60% pour le test
    public $pourcentage_entretien = 40 / 100; // 40% pour l'entretien

    public function __construct($pdo) {
        $this->model = new MandaModel($pdo);
        $variables = $this->model->getVariable();
        $this->nb_questions = $variables['nb_question'];
        $this->pourcentage_test = $variables['pourcentage_test'] / 100;
        $this->pourcentage_entretien = $variables['pourcentage_entretien'] / 100;
    }

    public function hasCandidateTakenTest($id_candidat, $id_fonction) {
        $stmt = $this->model->pdo->prepare("
            SELECT COUNT(*) FROM test 
            WHERE id_candidat = :id_candidat 
            AND id_fonction = :id_fonction
        ");
        $stmt->execute([
            'id_candidat' => $id_candidat,
            'id_fonction' => $id_fonction
        ]);
        return $stmt->fetchColumn() > 0;
    }

    public function hasCandidateTakenEntretien($id_candidat, $id_fonction) {
        $stmt = $this->model->pdo->prepare("
            SELECT COUNT(*) FROM entretien 
            WHERE id_candidat = :id_candidat 
            AND id_fonction = :id_fonction
        ");
        $stmt->execute([
            'id_candidat' => $id_candidat,
            'id_fonction' => $id_fonction
        ]);
        return $stmt->fetchColumn() > 0;
    }

    public function startTest($id_fonction) {
        // $_SESSION['id_candidat'] = 1; // À remplacer par une vraie gestion d'authentification
        if (!isset($_SESSION['id_candidat'])) {
            Flight::render('manda_message.php', [
                'error_message' => 'Aucun candidat sélectionné.'
            ]);
            return;
        }

        $stmt = $this->model->pdo->prepare("
            SELECT COUNT(*) FROM candidat WHERE id_candidat = :id_candidat
        ");
        $stmt->execute(['id_candidat' => $_SESSION['id_candidat']]);
        if ($stmt->fetchColumn() == 0) {
            Flight::render('manda_message.php', [
                'error_message' => 'Ce candidat n\'existe pas.'
            ]);
            return;
        }
        $id_candidat = $_SESSION['id_candidat'];

        if ($this->hasCandidateTakenTest($id_candidat, $id_fonction)) {
            Flight::render('manda_message.php', [
                'error_message' => 'Vous avez déjà passé un test pour cette fonction.',
                'lien' => '/entertien/'.$id_candidat,
                'libele_lien' => 'faire l entretien'
            ]);
            return;
        }

        $_SESSION['test_questions'] = $this->model->getRandomQuestions($id_fonction, 3, 2);
        $_SESSION['current_q_index'] = 0;
        $_SESSION['responses'] = [];
        $_SESSION['start_time'] = time();
        $_SESSION['questions_data'] = [];

        $current_index = $_SESSION['current_q_index'];
        $question_id = $_SESSION['test_questions'][$current_index];
        try{
            $question = $this->model->getQuestionWithChoices($question_id); 
        }catch(Exception $e){
            Flight::render('manda_message.php', [
                'error_message' => 'les reponses aux questions sont actuellement mis en place, reessayer plus tard'
            ]);
            return;
        }

        $_SESSION['questions_data'][$current_index] = $question;

        Flight::render('manda_view.php', [
            'question' => $question,
            'current_index' => $current_index,
            'total_questions' => $this->nb_questions,
            'action' => '/test/' . $id_fonction,
            'pourcentage_test' => $this->pourcentage_test
        ]);
    }

    public function handleResponse($id_fonction) {
        if (!isset($_SESSION['id_candidat']) || !isset($_POST['id_choix']) || !isset($_POST['id_question']) || !isset($_SESSION['current_q_index'])) {
            Flight::redirect('/annonces');
            return;
        }

        $id_candidat = $_SESSION['id_candidat'];
        $current_index = $_SESSION['current_q_index'];
        $selected_choix = (int)$_POST['id_choix'];
        $question_id = (int)$_POST['id_question'];
        $timeout = $_POST['timeout'] === 'true';

        if ($timeout) {
            $question_data = $_SESSION['questions_data'][$current_index] ?? null;
            if (!$question_data) {
                Flight::redirect('/annonces');
                return;
            }
            $wrong_choices = array_filter($question_data['choices'], fn($c) => !$c['est_correct']);
            if (!empty($wrong_choices)) {
                $selected_choix = reset($wrong_choices)['id'];
            } else {
                $selected_choix = $question_data['choices'][0]['id'];
            }
        }

        $_SESSION['responses'][$question_id] = $selected_choix;
        $_SESSION['current_q_index']++;

        if ($_SESSION['current_q_index'] >= $this->nb_questions) {
            $score = 0;
            foreach ($_SESSION['responses'] as $q_id => $c_id) {
                if ($this->model->isChoiceCorrect($c_id)) {
                    $score += 20 / $this->nb_questions;
                }
            }

            $id_test = $this->model->createTest($id_candidat, $score, $id_fonction);
            $this->model->saveResponses($id_test, $_SESSION['responses']);

            unset($_SESSION['test_questions'], $_SESSION['current_q_index'], $_SESSION['responses'], $_SESSION['questions_data']);

            Flight::redirect('/resultatqcm/' . $id_candidat);
        } else {
            $next_index = $_SESSION['current_q_index'];
            if (!isset($_SESSION['test_questions'][$next_index])) {
                Flight::render('manda_message.php', [
                'error_message' => 'pas assez de question pour le moment, veullez ressayer plus.'
            ]);
            return;
            }
            $next_question_id = $_SESSION['test_questions'][$next_index];
            $next_question = $this->model->getQuestionWithChoices($next_question_id);
            $_SESSION['questions_data'][$next_index] = $next_question;

            Flight::render('manda_view.php', [
                'question' => $next_question,
                'current_index' => $next_index,
                'total_questions' => $this->nb_questions,
                'action' => '/test/' . $id_fonction,
            'pourcentage_test' => $this->pourcentage_test
            ]);
        }
    }

    public function showResult($id_candidat) {
        if (!isset($_SESSION['id_candidat']) || $_SESSION['id_candidat'] != $id_candidat) {
            Flight::redirect('/login');
            return;
        }

        $score = $this->model->getTestScore($id_candidat);

        Flight::render('manda_result_view.php', ['score' => $score]);
    }

    public function planEntretien($id_candidat) {
        // $_SESSION['id_fonction'] = 1; // À remplacer par une vraie gestion
        if (!isset($_SESSION['id_fonction'])) {
            Flight::render('manda_message.php', [
                'error_message' => 'Aucune fonction sélectionnée. Veuillez sélectionner une fonction.'
            ]);
            return;
        }
        $id_fonction = (int)$_SESSION['id_fonction'];

        $stmt = $this->model->pdo->prepare("
            SELECT COUNT(*) FROM candidat WHERE id_candidat = :id_candidat
        ");
        $stmt->execute(['id_candidat' => $id_candidat]);
        if ($stmt->fetchColumn() == 0) {
            Flight::render('manda_message.php', [
                'error_message' => 'Ce candidat n\'existe pas.'
            ]);
            return;
        }

        if (!$this->hasCandidateTakenTest($id_candidat, $id_fonction)) {
            $_SESSION['id_candidat'] = $id_candidat;
            Flight::render('manda_message.php', [
                'error_message' => 'Ce candidat n\'a pas encore passé de test pour cette fonction.'. $_SESSION['id_fonction'],
                'lien' => '/test/'.$id_candidat,
                'libele_lien' => 'faire le test'
            ]);
            return;
        }

        if ($this->hasCandidateTakenEntretien($id_candidat, $id_fonction)) {
            Flight::render('manda_message.php', [
                'error_message' => 'Ce candidat a déjà fait un entretien pour cette fonction.'
            ]);
            return;
        }

        $stmt = $this->model->pdo->prepare("
            SELECT score 
            FROM test 
            WHERE id_candidat = :id_candidat 
            AND id_fonction = :id_fonction
            ORDER BY date_test DESC 
            LIMIT 1
        ");
        $stmt->execute([
            'id_candidat' => $id_candidat,
            'id_fonction' => $id_fonction
        ]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result || $result['score'] < 10) {
            Flight::render('manda_message.php', [
                'error_message' => 'Ce candidat n\'a pas obtenu la moyenne (' . ($result['score'] ?? 'aucun') . '/20) au test.'
            ]);
            return;
        }

        Flight::render('entretien_view.php', [
            'id_candidat' => $id_candidat,
            'id_fonction' => $id_fonction,
            'pourcentage_entretien' => $this->pourcentage_entretien
        ]);
    }

    public function saveEntretien() {
        if (!isset($_POST['id_candidat']) || !isset($_POST['id_fonction']) || !isset($_POST['date_entretien']) || !isset($_POST['note'])) {
            Flight::render('manda_message.php', [
                'error_message' => 'Données manquantes pour enregistrer l\'entretien.'
            ]);
            return;
        }

        $id_candidat = (int)$_POST['id_candidat'];
        $id_fonction = (int)$_POST['id_fonction'];
        $date_entretien = $_POST['date_entretien'];
        $note = (float)$_POST['note'];
        $commentaire = $_POST['commentaire'] ?? '';

        // Valider la date
        if (!strtotime($date_entretien)) {
            Flight::render('manda_message.php', [
                'error_message' => 'Date d\'entretien invalide.'
            ]);
            return;
        }

        // Valider la note
        if ($note < 0 || $note > 20) {
            Flight::render('manda_message.php', [
                'error_message' => 'La note doit être comprise entre 0 et 20.'
            ]);
            return;
        }

        try {
            // Récupérer le score du test
            $score_test = $this->model->getLastTestScore($id_candidat, $id_fonction);
            if ($score_test === null) {
                Flight::render('manda_message.php', [
                    'error_message' => 'Aucun score de test trouvé pour ce candidat.'
                ]);
                return;
            }

            // Calculer le score total
            $score_total = ($score_test * $this->pourcentage_test) + ($note * $this->pourcentage_entretien);

            // Enregistrer l'entretien
            $this->model->saveEntretien($id_candidat, $id_fonction, $date_entretien, $note, $commentaire);

            // Enregistrer le score total
            $this->model->saveScore($id_candidat, $id_fonction, $score_total);

            Flight::render('manda_message.php', [
                'succes_message' => 'Entretien et score enregistrés avec succès.'
            ]);
        } catch (Exception $e) {
            Flight::render('manda_message.php', [
                'error_message' => 'Erreur lors de l\'enregistrement : ' . $e->getMessage()
            ]);
        }
    }

    public function afficherModifierPourcentages() {
    $variables = $this->model->getVariable();
    Flight::render('modifier_pourcentages.php', [
        'variables' => $variables
    ]);
}

public function enregistrerPourcentages() {
    if (!isset($_POST['pourcentage_test']) || !isset($_POST['pourcentage_entretien'])) {
        Flight::render('manda_message.php', [
            'error_message' => 'Données manquantes pour modifier les pourcentages.'
        ]);
        return;
    }

    $pourcentage_test = (float)$_POST['pourcentage_test'];
    $pourcentage_entretien = (float)$_POST['pourcentage_entretien'];

    if ($pourcentage_test < 0 || $pourcentage_test > 100 || $pourcentage_entretien < 0 || $pourcentage_entretien > 100) {
        Flight::render('manda_message.php', [
            'error_message' => 'Les pourcentages doivent être compris entre 0 et 100.'
        ]);
        return;
    }

    if ($pourcentage_test + $pourcentage_entretien != 100) {
        Flight::render('manda_message.php', [
            'error_message' => 'La somme des pourcentages doit être égale à 100.'
        ]);
        return;
    }

    try {
        $this->model->updatePourcentages($pourcentage_test, $pourcentage_entretien);
        Flight::render('manda_message.php', [
            'succes_message' => 'Pourcentages enregistrés avec succès.'
        ]);
    } catch (Exception $e) {
        Flight::render('manda_message.php', [
            'error_message' => 'Erreur lors de l\'enregistrement : ' . $e->getMessage()
        ]);
    }
}

public function afficherQuestions() {
    // $_SESSION['id_fonction'] = 1;
    if (!isset($_SESSION['id_fonction'])) {
        Flight::render('manda_message.php', [
            'error_message' => 'Aucune fonction sélectionnée.'
        ]);
        return;
    }
    $id_fonction = (int)$_SESSION['id_fonction'];
    $questions = $this->model->getQuestionsByFonction($id_fonction);
    Flight::render('question_test.php', [
        'id_fonction' => $id_fonction,
        'questions' => $questions,
            'pourcentage_test' => $this->pourcentage_test,
            'pourcentage_entretien' => $this->pourcentage_entretien
    ]);
}

public function ajouterQuestion() {
    if (!isset($_SESSION['id_fonction']) || !isset($_POST['id_fonction']) || !isset($_POST['intitule']) || !isset($_POST['duree_max']) || !isset($_POST['choix_texte'])) {
        Flight::render('manda_message.php', [
            'error_message' => 'Données manquantes pour ajouter une question.'
        ]);
        return;
    }

    $id_fonction = (int)$_POST['id_fonction'];
    $intitule = $_POST['intitule'];
    $duree_max = (int)$_POST['duree_max'];
    $choix_texte = array_filter($_POST['choix_texte'], fn($texte) => !empty(trim($texte)));
    $choix_correct = $_POST['choix_correct'] ?? [];

    if (count($choix_texte) < 2) {
        Flight::render('manda_message.php', [
            'error_message' => 'Au moins deux choix sont requis.'
        ]);
        return;
    }

    try {
        $this->model->addQuestion($id_fonction, $intitule, $duree_max, $choix_texte, $choix_correct);
        Flight::render('manda_message.php', [
            'succes_message' => 'Question ajoutée avec succès.'
        ]);
    } catch (Exception $e) {
        Flight::render('manda_message.php', [
            'error_message' => 'Erreur lors de l\'ajout : ' . $e->getMessage()
        ]);
    }
}

public function modifierQuestion($id_question) {
    if (!isset($_SESSION['id_fonction']) || !isset($_POST['id_fonction']) || !isset($_POST['intitule']) || !isset($_POST['duree_max']) || !isset($_POST['choix_texte'])) {
        Flight::render('manda_message.php', [
            'error_message' => 'Données manquantes pour modifier la question.'
        ]);
        return;
    }

    $id_fonction = (int)$_POST['id_fonction'];
    $intitule = $_POST['intitule'];
    $duree_max = (int)$_POST['duree_max'];
    $choix_texte = array_filter($_POST['choix_texte'], fn($texte) => !empty(trim($texte)));
    $choix_correct = $_POST['choix_correct'] ?? [];
    $choix_id = $_POST['choix_id'] ?? [];

    if (count($choix_texte) < 2) {
        Flight::render('manda_message.php', [
            'error_message' => 'Au moins deux choix sont requis.'
        ]);
        return;
    }

    try {
        $this->model->updateQuestion($id_question, $intitule, $duree_max, $choix_id, $choix_texte, $choix_correct);
        Flight::render('manda_message.php', [
            'succes_message' => 'Question modifiée avec succès.'
        ]);
    } catch (Exception $e) {
        Flight::render('manda_message.php', [
            'error_message' => 'Erreur lors de la modification : ' . $e->getMessage()
        ]);
    }
}

public function supprimerQuestion($id_question) {
    try {
        $this->model->deleteQuestion($id_question);
        Flight::render('manda_message.php', [
            'succes_message' => 'Question supprimée avec succès.'
        ]);
    } catch (Exception $e) {
        Flight::render('manda_message.php', [
            'error_message' => 'Erreur lors de la suppression : ' . $e->getMessage()
        ]);
    }
}

public function afficherListeFonctions() {
    $fonctions = $this->model->getAllFonctions();
    Flight::render('liste_fonctions.php', [
        'fonctions' => $fonctions
    ]);
}

public function setFonction() {
    if (!isset($_POST['id_fonction'])) {
        Flight::json(['success' => false, 'error' => 'ID de fonction manquant']);
        return;
    }
    $_SESSION['id_fonction'] = (int)$_POST['id_fonction'];
    Flight::json(['success' => true]);
}

public function afficherListeCandidats() {
    if (!isset($_SESSION['id_fonction'])) {
        Flight::render('manda_message.php', [
            'error_message' => 'Aucune fonction sélectionnée.'
        ]);
        return;
    }
    $id_fonction = (int)$_SESSION['id_fonction'];
    $candidats = $this->model->getAllCandidatsWithScoring($id_fonction);
    $fonctions = $this->model->getAllFonctions();
    Flight::render('liste_candidat.php', [
        'candidats' => $candidats,
        'fonctions' => $fonctions
    ]);
}

public function afficherCandidatsWithScore() {
    if (!isset($_SESSION['id_fonction'])) {
        Flight::render('manda_message.php', [
            'error_message' => 'Aucune fonction sélectionnée.'
        ]);
        return;
    }
    $id_fonction = (int)$_SESSION['id_fonction'];
    $candidats = $this->model->getCandidatsWithScoreByFonction($id_fonction);
    Flight::render('liste_candidats_scoring.php', [
        'candidats' => $candidats,
        'id_fonction' => $id_fonction
    ]);
}

}
?>