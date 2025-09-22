<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planification de l'entretien - SARL TANA SERVICES</title>
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
            max-width: 800px;
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

        .page-header p {
            font-size: 1.1rem;
            color: var(--light-text-color);
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
            padding: 40px;
        }

        .form-grid {
            display: grid;
            gap: 25px;
            margin-bottom: 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            background: white;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            outline: none;
        }

.rating-container {
            display: flex;
            gap: 20px;
            margin-top: 15px;
            justify-content: space-between;
        }

        .rating-option {
            position: relative;
            flex: 1;
        }

        .rating-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .rating-card {
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 25px 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 140px;
        }

        .rating-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .rating-option input[type="radio"]:checked + .rating-card {
            border-color: var(--primary-color);
            background: rgba(13, 110, 253, 0.05);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.2);
        }

        .rating-icon {
            font-size: 2.5rem;
            margin-bottom: 12px;
            display: block;
        }

        .rating-bas .rating-icon {
            color: var(--danger-color);
        }

        .rating-bas input[type="radio"]:checked + .rating-card {
            border-color: var(--danger-color);
            background: rgba(220, 53, 69, 0.05);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.2);
        }

        .rating-moyen .rating-icon {
            color: var(--warning-color);
        }

        .rating-moyen input[type="radio"]:checked + .rating-card {
            border-color: var(--warning-color);
            background: rgba(253, 126, 20, 0.05);
            box-shadow: 0 8px 25px rgba(253, 126, 20, 0.2);
        }

        .rating-haut .rating-icon {
            color: var(--success-color);
        }

        .rating-haut input[type="radio"]:checked + .rating-card {
            border-color: var(--success-color);
            background: rgba(25, 135, 84, 0.05);
            box-shadow: 0 8px 25px rgba(25, 135, 84, 0.2);
        }

        .rating-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-color);
            font-size: 1.1rem;
        }

        .rating-desc {
            font-size: 0.85rem;
            color: var(--light-text-color);
            line-height: 1.4;
            text-align: center;
        }

        .rating-score {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .rating-bas .rating-score {
            background: var(--danger-color);
        }

        .rating-moyen .rating-score {
            background: var(--warning-color);
        }

        .rating-haut .rating-score {
            background: var(--success-color);
        }

        .rating-option input[type="radio"]:checked + .rating-card .rating-score {
            opacity: 1;
            transform: scale(1.1);
        }

        .textarea-container {
            position: relative;
        }

        .textarea-container textarea {
            resize: vertical;
            min-height: 120px;
        }

        .char-counter {
            position: absolute;
            bottom: 10px;
            right: 15px;
            font-size: 0.85rem;
            color: var(--light-text-color);
            background: rgba(255, 255, 255, 0.9);
            padding: 2px 6px;
            border-radius: 4px;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            min-width: 160px;
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
            text-decoration: none;
            color: white;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .back-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--primary-color);
            text-decoration: none;
            transform: translateX(-3px);
        }

        .required {
            color: var(--danger-color);
        }

        .info-box {
            background: rgba(13, 110, 253, 0.1);
            border-left: 4px solid var(--primary-color);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .info-box p {
            margin: 0;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 8px;
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

            .card-body {
                padding: 25px;
            }

            .rating-container {
                flex-direction: column;
                gap: 15px;
            }

            .rating-card {
                min-height: 120px;
                padding: 20px 15px;
            }

            .rating-icon {
                font-size: 2rem;
            }

            .button-group {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 600px) {
            .rating-container {
                gap: 12px;
            }
            
            .rating-card {
                min-height: 100px;
                padding: 15px 10px;
            }
            
            .rating-title {
                font-size: 1rem;
            }
            
            .rating-desc {
                font-size: 0.8rem;
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
        <div class="page-header">
            <h1>Planification de l'entretien</h1>
            <p>Programmez et évaluez l'entretien du candidat</p>
        </div>

        <div class="info-box">
            <p>
                <i data-feather="info"></i>
                Planifiez un entretien pour évaluer les compétences et la motivation du candidat. Votre évaluation aidera à prendre la meilleure décision de recrutement.
            </p>
        </div>

        <div class="form-card">
            <div class="card-header">
                <h5>
                    <i data-feather="calendar"></i>
                    Détails de l'entretien
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="/enregistrer_entretien" id="entretienForm">
                    <input type="hidden" name="id_candidat" value="<?= htmlspecialchars($id_candidat ?? '') ?>">
                    <input type="hidden" name="id_fonction" value="<?= htmlspecialchars($id_fonction ?? '') ?>">
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="date_entretien" class="form-label">
                                <i data-feather="calendar"></i>
                                Date de l'entretien <span class="required">*</span>
                            </label>
                            <input type="datetime-local" 
                                   class="form-control" 
                                   id="date_entretien" 
                                   name="date_entretien" 
                                   required
                                   min="<?= date('Y-m-d\TH:i') ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i data-feather="star"></i>
                                Évaluation préliminaire <span class="required">*</span>
                            </label>
                            <p style="font-size: 0.9rem; color: var(--light-text-color); margin-bottom: 10px;">
                                Sélectionnez votre impression générale sur ce candidat
                            </p>
                            <div class="rating-container">
                                <div class="rating-option rating-bas">
                                    <input type="radio" id="note_bas" name="note" value="5" required>
                                    <label for="note_bas" class="rating-card">
                                        <div class="rating-score">5</div>
                                        <i data-feather="x-circle" class="rating-icon"></i>
                                        <div class="rating-title">Non qualifié</div>
                                        <div class="rating-desc">Ne répond pas aux critères essentiels du poste</div>
                                    </label>
                                </div>
                                <div class="rating-option rating-moyen">
                                    <input type="radio" id="note_moyen" name="note" value="10" required>
                                    <label for="note_moyen" class="rating-card">
                                        <div class="rating-score">10</div>
                                        <i data-feather="alert-circle" class="rating-icon"></i>
                                        <div class="rating-title">Potentiel</div>
                                        <div class="rating-desc">Répond partiellement aux exigences avec formation</div>
                                    </label>
                                </div>
                                <div class="rating-option rating-haut">
                                    <input type="radio" id="note_haut" name="note" value="15" required>
                                    <label for="note_haut" class="rating-card">
                                        <div class="rating-score">15</div>
                                        <i data-feather="check-circle" class="rating-icon"></i>
                                        <div class="rating-title">Excellent</div>
                                        <div class="rating-desc">Correspond parfaitement au profil recherché</div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="commentaire" class="form-label">
                                <i data-feather="message-square"></i>
                                Commentaires et observations
                            </label>
                            <div class="textarea-container">
                                <textarea class="form-control" 
                                          id="commentaire" 
                                          name="commentaire" 
                                          rows="5"
                                          placeholder="Décrivez vos impressions sur le candidat, ses points forts, ses axes d'amélioration..."
                                          maxlength="500"
                                          oninput="updateCharCounter()"></textarea>
                                <div class="char-counter" id="charCounter">0/500</div>
                            </div>
                        </div>
                    </div>

                    <div class="button-group">
                        <a href="/annonces" class="back-link">
                            <i data-feather="arrow-left"></i>
                            Retour à la liste
                        </a>
                        <div style="display: flex; gap: 15px;">
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                <i data-feather="refresh-cw"></i>
                                Réinitialiser
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="save"></i>
                                Enregistrer l'entretien
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        feather.replace();

        function updateCharCounter() {
            const textarea = document.getElementById('commentaire');
            const counter = document.getElementById('charCounter');
            const currentLength = textarea.value.length;
            const maxLength = 500;
            
            counter.textContent = `${currentLength}/${maxLength}`;
            
            if (currentLength > maxLength * 0.9) {
                counter.style.color = 'var(--warning-color)';
            } else {
                counter.style.color = 'var(--light-text-color)';
            }
        }

        function resetForm() {
            if (confirm('Êtes-vous sûr de vouloir réinitialiser le formulaire ?')) {
                document.getElementById('entretienForm').reset();
                updateCharCounter();
            }
        }

        // Validation du formulaire
        document.getElementById('entretienForm').addEventListener('submit', function(e) {
            const dateInput = document.getElementById('date_entretien');
            const noteInputs = document.querySelectorAll('input[name="note"]');
            
            if (!dateInput.value) {
                e.preventDefault();
                alert('Veuillez sélectionner une date et heure pour l\'entretien.');
                dateInput.focus();
                return;
            }

            const selectedDate = new Date(dateInput.value);
            const now = new Date();
            
            if (selectedDate <= now) {
                e.preventDefault();
                alert('La date de l\'entretien doit être ultérieure à maintenant.');
                dateInput.focus();
                return;
            }

            let noteSelected = false;
            noteInputs.forEach(input => {
                if (input.checked) noteSelected = true;
            });

            if (!noteSelected) {
                e.preventDefault();
                alert('Veuillez sélectionner une évaluation préliminaire.');
                return;
            }

            // Confirmer l'envoi
            if (!confirm('Confirmer l\'enregistrement de cet entretien ?')) {
                e.preventDefault();
            }
        });

        // Initialiser le compteur de caractères
        updateCharCounter();

        // Définir la date minimale (maintenant + 1 heure)
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            now.setHours(now.getHours() + 1);
            const minDateTime = now.toISOString().slice(0, 16);
            document.getElementById('date_entretien').min = minDateTime;
        });
    </script>
</body>
</html>