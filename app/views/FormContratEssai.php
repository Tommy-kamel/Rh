<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat d'Essai</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Helvetica+Neue:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
/* Animations uniquement */
        .form-step {
            display: none;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .form-step.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Animation focus (Bootstrap n'a pas) */
        .form-floating input:focus, .form-floating select:focus {
            transform: scale(1.01);
            transition: transform 0.2s ease;
        }
        
        .form-floating input:not(:focus), .form-floating select:not(:focus) {
            transform: scale(1);
            transition: transform 0.2s ease;
        }
        
        /* Custom progress bar color */
        .progress-bar-custom {
            background-color: #0d6efd;
            transition: width 0.3s ease;
        }

        h2{
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #343a40;
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Gestion d'entreprise</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/dashboard">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/menu_employe">Gestion des employés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/recrutement">Recrutement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contrats</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">Connecté en tant que <?= $_SESSION['utilisateur']['nom_utilisateur'] ?? 'Utilisateur' ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card shadow border-0">
                    <!-- Header avec progress bar -->
                    <div class="bg-dark text-white p-4 rounded-top">
                        <div class="text-center">
                            <h1 class="h2 fw-bold mb-2">Contrat d'Essai</h1>
                            <p class="mb-3 opacity-75">Création d'un nouveau contrat d'essai</p>
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar progress-bar-custom" id="progressBar" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        <?php if (!empty($message)): ?>
                            <div class="alert <?php echo $message_type == 'success' ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show" role="alert">
                                <?php echo htmlspecialchars($message); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form action="/contrat-essai/submit" method="POST" id="contratForm">
                            <!-- Étape 1: Informations de l'entreprise -->
                            <div class="form-step active" data-step="1">
                                <h2 class="h4 text-center text-dark fw-bold mb-4">Informations de l'entreprise</h2>
                                
                                <div class="mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise" placeholder="Nom de l'entreprise" value="SARL TANA SERVICES" required>
                                        <label for="nom_entreprise" class="fw-semibold">Nom de l'entreprise *</label>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="adresse_entreprise" name="adresse_entreprise" placeholder="Adresse de l'entreprise" value="Lot II M 45, Antananarivo 101, Madagascar" required>
                                        <label for="adresse_entreprise" class="fw-semibold">Adresse de l'entreprise *</label>
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nif" name="nif" placeholder="NIF" value="1234567890 " required>
                                            <label for="nif" class="fw-semibold">NIF *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="stat" name="stat" placeholder="STAT" value="82901 11 2020 0 12345" required>
                                            <label for="stat" class="fw-semibold">STAT *</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="directeur_general" name="directeur_general" placeholder="Directeur général" value="RAKOTONIRINA Sophie" required>
                                        <label for="directeur_general" class="fw-semibold">Directeur général *</label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Étape 2: Conditions du contrat -->
                            <div class="form-step" data-step="2">
                                <h2 class="h4 text-center text-dark fw-bold mb-4">Conditions du contrat</h2>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="salaire" name="salaire" min="0" step="1000" placeholder="Salaire" required>
                                            <label for="salaire" class="fw-semibold">Salaire (Ar) *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" id="duree_contrat" name="duree_contrat" required>
                                                <option value="">Sélectionner...</option>
                                                <option value="1">1 mois</option>
                                                <option value="2">2 mois</option>
                                                <option value="3">3 mois</option>
                                                <option value="6">6 mois</option>
                                            </select>
                                            <label for="duree_contrat" class="fw-semibold">Durée du contrat (mois) *</label>
                                        </div>
                                    </div>   
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="heures_travail" name="heures_travail" required>
                                            <option value="">Sélectionner...</option>
                                            <option value="35">35 heures</option>
                                            <option value="40">40 heures</option>
                                            <option value="45">45 heures</option>
                                        </select>
                                        <label for="heures_travail" class="fw-semibold">Heures de travail par semaine *</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="mode_paiement" name="mode_paiement" required>
                                            <option value="">Sélectionner...</option>
                                            <option value="virementBancaire">Virement Bancaire</option>
                                            <option value="cheque">Chèque</option>
                                            <option value="espece">Espèce</option>
                                        </select>
                                        <label for="mode_paiement" class="fw-semibold">Mode de paiement *</label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Étape 3: Horaires de travail -->
                            <div class="form-step" data-step="3">
                                <h2 class="h4 text-center text-dark fw-bold mb-4">Horaires de travail</h2>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="bg-light p-3 rounded border">
                                            <h5 class="text-center fw-bold text-secondary mb-3">Matin</h5>
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="time" class="form-control" id="heure_debut_matin" name="heure_debut_matin" value="08:00">
                                                    <label for="heure_debut_matin" class="fw-semibold">Heure de début</label>
                                                </div>
                                            </div>
                                            <div class="form-floating">
                                                <input type="time" class="form-control" id="heure_fin_matin" name="heure_fin_matin" value="12:00">
                                                <label for="heure_fin_matin" class="fw-semibold">Heure de fin</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="bg-light p-3 rounded border">
                                            <h5 class="text-center fw-bold text-secondary mb-3">Après-midi</h5>
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="time" class="form-control" id="heure_debut_apres_midi" name="heure_debut_apres_midi" value="13:00">
                                                    <label for="heure_debut_apres_midi" class="fw-semibold">Heure de début</label>
                                                </div>
                                            </div>
                                            <div class="form-floating">
                                                <input type="time" class="form-control" id="heure_fin_apres_midi" name="heure_fin_apres_midi" value="17:00">
                                                <label for="heure_fin_apres_midi" class="fw-semibold">Heure de fin</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Ex: Antananarivo" value="Antananarivo" required>
                                        <label for="lieu" class="fw-semibold">Lieu</label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Boutons de navigation -->
                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-outline-secondary btn-md fw-semibold" id="prevBtn" onclick="changeStep(-1)" style="display: none;">
                                    ← Précédent
                                </button>
                                <div></div>
                                <button type="button" class="btn btn-primary btn-md fw-semibold" id="nextBtn" onclick="changeStep(1)">
                                    Suivant →
                                </button>
                                <button type="submit" class="btn btn-success btn-md fw-semibold" id="submitBtn" style="display: none;">
                                    Valider
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentStep = 1;
        const totalSteps = 3;
        
        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
        }
        
        function showStep(step) {
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            document.querySelector(`[data-step="${step}"]`).classList.add('active');
            
            // Mise à jour des boutons
            document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'block';
            document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'block';
            document.getElementById('submitBtn').style.display = step === totalSteps ? 'block' : 'none';
            
            updateProgress();
        }
        
        function changeStep(direction) {
            const newStep = currentStep + direction;
            
            if (newStep >= 1 && newStep <= totalSteps) {
                if (direction > 0 && !validateCurrentStep()) {
                    return;
                }
                
                currentStep = newStep;
                showStep(currentStep);
            }
        }
        
        function validateCurrentStep() {
            const currentStepElement = document.querySelector(`[data-step="${currentStep}"]`);
            const requiredInputs = currentStepElement.querySelectorAll('input[required], select[required]');
            
            for (let input of requiredInputs) {
                if (!input.value.trim()) {
                    input.focus();
                    input.classList.add('is-invalid');
                    setTimeout(() => {
                        input.classList.remove('is-invalid');
                    }, 2000);
                    return false;
                }
            }
            return true;
        }
        
        // Initialisation
        showStep(1);
    </script>
</body>
</html>