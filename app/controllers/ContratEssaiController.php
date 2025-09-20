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

    public function submitForm() { //MBOLA MILA INSERENA
        $nom_entreprise = Flight::request()->data['nom_entreprise'] ?? null;
        $adresse_entreprise = Flight::request()->data['adresse_entreprise'] ?? null;
        $nif = Flight::request()->data['nif'] ?? null;
        $stat = Flight::request()->data['stat'] ?? null;
        $directeur_general = Flight::request()->data['directeur_general'] ?? null;
        $nom_salarie = "Rakoto"; // nom salarie
        $adresse_salarie = "Antananarivo"; // adresse salarie
        $poste = "Développeur"; // poste
        $fonction = "Informatique"; // fonction

        $duree = Flight::request()->data['duree'] ?? null;
        $debut = date('Y-m-d'); // Utilise la date d'aujourd'hui au format YYYY-MM-DD
        $fin = date('Y-m-d', strtotime($debut . ' + ' . $duree . ' months'));
        // type contrat
        $salaire = Flight::request()->data['salaire'] ?? null;
        $heure_travail = Flight::request()->data['heure_travail'] ?? null;
        $id_employe = Flight::request()->data['id_employe'] ?? null;
        $date_debut = Flight::request()->data['date_debut'] ?? null;
        $date_fin = Flight::request()->data['date_fin'] ?? null;
        $salaire = Flight::request()->data['salaire'] ?? null;

        $errors = [];

        // Validation des données
        /* if (!$id_employe || !is_numeric($id_employe)) {
            $errors[] = "ID employé invalide ou manquant.";
        }          
        if (!$date_debut || !strtotime($date_debut)) {
            $errors[] = "Date de début invalide ou manquante.";
        }
        if (!$date_fin || !strtotime($date_fin)) {
            $errors[] = "Date de fin invalide ou manquante.";
        } */
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
            $_SESSION['contrat'] = $contratData; // Stocke les données
        
            // Vérifier si l'utilisateur veut le PDF ou l'affichage HTML
            $export_pdf = Flight::request()->data['export_pdf'] ?? false;
            
            if ($export_pdf) {
                $this->exportPdf(); // Appel direct
            } else {
                Flight::render('ContratEssai', $contratData);
            }
        }

    }

    public function exportPdf() {
        // Correct path depuis le dossier public
        require_once __DIR__ . '/../../public/assets/lib/dompdf/autoload.inc.php';
        
        // Récupérer les données du contrat depuis la session
        $contratData = $_SESSION['contrat'] ?? [];
        
        if (empty($contratData)) {
            Flight::halt(400, 'Aucune donnée de contrat trouvée');
            return;
        }

        // Extraire les variables pour la vue
        extract($contratData);

        // Capturer le HTML de la vue
        ob_start();

        // Utiliser Flight::render() pour capturer la vue avec les données
        Flight::view()->set($contratData);
        include Flight::get('flight.views.path') . '/ContratEssai.php';

        $html = ob_get_clean();

        // Créer une instance Dompdf
        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);

        // Charger le HTML
        $dompdf->loadHtml($html);

        // Configuration du papier
        $dompdf->setPaper('A4', 'portrait');

        // Rendu du PDF
        $dompdf->render();

        // Forcer le téléchargement
        $filename = 'contrat_essai_' . date('Y-m-d_H-i-s') . '.pdf';
        $dompdf->stream($filename, array(
            'Attachment' => 1,
            'compress' => 1
        ));
    }
}