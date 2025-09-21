<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une annonce - Recrutement</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
        .niveau-exigence {
            margin-top: 10px;
        }
    </style>
</head>
<body>
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
                        <a class="nav-link" href="/rh/recrutement">Recrutement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/recrutement/annonces">Gestion des annonces</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">Connecté en tant que <?= isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']['nom_utilisateur'] : 'Utilisateur' ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Créer une nouvelle annonce</h1>
        
        <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Étape 1/2</div>
        </div>
        
        <form action="/rh/annonces/creer" method="post" id="annonceForm">
            <!-- Étape 1: Informations de base -->
            <div class="form-section active" id="etape1">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Étape 1: Informations sur le poste</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="poste_voulu" class="form-label">Intitulé du poste</label>
                                <input type="text" class="form-control" id="poste_voulu" name="poste_voulu" required>
                            </div>
                            <div class="col-md-6">
                                <label for="id_fonction" class="form-label">Fonction</label>
                                <select class="form-select" id="id_fonction" name="id_fonction" required>
                                    <option value="">Sélectionner une fonction</option>
                                    <?php if(isset($fonctions)): ?>
                                        <?php foreach($fonctions as $fonction): ?>
                                            <option value="<?= $fonction['id_fonction'] ?>"><?= $fonction['nom_fonction'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="date_depot_limite" class="form-label">Date limite de dépôt</label>
                                <input type="date" class="form-control" id="date_depot_limite" name="date_depot_limite" required>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="nextStep">Suivant: Définir les critères</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Étape 2: Critères et niveaux d'exigence -->
            <div class="form-section" id="etape2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Étape 2: Définir les critères et niveaux d'exigence</h5>
                    </div>
                    <div class="card-body">
                        <!-- Critère: Âge -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">Âge</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="age_min" class="form-label">Âge minimum</label>
                                        <input type="number" class="form-control" id="age_min" name="age_min" min="18" max="70">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="age_max" class="form-label">Âge maximum</label>
                                        <input type="number" class="form-control" id="age_max" name="age_max" min="18" max="70">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Niveau d'exigence</label>
                                        <div class="niveau-exigence">
                                            <select class="form-select" name="niveau_age">
                                                <option value="obligatoire">Obligatoire</option>
                                                <option value="tolerable">Tolérable</option>
                                                <option value="pas_important">Pas vraiment important</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Critère: Sexe -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">Sexe</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
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
                                    <div class="col-md-4">
                                        <label class="form-label">Niveau d'exigence</label>
                                        <div class="niveau-exigence">
                                            <select class="form-select" name="niveau_sexe">
                                                <option value="obligatoire">Obligatoire</option>
                                                <option value="tolerable">Tolérable</option>
                                                <option value="pas_important" selected>Pas vraiment important</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Critère: Expérience -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">Expérience</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="experience" class="form-label">Années d'expérience requises</label>
                                        <input type="number" class="form-control" id="experience" name="experience" min="0" max="50">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Niveau d'exigence</label>
                                        <div class="niveau-exigence">
                                            <select class="form-select" name="niveau_experience">
                                                <option value="obligatoire">Obligatoire</option>
                                                <option value="tolerable" selected>Tolérable</option>
                                                <option value="pas_important">Pas vraiment important</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Critère: Diplôme -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">Diplôme requis</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="diplome_requis" name="diplome_requis" placeholder="Ex: Master en Informatique">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Niveau d'exigence</label>
                                        <div class="niveau-exigence">
                                            <select class="form-select" name="niveau_diplome">
                                                <option value="obligatoire">Obligatoire</option>
                                                <option value="tolerable">Tolérable</option>
                                                <option value="pas_important">Pas vraiment important</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Critère: Langues -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">Langues maîtrisées</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="langues_maitrisees" name="langues_maitrisees" placeholder="Ex: Français, Anglais, Malgache">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Niveau d'exigence</label>
                                        <div class="niveau-exigence">
                                            <select class="form-select" name="niveau_langues">
                                                <option value="obligatoire">Obligatoire</option>
                                                <option value="tolerable" selected>Tolérable</option>
                                                <option value="pas_important">Pas vraiment important</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Critère: Lieu à proximité -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">Lieu à proximité</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="lieu_a_proximite" name="lieu_a_proximite" placeholder="Ex: Antananarivo, Tamatave">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Niveau d'exigence</label>
                                        <div class="niveau-exigence">
                                            <select class="form-select" name="niveau_lieu">
                                                <option value="obligatoire">Obligatoire</option>
                                                <option value="tolerable">Tolérable</option>
                                                <option value="pas_important" selected>Pas vraiment important</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" id="prevStep">Retour</button>
                            <button type="submit" class="btn btn-success">Enregistrer l'annonce</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script>
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