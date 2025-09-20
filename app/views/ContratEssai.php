<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat d'Engagement à l'Essai</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        @media print {
            .no-print { display: none; }
            body { margin: 0; }
        }
        .contrat-doc {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            /* font-family: 'Times New Roman', serif; */
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .signature-section {
            margin-top: 4rem;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            width: 45%;
            border-top: 1px solid #000;
            padding-top: 1rem;
            text-align: center;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow border-0">
                    <div class="card-header bg-dark text-white text-center no-print">
                        <h3 class="mb-0">Contrat d'Engagement à l'Essai</h3>
                        <!-- <div class="mt-2">
                            <button class="btn btn-light btn-sm me-2" onclick="window.print()">📄 Imprimer</button>
                            <a href="/contrat-essai/export-pdf" class="btn btn-success btn-sm">📥 Télécharger PDF</a>
                        </div> -->
                    </div>
                    
                    <div class="card-body contrat-doc">
                        <div class="text-center mb-4">
                            <h1 class="h3 text-uppercase fw-bold">CONTRAT D'ENGAGEMENT À L'ESSAI</h1>
                        </div>
                        
                        <p class="fw-bold">Entre les soussignés :</p>
                        
                        <div class="mb-4">
                            <p class="fw-bold">L'Employeur :</p>
                            <p class="mb-1"><strong><?php echo htmlspecialchars($nom_entreprise); ?></strong></p>
                            <p class="mb-1"><?php echo htmlspecialchars($adresse_entreprise); ?></p>
                            <p class="mb-1">NIF: <?php echo htmlspecialchars($nif); ?> - STAT: <?php echo htmlspecialchars($stat); ?></p>
                            <p class="mb-1">Représentée par <?php echo htmlspecialchars($directeur_general); ?>,</p>
                            <p class="fst-italic">Ci-après dénommé « l'Employeur »,</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="fw-bold text-center">ET</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="fw-bold">Le Salarié :</p>
                            <p class="mb-1"><strong><?php echo htmlspecialchars($nom_salarie); ?></strong></p>
                            <p class="mb-1"><?php echo htmlspecialchars($adresse_salarie); ?></p>
                            <p class="fst-italic">Ci-après dénommé « le Salarié »,</p>
                        </div>
                        
                        <p class="fw-bold text-center">IL A ÉTÉ CONVENU CE QUI SUIT :</p>
                        
                        <div class="mb-4">
                            <h4 class="h6 fw-bold">Article 1 : Objet du contrat</h4>
                            <p>Le présent contrat est un contrat d'engagement à l'essai conclu dans le cadre de l'évaluation des compétences professionnelles du Salarié par l'Employeur, ainsi que des conditions de travail par le Salarié, conformément à la Loi n° 2003-044 du 28 juillet 2004 portant Code du Travail et au Décret n° 2007-008 du 9 janvier 2007.</p>
                        </div>
                        
                        <div class="mb-4">
                            <h4 class="h6 fw-bold">Article 2 : Poste et lieu de travail</h4>
                            <p>Le Salarié est engagé en qualité de <strong><?php echo htmlspecialchars($poste); ?></strong> au sein du département <strong><?php echo htmlspecialchars($fonction); ?></strong> de l'entreprise.</p>
                            <p>Le lieu de travail principal est situé à <?php echo htmlspecialchars($adresse_entreprise); ?>.</p>
                        </div>
                        
                        <div class="mb-4">
                            <h4 class="h6 fw-bold">Article 3 : Période d'essai</h4>
                            <p>Le contrat est assorti d'une période d'essai d'une durée de <strong><?php echo htmlspecialchars($duree_contrat); ?> mois</strong>.</p>
                            <p>Cette période commence le <strong><?php echo date('d/m/Y', strtotime($date_debut)); ?></strong> et se termine le <strong><?php echo date('d/m/Y', strtotime($date_fin)); ?></strong>.</p>
                        </div>
                        
                        <div class="mb-4">
                            <h4 class="h6 fw-bold">Article 4 : Rémunération</h4>
                            <p>Pendant la période d'essai, le Salarié percevra une rémunération brute mensuelle de <strong><?php echo number_format($salaire, 0, ',', ' '); ?> Ariary</strong> pour <strong><?php echo htmlspecialchars($heures_travail); ?></strong> heures de travail par semaine.</p>
                        </div>
                        
                        <div class="mb-4">
                            <h4 class="h6 fw-bold">Article 5 : Durée et organisation du travail</h4>
                            <p>La durée hebdomadaire de travail est fixée à <strong><?php echo htmlspecialchars($heures_travail); ?></strong> heures, réparties comme suit :</p>
                            <ul>
                                <li>Matin : de <?php echo htmlspecialchars($heure_debut_matin); ?> à <?php echo htmlspecialchars($heure_fin_matin); ?></li>
                                <li>Après-midi : de <?php echo htmlspecialchars($heure_debut_apres_midi); ?> à <?php echo htmlspecialchars($heure_fin_apres_midi); ?></li>
                            </ul>
                        </div>
                        
                        <div class="mb-4">
                            <h4 class="h6 fw-bold">Article 6 : Rupture du contrat pendant la période d'essai</h4>
                            <p>Conformément au Décret n° 2007-008, chacune des parties peut mettre fin au contrat pendant la période d'essai sans préavis ni indemnité. La rupture doit être notifiée par écrit.</p>
                        </div>
                        
                        <div class="mb-5">
                            <p><strong>Fait à <?php echo htmlspecialchars($lieu); ?>, le <?php echo $date_signature; ?></strong></p>
                            <p>En deux exemplaires originaux, dont un remis à chacune des parties.</p>
                        </div>
                        
                        <div class="signature-section">
                            <div class="signature-box">
                                <p class="fw-bold">L'Employeur</p>
                                <p class="small"><?php echo htmlspecialchars($directeur_general); ?></p>
                                <p class="small"><?php echo htmlspecialchars($nom_entreprise); ?></p>
                            </div>
                            <div class="signature-box">
                                <p class="fw-bold">Le Salarié</p>
                                <p class="small"><?php echo htmlspecialchars($nom_salarie); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>