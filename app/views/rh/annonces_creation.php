<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une annonce - Recrutement</title>
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
            max-width: 1000px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 15px;
        }

        .progress-container {
            background: var(--card-background);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
        }

        .progress {
            background-color: var(--border-color);
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--primary-color), #5a6acf);
            height: 100%;
            border-radius: 10px;
            transition: width 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .form-section {
            display: none;
        }

        .form-section.active {
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

        .form-card {
            background: var(--card-background);
            border-radius: 16px;
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
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), #5a6acf);
        }

        .card-header {
            background: var(--background-color);
            padding: 25px 30px;
            border-bottom: 1px solid var(--border-color);
        }

        .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-body {
            padding: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            outline: none;
        }

        .critere-card {
            background: var(--card-background);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .critere-header {
            background: var(--background-color);
            padding: 15px 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .critere-header h6 {
            margin: 0;
            font-weight: 600;
            color: var(--text-color);
        }

        .critere-body {
            padding: 20px;
        }

        .form-check {
            margin-bottom: 10px;
        }

        .form-check-input {
            margin-right: 8px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
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
            background: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background: #157347;
            transform: translateY(-2px);
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            flex-wrap: wrap;
            gap: 15px;
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

            .page-header h1 {
                font-size: 2rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
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
                    Tableau de bord
                </a>
                <a href="/rh/menu-employe" class="nav-link">
                    <i data-feather="users"></i>
                    Employés
                </a>
                <a href="/rh/recrutement" class="nav-link active">
                    <i data-feather="user-plus"></i>
                    Recrutement
                </a>
                <span class="user-info">
                    <i data-feather="user"></i>
                    <?= isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']['nom_utilisateur'] : 'Utilisateur' ?>
                </span>
                <a href="/logout" class="nav-link">
                    <i data-feather="log-out"></i>
                    Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1>Créer une nouvelle annonce</h1>
        </div>
        
        <div class="progress-container">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Étape 1/2</div>
            </div>
        </div>
        
        <form action="/rh/annonces/creer" method="post" id="annonceForm">
            <!-- Étape 1: Informations de base -->
            <div class="form-section active" id="etape1">
                <div class="form-card">
                    <div class="card-header">
                        <h5>
                            <i data-feather="briefcase"></i>
                            Étape 1: Informations sur le poste
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="form-grid">
                            <div>
                                <label for="poste_voulu" class="form-label">Intitulé du poste</label>
                                <input type="text" class="form-control" id="poste_voulu" name="poste_voulu" required placeholder="Ex: Développeur Web">
                            </div>
                            <div>
                                <label for="id_fonction" class="form-label">Fonction</label>
                                <select class="form-control" id="id_fonction" name="id_fonction" required>
                                    <option value="">Sélectionner une fonction</option>
                                    <?php if(isset($fonctions)): ?>
                                        <?php foreach($fonctions as $fonction): ?>
                                            <option value="<?= $fonction['id_fonction'] ?>"><?= $fonction['nom_fonction'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div>
                                <label for="date_depot_limite" class="form-label">Date limite de dépôt</label>
                                <input type="date" class="form-control" id="date_depot_limite" name="date_depot_limite" required>
                            </div>
                        </div>
                        
                        <div class="button-group">
                            <div></div>
                            <button type="button" class="btn btn-primary" id="nextStep">
                                <i data-feather="arrow-right"></i>
                                Suivant: Définir les critères
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Étape 2: Critères et niveaux d'exigence -->
            <div class="form-section" id="etape2">
                <div class="form-card">
                    <div class="card-header">
                        <h5>
                            <i data-feather="settings"></i>
                            Étape 2: Définir les critères et niveaux d'exigence
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Critère: Âge -->
                        <div class="critere-card">
                            <div class="critere-header">
                                <h6>Âge</h6>
                            </div>
                            <div class="critere-body">
                                <div class="form-grid">
                                    <div>
                                        <label for="age_min" class="form-label">Âge minimum</label>
                                        <input type="number" class="form-control" id="age_min" name="age_min" min="18" max="70" placeholder="18">
                                    </div>
                                    <div>
                                        <label for="age_max" class="form-label">Âge maximum</label>
                                        <input type="number" class="form-control" id="age_max" name="age_max" min="18" max="70" placeholder="65">
                                    </div>
                                    <div>
                                        <label class="form-label">Niveau d'exigence</label>
                                        <select class="form-control" name="niveau_age">
                                            <option value="obligatoire">Obligatoire</option>
                                            <option value="tolerable">Tolérable</option>
                                            <option value="pas_important">Pas vraiment important</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Critère: Sexe -->
                        <div class="critere-card">
                            <div class="critere-header">
                                <h6>Sexe</h6>
                            </div>
                            <div class="critere-body">
                                <div class="form-grid">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexe" id="sexe_homme" value="Homme">
                                            <label class="form-check-label" for="sexe_homme">Homme</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexe" id="sexe_femme" value="Femme">
                                            <label class="form-check-label" for="sexe_femme">Femme</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexe" id="sexe_indifferent" value="Indifférent" checked>
                                            <label class="form-check-label" for="sexe_indifferent">Indifférent</label>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label">Niveau d'exigence</label>
                                        <select class="form-control" name="niveau_sexe">
                                            <option value="obligatoire">Obligatoire</option>
                                            <option value="tolerable">Tolérable</option>
                                            <option value="pas_important" selected>Pas vraiment important</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Critère: Expérience -->
                        <div class="critere-card">
                            <div class="critere-header">
                                <h6>Expérience</h6>
                            </div>
                            <div class="critere-body">
                                <div class="form-grid">
                                    <div>
                                        <label for="experience" class="form-label">Années d'expérience requises</label>
                                        <input type="number" class="form-control" id="experience" name="experience" min="0" max="50" placeholder="0">
                                    </div>
                                    <div>
                                        <label class="form-label">Niveau d'exigence</label>
                                        <select class="form-control" name="niveau_experience">
                                            <option value="obligatoire">Obligatoire</option>
                                            <option value="tolerable" selected>Tolérable</option>
                                            <option value="pas_important">Pas vraiment important</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Critère: Diplôme -->
                        <div class="critere-card">
                            <div class="critere-header">
                                <h6>Diplôme requis</h6>
                            </div>
                            <div class="critere-body">
                                <div class="form-grid">
                                    <div>
                                        <select class="form-control" id="diplome_requis" name="diplome_requis">
                                            <option value="">Sélectionner un diplôme</option>
                                            <option value="CEPE">CEPE</option>
                                            <option value="BEPC">BEPC</option>
                                            <option value="BACC">BACC</option>
                                            <option value="LICENCE">LICENCE</option>
                                            <option value="MASTER">MASTER</option>
                                            <option value="DOCTORAT">DOCTORAT</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label">Niveau d'exigence</label>
                                        <select class="form-control" name="niveau_diplome">
                                            <option value="obligatoire">Obligatoire</option>
                                            <option value="tolerable">Tolérable</option>
                                            <option value="pas_important">Pas vraiment important</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Critère: Langues -->
                        <div class="critere-card">
                            <div class="critere-header">
                                <h6>Langues maîtrisées</h6>
                            </div>
                            <div class="critere-body">
                                <div class="form-grid">
                                    <div>
                                        <input type="text" class="form-control" id="langues_maitrisees" name="langues_maitrisees" placeholder="Ex: Français, Anglais, Malgache">
                                    </div>
                                    <div>
                                        <label class="form-label">Niveau d'exigence</label>
                                        <select class="form-control" name="niveau_langues">
                                            <option value="obligatoire">Obligatoire</option>
                                            <option value="tolerable" selected>Tolérable</option>
                                            <option value="pas_important">Pas vraiment important</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Critère: Lieu à proximité -->
                        <div class="critere-card">
                            <div class="critere-header">
                                <h6>Lieu à proximité</h6>
                            </div>
                            <div class="critere-body">
                                <div class="form-grid">
                                    <div>
                                        <input type="text" class="form-control" id="lieu_a_proximite" name="lieu_a_proximite" placeholder="Ex: Antananarivo, Tamatave">
                                    </div>
                                    <div>
                                        <label class="form-label">Niveau d'exigence</label>
                                        <select class="form-control" name="niveau_lieu">
                                            <option value="obligatoire">Obligatoire</option>
                                            <option value="tolerable">Tolérable</option>
                                            <option value="pas_important" selected>Pas vraiment important</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="button-group">
                            <button type="button" class="btn btn-secondary" id="prevStep">
                                <i data-feather="arrow-left"></i>
                                Retour
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i data-feather="save"></i>
                                Enregistrer l'annonce
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <script>
        feather.replace();
        
        document.addEventListener('DOMContentLoaded', function() {
            const formSections = document.querySelectorAll('.form-section');
            const progressBar = document.querySelector('.progress-bar');
            const nextBtn = document.getElementById('nextStep');
            const prevBtn = document.getElementById('prevStep');
            let currentStep = 0;
            
            // Fonction pour afficher l'étape actuelle
            function showStep(step) {
                formSections.forEach((section, index) => {
                    if (index === step) {
                        section.classList.add('active');
                    } else {
                        section.classList.remove('active');
                    }
                });
                
                // Mettre à jour la barre de progression
                const progress = (step / (formSections.length - 1)) * 100;
                progressBar.style.width = progress + '%';
                progressBar.setAttribute('aria-valuenow', progress);
                progressBar.textContent = `Étape ${step + 1}/${formSections.length}`;
            }
            
            // Passer à l'étape suivante
            nextBtn.addEventListener('click', function() {
                const posteInput = document.getElementById('poste_voulu');
                const fonctionInput = document.getElementById('id_fonction');
                const dateInput = document.getElementById('date_depot_limite');
                
                // Valider les champs de l'étape 1
                if (!posteInput.value) {
                    alert('Veuillez saisir l\'intitulé du poste');
                    posteInput.focus();
                    return;
                }
                
                if (!dateInput.value) {
                    alert('Veuillez sélectionner une date limite');
                    dateInput.focus();
                    return;
                }
                
                if (currentStep < formSections.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });
            
            // Revenir à l'étape précédente
            prevBtn.addEventListener('click', function() {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });
            
            // Valider le formulaire avant envoi
            document.getElementById('annonceForm').addEventListener('submit', function(e) {
                const posteInput = document.getElementById('poste_voulu');
                const dateInput = document.getElementById('date_depot_limite');
                
                if (!posteInput.value || !dateInput.value) {
                    e.preventDefault();
                    alert('Veuillez remplir tous les champs obligatoires');
                    currentStep = 0;
                    showStep(currentStep);
                }
            });
            
            // Initialiser l'affichage
            showStep(currentStep);
        });
    </script>
</body>
</html>