<?php

namespace app\controllers;
use Flight;
class EmployeController{

    public function __construct()
    {

    }

    public function showMenu() {
        Flight::render('rh/menu_employe');
    }

    // public function listeEmployeSousContrat(){
    //     $listeEmployes = Flight::EmployeModel()->getAllEmployesSousContrat();
    //     Flight::render('rh/liste_employe_sous_contrat', ['employes' => $listeEmployes]);
    // }

    public function listeEmployeSousContrat() {
        $filters = [
            'nom' => $_GET['nom'] ?? '',
            'prenom' => $_GET['prenom'] ?? '',
            'date_debut_debut' => $_GET['date_debut_debut'] ?? '',
            'date_debut_fin' => $_GET['date_debut_fin'] ?? '',
            'salaire_min' => $_GET['salaire_min'] ?? '',
            'salaire_max' => $_GET['salaire_max'] ?? '',
        ];

        $listeEmployes = Flight::EmployeModel()->getAllEmployesSousContratFiltered($filters);
        Flight::render('rh/liste_employe_sous_contrat', ['employes' => $listeEmployes, 'filters' => $filters]);
    }

    // public function listeEmployeSousContratEssai(){
    //     $listeEmployesEssai = Flight::EmployeModel()->getAllEmployesSousContratEssai();
    //     Flight::render('rh/liste_employe_sous_contrat_essai', ['employesEssai' => $listeEmployesEssai]);
    // }

    public function listeEmployeSousContratEssai() {
        $filters = [
            'nom' => $_GET['nom'] ?? '',
            'prenom' => $_GET['prenom'] ?? '',
            'date_debut_debut' => $_GET['date_debut_debut'] ?? '',
            'date_debut_fin' => $_GET['date_debut_fin'] ?? '',
            'date_fin_debut' => $_GET['date_fin_debut'] ?? '',
            'date_fin_fin' => $_GET['date_fin_fin'] ?? '',
            'salaire_min' => $_GET['salaire_min'] ?? '',
            'salaire_max' => $_GET['salaire_max'] ?? '',
        ];

        $listeEmployesEssai = Flight::EmployeModel()->getAllEmployesSousContratEssaiFiltered($filters);
        Flight::render('rh/liste_employe_sous_contrat_essai', ['employesEssai' => $listeEmployesEssai, 'filters' => $filters]);
    }
    

    public function embaucherEmploye($id_contrat_essai) {
        $contrat = Flight::EmployeModel()->getContratEssaiById($id_contrat_essai);
        if ($contrat) {
            $salaire = $contrat['salaire'];
            $date_embauche = date('Y-m-d'); // Date actuelle
            $id_candidat_retenu = $contrat['id_candidat_retenu'];

            // Récupérer les informations du candidat
            $candidat = Flight::EmployeModel()->getCandidatByIdCandidatRetenu($id_candidat_retenu);
            $nom = $candidat['nom'];
            $prenom = $candidat['prenom'];
            $mail = $candidat['mail'];
            $tel = $candidat['telephone'];
            $date_naissance = $candidat['date_de_naissance'];
            $adresse = $candidat['adresse'];
            $sexe = $candidat['sexe'];

            // Créer l'employé et récupérer son ID
            $id_employe = Flight::EmployeModel()->createEmploye(
                $nom,
                $prenom,
                $sexe,
                $mail,
                $tel,
                $date_naissance,
                $adresse
            );

            if ($id_employe) {
                error_log("Employé créé avec succès: ID $id_employe, $nom $prenom");

                // Créer le contrat permanent
                $id_contrat = Flight::EmployeModel()->createContrat($id_employe, $salaire, $date_embauche);
                if ($id_contrat) {
                    error_log("Contrat créé avec succès: ID $id_contrat pour employé ID $id_employe");

                    // Terminer le contrat d'essai
                    Flight::EmployeModel()->terminerContratEssai($id_contrat_essai, $date_embauche);

                    // Rediriger vers la page du contrat
                    Flight::redirect('/rh/contrat/' . $id_contrat);
                } else {
                    error_log("Erreur lors de la création du contrat pour l'employé ID: $id_employe, salaire: $salaire, date: $date_embauche");
                    $message = "Erreur lors de la création du contrat.";
                    $message_type = 'error';
                    Flight::render('rh/confirmation_embauche', [
                        'message' => $message,
                        'message_type' => $message_type
                    ]);
                }
            } else {
                error_log("Erreur lors de la création de l'employé: $nom $prenom, email: $mail, sexe: $sexe, tel: $tel, naissance: $date_naissance, adresse: $adresse");
                $message = "Erreur lors de la création de l'employé.";
                $message_type = 'error';
                Flight::render('rh/confirmation_embauche', [
                    'message' => $message,
                    'message_type' => $message_type
                ]);
            }
        } else {
            error_log("Contrat d'essai introuvable pour ID: $id_contrat_essai");
            $message = "Contrat d'essai introuvable.";
            $message_type = 'error';
            Flight::render('rh/confirmation_embauche', [
                'message' => $message,
                'message_type' => $message_type
            ]);
        }
    }

    public function showContrat($id_contrat) {
    $contrat = Flight::EmployeModel()->getContratById($id_contrat);
        if (!$contrat) {
            Flight::halt(404, 'Contrat introuvable');
            return;
        }
        $employe = Flight::EmployeModel()->getEmployeById($contrat['id_employe']);
        if (!$employe) {
            Flight::halt(404, 'Employé introuvable');
            return;
        }
        Flight::render('rh/Contrat', ['contrat' => $contrat, 'employe' => $employe]);
    } 

    public function exportContratPdf($id_contrat) {
        // Fetch contrat data from model
        $contrat = Flight::EmployeModel()->getContratById($id_contrat);
        if (!$contrat) {
            Flight::halt(404, 'Contrat introuvable');
            return;
        }

        // Fetch employee data
        $employe = Flight::EmployeModel()->getEmployeById($contrat['id_employe']);
        if (!$employe) {
            Flight::halt(404, 'Employé introuvable');
            return;
        }

        // Load Markdown template
        $markdownTemplate = file_get_contents(__DIR__ . '/../../Avenant_Contrat_Essai_Vers_CDI_Madagascar.markdown');

        // Remove unwanted sections
        $markdownTemplate = str_replace('[Signature et cachet de SARL TANA SERVICES]', '', $markdownTemplate);
        $markdownTemplate = str_replace('[Signature]', '', $markdownTemplate);
        $markdownTemplate = preg_replace('/Notes :.*$/s', '', $markdownTemplate); // Remove the entire Notes section

        // Replace placeholders with actual data
        $replacements = [
            'M. ANDRIANJAFY Jean Paul' => htmlspecialchars($employe['nom'] ?? '') . ' ' . htmlspecialchars($employe['prenom'] ?? ''),
            'Lot VB 12, Ambohipo, Antananarivo 101, Madagascar' => htmlspecialchars($employe['adresse'] ?? 'Adresse Salarié'),
            '10 janvier 1995' => htmlspecialchars($employe['date_naissance'] ?? 'Date Naissance'),
            '1er octobre 2025' => htmlspecialchars($contrat['date_debut'] ?? 'Date Début'),
            '31 octobre 2025' => htmlspecialchars($contrat['date_debut'] ?? 'Date Embauche'),
            '1er novembre 2025' => htmlspecialchars($contrat['date_debut'] ?? 'Date Embauche'),
            '800 000 Ariary' => htmlspecialchars($contrat['salaire'] ?? 'Salaire') . ' Ar',
            '31 octobre 2025' => date('d/m/Y'),
        ];

        $htmlContent = str_replace(array_keys($replacements), array_values($replacements), $markdownTemplate);

        // Convert Markdown to HTML (remove * for bold, convert headers)
        $htmlContent = preg_replace('/\*\*(.+?)\*\*/', '$1', $htmlContent); // Remove ** and keep text plain
        $htmlContent = preg_replace('/^# (.+)$/m', '<h1>$1</h1>', $htmlContent);
        $htmlContent = preg_replace('/^### (.+)$/m', '<h3>$1</h3>', $htmlContent);
        $htmlContent = nl2br($htmlContent);

        // Wrap in basic HTML structure with Arial font
        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Avenant Contrat</title><style>body { font-family: Arial, sans-serif; }</style></head><body>' . $htmlContent . '</body></html>';

        // Generate PDF using Dompdf
        require_once __DIR__ . '/../../public/assets/lib/dompdf/autoload.inc.php';
        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $filename = 'avenant_contrat_' . $id_contrat . '_' . date('Y-m-d_H-i-s') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => 1, 'compress' => 1]);
    }
}