<?php

namespace app\controllers;
use app\models\AnnonceModel;
use Flight;
class ContratEssaiController{

    public function __construct()
    {

    }
    
    public function showForm() {
        Flight::render('FormContratEssai');
    }

    public function submitForm() {
        $nom_entreprise = Flight::request()->data['nom_entreprise'] ?? null;
        $adresse_entreprise = Flight::request()->data['adresse_entreprise'] ?? null;
        $nif = Flight::request()->data['nif'] ?? null;
        $stat = Flight::request()->data['stat'] ?? null;
        $directeur_general = Flight::request()->data['directeur_general'] ?? null;
        $nom_salarie = "Rakoto"; // nom salarie
        $adresse_salarie = "Antananarivo"; // adresse salarie
        $poste = "Développeur"; // poste
        $fonction = "Informatique"; // fonction

        $duree = Flight::request()->data['duree_contrat'] ?? null;
        $debut = date('Y-m-d'); // Utilise la date d'aujourd'hui au format YYYY-MM-DD
        $fin = date('Y-m-d', strtotime($debut . ' + ' . $duree . ' months'));
        // type contrat
        $salaire = Flight::request()->data['salaire'] ?? null;
        $heure_travail = Flight::request()->data['heures_travail'] ?? null;
        $id_employe = Flight::request()->data['id_employe'] ?? null;
        $date_debut = Flight::request()->data['date_debut'] ?? null;
        $date_fin = Flight::request()->data['date_fin'] ?? null;
        $salaire = Flight::request()->data['salaire'] ?? null;

        $errors = [];

        if (!$salaire || !is_numeric($salaire) || $salaire <= 0) {
            $errors[] = "Salaire invalide ou manquant.";                
        }
        // Si tout est valide, traiter le formulaire
        if (empty($errors)) {
            $contratData = [
                'nom_entreprise' => $nom_entreprise,
                'adresse_entreprise' => $adresse_entreprise,
                'nif' => $nif,
                'stat' => $stat,
                'directeur_general' => $directeur_general,
                'nom_salarie' => $nom_salarie,
                'adresse_salarie' => $adresse_salarie,
                'poste' => $poste,
                'fonction' => $fonction,
                'duree_contrat' => $duree,
                'date_debut' => $debut,
                'date_fin' => $fin,
                'salaire' => $salaire,
                'heures_travail' => $heure_travail,
                'lieu' => Flight::request()->data['lieu'] ?? null,
                'heure_debut_matin' => Flight::request()->data['heure_debut_matin'] ?? null,
                'heure_fin_matin' => Flight::request()->data['heure_fin_matin'] ?? null,
                'heure_debut_apres_midi' => Flight::request()->data['heure_debut_apres_midi'] ?? null,
                'heure_fin_apres_midi' => Flight::request()->data['heure_fin_apres_midi'] ?? null,
                'date_signature' => date('d/m/Y')
            ];
            $_SESSION['contrat'] = $contratData; 
        
            Flight::render('ContratEssai', $contratData);
        }
    }


    public function exportPdf() {
        // Retrieve contrat data from session or model
        $contratData = $_SESSION['contrat'] ?? null;
        if (!$contratData) {
            Flight::halt(400, 'Aucune donnée de contrat trouvée. Veuillez soumettre le formulaire d\'abord.');
            return;
        }
    
        // Load Markdown template
        $markdownTemplate = file_get_contents(__DIR__ . '/../../Contrat_Engagement_Essai_Madagascar.markdown');
    
        // Remove backslashes from placeholders
        $markdownTemplate = preg_replace('/\\\\\[/', '[', $markdownTemplate);
        $markdownTemplate = preg_replace('/\\\\\]/', ']', $markdownTemplate);

        // Remove all remaining backslashes
        $markdownTemplate = str_replace('\\', '', $markdownTemplate);
    
        // Remove unwanted sections
        $markdownTemplate = str_replace('[Signature et cachet de l’entreprise]', '', $markdownTemplate);
        $markdownTemplate = str_replace('[Signature du salarié]', '', $markdownTemplate);
        $markdownTemplate = preg_replace('/---.*$/s', '', $markdownTemplate); // Remove the note section
    
        // Replace placeholders with actual data
        $replacements = [
            '[Nom de l’entreprise]' => htmlspecialchars($contratData['nom_entreprise'] ?? 'Nom Entreprise'),
            '[Adresse complète de l’entreprise]' => htmlspecialchars($contratData['adresse_entreprise'] ?? 'Adresse Entreprise'),
            '[Numéro d’identification fiscale/statistique]' => htmlspecialchars($contratData['nif'] ?? '') . ' / ' . htmlspecialchars($contratData['stat'] ?? ''),
            '[Nom et fonction du représentant]' => htmlspecialchars($contratData['directeur_general'] ?? 'Directeur Général'),
            '[Nom complet du salarié]' => htmlspecialchars($contratData['nom_salarie'] ?? 'Nom Salarié'),
            '[Adresse complète du salarié]' => htmlspecialchars($contratData['adresse_salarie'] ?? 'Adresse Salarié'),
            '[Numéro CIN ou pièce d’identité]' => 'CIN: ' . htmlspecialchars($contratData['cin'] ?? '10284839246'), // Assuming CIN is added
            '[date de naissance]' => htmlspecialchars($contratData['date_naissance'] ?? 'Date Naissance'),
            '[lieu de naissance]' => htmlspecialchars($contratData['lieu_naissance'] ?? 'Lieu Naissance'),
            '[intitulé du poste]' => htmlspecialchars($contratData['poste'] ?? 'Poste'),
            '[nom du département ou service]' => htmlspecialchars($contratData['fonction'] ?? 'Service'),
            '[adresse complète du lieu de travail]' => htmlspecialchars($contratData['lieu'] ?? 'Lieu Travail'),
            '[indiquer la durée : ex. 1 mois pour les ouvriers/employés, 2 mois pour les agents de maîtrise, ou 3 mois pour les cadres, selon la catégorie professionnelle]' => htmlspecialchars($contratData['duree_contrat'] ?? 'Durée') . ' mois',
            '[date de début]' => htmlspecialchars($contratData['date_debut'] ?? 'Date Début'),
            '[date de fin]' => htmlspecialchars($contratData['date_fin'] ?? 'Date Fin'),
            '[montant en Ariary]' => htmlspecialchars($contratData['salaire'] ?? 'Salaire') . ' Ariary',
            '[nombre]' => htmlspecialchars($contratData['heures_travail'] ?? 'Heures'),
            '[préciser les éventuelles primes ou avantages, si applicables]' => 'Prime de transport de 50 000 Ariary', // Example, adjust as needed
            '[virement bancaire/chèque/espèces]' => 'Virement bancaire',
            '[jour]' => 'Dernier jour ouvrable',
            '[préciser les horaires, ex. du lundi au vendredi de 8h à 17h avec une pause déjeuner]' => 'Du lundi au vendredi de ' . htmlspecialchars($contratData['heure_debut_matin'] ?? '8h') . ' à ' . htmlspecialchars($contratData['heure_fin_matin'] ?? '12h') . ' et de ' . htmlspecialchars($contratData['heure_debut_apres_midi'] ?? '13h') . ' à ' . htmlspecialchars($contratData['heure_fin_apres_midi'] ?? '17h'),
        ];
    
        $htmlContent = str_replace(array_keys($replacements), array_values($replacements), $markdownTemplate);
    
        // Convert Markdown to HTML (remove ** for bold, convert headers)
        $htmlContent = preg_replace('/\*\*(.+?)\*\*/', '$1', $htmlContent); // Remove ** and keep text plain
        $htmlContent = preg_replace('/^# (.+)$/m', '<h1>$1</h1>', $htmlContent);
        $htmlContent = preg_replace('/^### (.+)$/m', '<h3>$1</h3>', $htmlContent);
        $htmlContent = nl2br($htmlContent);
    
        // Wrap in basic HTML structure with Arial font
        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Contrat d\'Engagement à l\'Essai</title><style>body { font-family: Arial, sans-serif; }</style></head><body>' . $htmlContent . '</body></html>';
    
        // Generate PDF using Dompdf
        require_once __DIR__ . '/../../public/assets/lib/dompdf/autoload.inc.php';
        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $filename = 'contrat_engagement_essai_' . date('Y-m-d_H-i-s') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => 1, 'compress' => 1]);
    }
}