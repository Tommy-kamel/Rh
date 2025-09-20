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

    public function listeEmployeSousContrat(){
        $listeEmployes = Flight::EmployeModel()->getAllEmployesSousContrat();
        Flight::render('rh/liste_employe_sous_contrat', ['employes' => $listeEmployes]);
    }

    public function listeEmployeSousContratEssai(){
        $listeEmployesEssai = Flight::EmployeModel()->getAllEmployesSousContratEssai();
        Flight::render('rh/liste_employe_sous_contrat_essai', ['employesEssai' => $listeEmployesEssai]);
    }
    

    // public function embaucherEmploye($id_contrat_essai) {
    //     $contrat = Flight::EmployeModel()->getContratEssaiById($id_contrat_essai);
    //     if ($contrat) {
    //         $salaire = $contrat['salaire'];
    //         $date_embauche = date('Y-m-d'); // Date actuelle
    //         $id_candidat_retenu = $contrat['id_candidat_retenu'];

    //         // Récupérer les informations du candidat
    //         $candidat = Flight::EmployeModel()->getCandidatByIdCandidatRetenu($id_candidat_retenu);
    //         $nom = $candidat['nom'];
    //         $prenom = $candidat['prenom'];
    //         $mail = $candidat['mail'];
    //         $tel = $candidat['telephone'];
    //         $date_naissance = $candidat['date_de_naissance'];
    //         $adresse = $candidat['adresse'];
    //         $sexe = $candidat['sexe'];

    //         // Créer l'employé et récupérer son ID
    //         $id_employe = Flight::EmployeModel()->createEmploye(
    //             $nom,
    //             $prenom,
    //             $sexe,
    //             $mail,
    //             $tel,
    //             $date_naissance,
    //             $adresse
    //         );

    //         if ($id_employe) {
    //             error_log("Employé créé avec succès: ID $id_employe, $nom $prenom");

    //             // Créer le contrat permanent
    //             $id_contrat = Flight::EmployeModel()->createContrat($id_employe, $salaire, $date_embauche);
    //             if ($id_contrat) {
    //                 error_log("Contrat créé avec succès: ID $id_contrat pour employé ID $id_employe");

    //                 // Terminer le contrat d'essai
    //                 Flight::EmployeModel()->terminerContratEssai($id_contrat_essai, $date_embauche);

    //                 // Récupérer la liste mise à jour des employés en essai
    //                 $listeEmployesEssai = Flight::EmployeModel()->getAllEmployesSousContratEssai();

    //                 // Message de succès avec lien
    //                 $message = "L'employé $prenom $nom a été embauché avec succès. <a href='/rh/contrat/export-pdf?id_contrat=$id_contrat' class='alert-link'>Générer le contrat</a>";
    //                 $message_type = 'success';

    //                 // Rendre la page avec le message et la liste
    //                 Flight::render('rh/liste_employe_sous_contrat_essai', [
    //                     'employesEssai' => $listeEmployesEssai,
    //                     'message' => $message,
    //                     'message_type' => $message_type
    //                 ]);
    //             } else {
    //                 error_log("Erreur lors de la création du contrat pour l'employé ID: $id_employe, salaire: $salaire, date: $date_embauche");
    //                 $message = "Erreur lors de la création du contrat.";
    //                 $message_type = 'error';
    //                 Flight::render('rh/confirmation_embauche', [
    //                     'message' => $message,
    //                     'message_type' => $message_type
    //                 ]);
    //             }
    //         } else {
    //             error_log("Erreur lors de la création de l'employé: $nom $prenom, email: $mail, sexe: $sexe, tel: $tel, naissance: $date_naissance, adresse: $adresse");
    //             $message = "Erreur lors de la création de l'employé.";
    //             $message_type = 'error';
    //             Flight::render('rh/confirmation_embauche', [
    //                 'message' => $message,
    //                 'message_type' => $message_type
    //             ]);
    //         }
    //     } else {
    //         error_log("Contrat d'essai introuvable pour ID: $id_contrat_essai");
    //         $message = "Contrat d'essai introuvable.";
    //         $message_type = 'error';
    //         Flight::render('rh/confirmation_embauche', [
    //             'message' => $message,
    //             'message_type' => $message_type
    //         ]);
    //     }
    // }

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

    // public function exportContratPdf($id_contrat) {
    //     // Fetch contrat data from model
    //     $contrat = Flight::EmployeModel()->getContratById($id_contrat);
    //     if (!$contrat) {
    //         Flight::halt(404, 'Contrat introuvable');
    //         return;
    //     }
    
    //     // Fetch employee data
    //     $employe = Flight::EmployeModel()->getEmployeById($contrat['id_employe']);
    //     if (!$employe) {
    //         Flight::halt(404, 'Employé introuvable');
    //         return;
    //     }
    
    //     // Load Markdown template
    //     $markdownTemplate = file_get_contents(__DIR__ . '/../../Avenant_Contrat_Essai_Vers_CDI_Madagascar.markdown');
    
    //     // Replace placeholders with actual data
    //     $replacements = [
    //         /* 'SARL TANA SERVICES' => htmlspecialchars($contrat['nom_entreprise'] ?? 'Nom Entreprise'),
    //         'Lot II M 45, Antananarivo 101, Madagascar' => htmlspecialchars($contrat['adresse_entreprise'] ?? 'Adresse Entreprise'),
    //         '1234567890 / STAT : 82901 11 2020 0 12345' => htmlspecialchars($contrat['nif'] ?? '') . ' / STAT : ' . htmlspecialchars($contrat['stat'] ?? ''),
    //         'Mme RAKOTONIRINA Sophie' => htmlspecialchars($contrat['directeur_general'] ?? 'Directeur Général'), */
    //         'M. ANDRIANJAFY Jean Paul' => htmlspecialchars($employe['nom'] ?? '') . ' ' . htmlspecialchars($employe['prenom'] ?? ''),
    //         'Lot VB 12, Ambohipo, Antananarivo 101, Madagascar' => htmlspecialchars($employe['adresse'] ?? 'Adresse Salarié'),
    //         /* '101 123 456 789' => htmlspecialchars($employe['cin'] ?? 'CIN'), // Assuming CIN is in employe table */
    //         /* '15 mars 2010' => htmlspecialchars($employe['date_delivrance_cin'] ?? 'Date Délivrance'), // Assuming date_delivrance_cin */
    //         '10 janvier 1995' => htmlspecialchars($employe['date_naissance'] ?? 'Date Naissance'),
    //         '1er octobre 2025' => htmlspecialchars($contrat['date_debut_essai'] ?? 'Date Début Essai'),
    //         '2 mois' => htmlspecialchars($contrat['duree_essai'] ?? 'Durée Essai'),
    //         '1er octobre 2025' => htmlspecialchars($contrat['date_debut_essai'] ?? 'Date Début Essai'),
    //         '30 novembre 2025' => htmlspecialchars($contrat['date_fin_essai'] ?? 'Date Fin Essai'),
    //         '31 octobre 2025' => htmlspecialchars($contrat['date_embauche'] ?? 'Date Embauche'),
    //         '1er novembre 2025' => htmlspecialchars($contrat['date_embauche'] ?? 'Date Embauche'),
    //         'Comptable Junior' => htmlspecialchars($contrat['poste'] ?? 'Poste'),
    //         'Service Comptabilité' => htmlspecialchars($contrat['service'] ?? 'Service'),
    //         '800 000 Ariary' => htmlspecialchars($contrat['salaire'] ?? 'Salaire') . ' Ar',
    //         '50 000 Ariary' => htmlspecialchars($contrat['prime_transport'] ?? 'Prime Transport') . ' Ar',
    //         '000123456789' => htmlspecialchars($employe['numero_compte'] ?? 'Numéro Compte'),
    //         '8h00 à 12h00' => htmlspecialchars($contrat['heure_debut_matin'] ?? 'Heure Début Matin'),
    //         '13h00 à 17h00' => htmlspecialchars($contrat['heure_debut_apres_midi'] ?? 'Heure Début Après-Midi'),
    //         'Lot II M 45, Antananarivo 101' => htmlspecialchars($contrat['lieu_travail'] ?? 'Lieu Travail'),
    //         '31 octobre 2025' => htmlspecialchars($contrat['date_signature'] ?? date('d/m/Y')),
    //     ];
    
    //     $htmlContent = str_replace(array_keys($replacements), array_values($replacements), $markdownTemplate);
    
    //     // Convert Markdown to HTML (simple replacement for headers and bold)
    //     $htmlContent = preg_replace('/^# (.+)$/m', '<h1>$1</h1>', $htmlContent);
    //     $htmlContent = preg_replace('/^\*\*(.+)\*\*$/m', '<strong>$1</strong>', $htmlContent);
    //     $htmlContent = preg_replace('/^### (.+)$/m', '<h3>$3</h3>', $htmlContent);
    //     $htmlContent = nl2br($htmlContent);
    
    //     // Wrap in basic HTML structure
    //     $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Avenant Contrat</title></head><body>' . $htmlContent . '</body></html>';
    
    //     // Generate PDF using Dompdf
    //     require_once __DIR__ . '/../../public/assets/lib/dompdf/autoload.inc.php';
    //     $options = new \Dompdf\Options();
    //     $options->set('defaultFont', 'Arial');
    //     $options->set('isRemoteEnabled', true);
    //     $dompdf = new \Dompdf\Dompdf($options);
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();
    //     $filename = 'avenant_contrat_' . $id_contrat . '_' . date('Y-m-d_H-i-s') . '.pdf';
    //     $dompdf->stream($filename, ['Attachment' => 1, 'compress' => 1]);
    // }   

    // public function exportContratPdf($id_contrat) {
    //     // Fetch contrat data from model
    //     $contrat = Flight::EmployeModel()->getContratById($id_contrat);
    //     if (!$contrat) {
    //         Flight::halt(404, 'Contrat introuvable');
    //         return;
    //     }
    
    //     // Fetch employee data
    //     $employe = Flight::EmployeModel()->getEmployeById($contrat['id_employe']);
    //     if (!$employe) {
    //         Flight::halt(404, 'Employé introuvable');
    //         return;
    //     }
    
    //     // Load Markdown template
    //     $markdownTemplate = file_get_contents(__DIR__ . '/../../Avenant_Contrat_Essai_Vers_CDI_Madagascar.markdown');
    
    //     // Replace placeholders with actual data
    //     $replacements = [
    //         'M. ANDRIANJAFY Jean Paul' => htmlspecialchars($employe['nom'] ?? '') . ' ' . htmlspecialchars($employe['prenom'] ?? ''),
    //         'Lot VB 12, Ambohipo, Antananarivo 101, Madagascar' => htmlspecialchars($employe['adresse'] ?? 'Adresse Salarié'),
    //         '10 janvier 1995' => htmlspecialchars($employe['date_naissance'] ?? 'Date Naissance'),
    //         '1er octobre 2025' => htmlspecialchars($contrat['date_debut'] ?? 'Date Début'),
    //         '31 octobre 2025' => htmlspecialchars($contrat['date_debut'] ?? 'Date Embauche'),
    //         '1er novembre 2025' => htmlspecialchars($contrat['date_debut'] ?? 'Date Embauche'),
    //         '800 000 Ariary' => htmlspecialchars($contrat['salaire'] ?? 'Salaire') . ' Ar',
    //         '31 octobre 2025' => date('d/m/Y'),
    //     ];
    
    //     $htmlContent = str_replace(array_keys($replacements), array_values($replacements), $markdownTemplate);
    
    //     // Convert Markdown to HTML (remove * for bold, convert headers)
    //     $htmlContent = preg_replace('/\*\*(.+?)\*\*/', '$1', $htmlContent); // Remove ** and keep text plain
    //     $htmlContent = preg_replace('/^# (.+)$/m', '<h1>$1</h1>', $htmlContent);
    //     $htmlContent = preg_replace('/^### (.+)$/m', '<h3>$1</h3>', $htmlContent);
    //     $htmlContent = nl2br($htmlContent);
    
    //     // Wrap in basic HTML structure
    //     $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Avenant Contrat</title></head><body>' . $htmlContent . '</body></html>';
    
    //     // Generate PDF using Dompdf
    //     require_once __DIR__ . '/../../public/assets/lib/dompdf/autoload.inc.php';
    //     $options = new \Dompdf\Options();
    //     $options->set('defaultFont', 'Arial');
    //     $options->set('isRemoteEnabled', true);
    //     $dompdf = new \Dompdf\Dompdf($options);
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();
    //     $filename = 'avenant_contrat_' . $id_contrat . '_' . date('Y-m-d_H-i-s') . '.pdf';
    //     $dompdf->stream($filename, ['Attachment' => 1, 'compress' => 1]);
    // }      

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