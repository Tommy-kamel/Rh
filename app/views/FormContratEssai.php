
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat d'Essai - SARL TANA SERVICES</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --background-color: #f8f9fa;
            --card-background: #ffffff;
            --text-color: #212529;
            --light-text-color: #6c757d;
            --border-color: #dee2e6;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --success-color: #198754;
            --warning-color: #fd7e14;
            --danger-color: #dc3545;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #5a6acf 100%);
            padding: 20px 0;
            box-shadow: var(--shadow);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .user-info {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .form-card {
            background: var(--card-background);
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            overflow: hidden;
            position: relative;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-color), #5a6acf);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #5a6acf 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .card-header h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .card-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 25px;
        }

        .progress-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
        }

        .progress-bar {
            background: white;
            height: 100%;
            border-radius: 10px;
            transition: width 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-weight: 600;
            font-size: 0.8rem;
        }

        .card-body {
            padding: 50px 40px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: rgba(25, 135, 84, 0.1);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
        }

        .form-step {
            display: none;
        }
        
        .form-step.active {
            display: block;
            animation: fadeInUp 0.3s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .step-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--text-color);
            text-align: center;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .form-grid {
            display: grid;
            gap: 25px;
            margin-bottom: 30px;
        }

        .form-grid-2 {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .form-group {
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 8px;
            display: block;
            font-size: 1rem;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            font-family: 'Poppins', sans-serif;
            background: white;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            outline: none;
            transform: translateY(-1px);
        }

        .form-control.is-invalid {
            border-color: var(--danger-color);
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .time-section {
            background: var(--background-color);
            padding: 30px;
            border-radius: 16px;
            border: 1px solid var(--border-color);
        }

        .time-section h5 {
            text-align: center;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 25px;
            font-size: 1.2rem;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            min-width: 140px;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #5a6acf);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0b5ed7, #4c63d2);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3);
        }

        .btn-secondary {
            background: var(--secondary-color);
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color), #20c997);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #157347, #198754);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(25, 135, 84, 0.3);
        }

        .button-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 50px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .required {
            color: var(--danger-color);
        }

        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                gap: 15px;
            }

            .navbar-nav {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            .card-header {
                padding: 30px 20px;
            }

            .card-header h1 {
                font-size: 1.8rem;
            }

            .card-body {
                padding: 30px 20px;
            }

            .step-title {
                font-size: 1.5rem;
                margin-bottom: 30px;
            }

            .form-grid-2 {
                grid-template-columns: 1fr;
            }

            .time-section {
                padding: 20px;
            }

            .button-navigation {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="navbar-brand">
                <i data-feather="briefcase"></i>
                SARL TANA SERVICES
            </a>
            <div class="navbar-nav">
                <a href="/rh/dashboard" class="nav-link">
                    <i data-feather="home"></i>
                    Dashboard
                </a>
                <a href="/rh/menu-employe" class="nav-link">
                    <i data-feather="users"></i>
                    Employés
                </a>
                <a href="/rh/recrutement" class="nav-link">
                    <i data-feather="user-plus"></i>
                    Recrutement
                </a>
                <a href="#" class="nav-link active">
                    <i data-feather="file-text"></i>
                    Contrats
                </a>
                <span class="user-info">
                    <i data-feather="user"></i>
                    <?= $_SESSION['utilisateur']['nom_utilisateur'] ?? 'Utilisateur' ?>
                </span>
                <a href="/logout" class="nav-link">
                    <i data-feather="log-out"></i>
                    Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-card">
            <div class="card-header">
                <h1>Contrat d'Essai</h1>
                <p>Création d'un nouveau contrat d'essai pour un candidat sélectionné</p>
                <div class="progress-container">
                    <div class="progress-bar" id="progressBar" style="width: 33.33%;">Étape 1/3</div>
                </div>
            </div>
            
            <div class="card-body">
                <?php if (!empty($message)): ?>
                    <div class="alert <?php echo $message_type == 'success' ? 'alert-success' : 'alert-danger'; ?>">
                        <i data-feather="<?php echo $message_type == 'success' ? 'check-circle' : 'alert-circle'; ?>"></i>
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>
                
                <form action="/contrat-essai/submit" method="POST" id="contratForm">
                    <?php if (!empty($id_candidat)): ?>
                        <input type="hidden" name="id_candidat" value="<?= htmlspecialchars($id_candidat ?? '') ?>">
                    <?php endif; ?>
                    
                    <!-- Étape 1: Informations de l'entreprise -->
                    <div class="form-step active" data-step="1">
                        <h2 class="step-title">
                            <i data-feather="building"></i>
                            Informations de l'entreprise
                        </h2>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nom_entreprise" class="form-label">
                                    Nom de l'entreprise <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise" 
                                       value="SARL TANA SERVICES" required placeholder="Nom de l'entreprise">
                            </div>
                            
                            <div class="form-group">
                                <label for="adresse_entreprise" class="form-label">
                                    Adresse de l'entreprise <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" id="adresse_entreprise" name="adresse_entreprise" 
                                       value="Lot II M 45, Antananarivo 101, Madagascar" required placeholder="Adresse complète">
                            </div>
                            
                            <div class="form-grid form-grid-2">
                                <div class="form-group">
                                    <label for="nif" class="form-label">
                                        NIF <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nif" name="nif" 
                                           value="1234567890" required placeholder="Numéro d'identification fiscale">
                                </div>
                                <div class="form-group">
                                    <label for="stat" class="form-label">
                                        STAT <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="stat" name="stat" 
                                           value="82901 11 2020 0 12345" required placeholder="Numéro statistique">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="directeur_general" class="form-label">
                                    Directeur général <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" id="directeur_general" name="directeur_general" 
                                       value="RAKOTONIRINA Sophie" required placeholder="Nom du directeur général">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Étape 2: Conditions du contrat -->
                    <div class="form-step" data-step="2">
                        <h2 class="step-title">
                            <i data-feather="dollar-sign"></i>
                            Conditions du contrat
                        </h2>
                        
                        <div class="form-grid">
                            <div class="form-grid form-grid-2">
                                <div class="form-group">
                                    <label for="salaire" class="form-label">
                                        Salaire (Ariary) <span class="required">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="salaire" name="salaire" 
                                           min="0" step="1000" required placeholder="Ex: 500000">
                                </div>
                                <div class="form-group">
                                    <label for="duree_contrat" class="form-label">
                                        Durée du contrat <span class="required">*</span>
                                    </label>
                                    <select class="form-control" id="duree_contrat" name="duree_contrat" required>
                                        <option value="">Sélectionner la durée</option>
                                        <option value="1">1 mois</option>
                                        <option value="2">2 mois</option>
                                        <option value="3">3 mois</option>
                                        <option value="6">6 mois</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="heures_travail" class="form-label">
                                    Heures de travail par semaine <span class="required">*</span>
                                </label>
                                <select class="form-control" id="heures_travail" name="heures_travail" required>
                                    <option value="">Sélectionner les heures</option>
                                    <option value="35">35 heures/semaine</option>
                                    <option value="40">40 heures/semaine</option>
                                    <option value="45">45 heures/semaine</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mode_paiement" class="form-label">
                                    Mode de paiement <span class="required">*</span>
                                </label>
                                <select class="form-control" id="mode_paiement" name="mode_paiement" required>
                                    <option value="">Sélectionner le mode</option>
                                    <option value="virementBancaire">Virement Bancaire</option>
                                    <option value="cheque">Chèque</option>
                                    <option value="espece">Espèce</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Étape 3: Horaires de travail -->
                    <div class="form-step" data-step="3">
                        <h2 class="step-title">
                            <i data-feather="clock"></i>
                            Horaires de travail
                        </h2>
                        
                        <div class="form-grid form-grid-2">
                            <div class="time-section">
                                <h5>
                                    <i data-feather="sunrise"></i>
                                    Horaires du matin
                                </h5>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="heure_debut_matin" class="form-label">Heure de début</label>
                                        <input type="time" class="form-control" id="heure_debut_matin" 
                                               name="heure_debut_matin" value="08:00">
                                    </div>
                                    <div class="form-group">
                                        <label for="heure_fin_matin" class="form-label">Heure de fin</label>
                                        <input type="time" class="form-control" id="heure_fin_matin" 
                                               name="heure_fin_matin" value="12:00">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="time-section">
                                <h5>
                                    <i data-feather="sunset"></i>
                                    Horaires de l'après-midi
                                </h5>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="heure_debut_apres_midi" class="form-label">Heure de début</label>
                                        <input type="time" class="form-control" id="heure_debut_apres_midi" 
                                               name="heure_debut_apres_midi" value="13:00">
                                    </div>
                                    <div class="form-group">
                                        <label for="heure_fin_apres_midi" class="form-label">Heure de fin</label>
                                        <input type="time" class="form-control" id="heure_fin_apres_midi" 
                                               name="heure_fin_apres_midi" value="17:00">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="lieu" class="form-label">
                                Lieu de travail <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control" id="lieu" name="lieu" 
                                   value="Antananarivo" required placeholder="Ville ou localisation">
                        </div>
                    </div>
                    
                    <!-- Boutons de navigation -->
                    <div class="button-navigation">
                        <button type="button" class="btn btn-secondary" id="prevBtn" onclick="changeStep(-1)" style="display: none;">
                            <i data-feather="arrow-left"></i>
                            Précédent
                        </button>
                        <div></div>
                        <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">
                            Suivant
                            <i data-feather="arrow-right"></i>
                        </button>
                        <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">
                            <i data-feather="check"></i>
                            Valider le contrat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        feather.replace();
        
        let currentStep = 1;
        const totalSteps = 3;
        
        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            const progressBar = document.getElementById('progressBar');
            progressBar.style.width = progress + '%';
            progressBar.textContent = `Étape ${currentStep}/${totalSteps}`;
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
        
        // Validation en temps réel
        document.querySelectorAll('input[required], select[required]').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                }
            });
        });
        
        // Initialisation
        showStep(1);
    </script>
</body>
</html>