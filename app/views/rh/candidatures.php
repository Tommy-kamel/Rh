<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
    header('Location: /login');
    exit;
}

$title = "Gestion des candidatures";
$activeMenu = "recrutement";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Gestion RH</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-color);
        }

        .badge {
            background: var(--secondary-color);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 1rem;
        }

        .filter-card {
            background: var(--card-background);
            border-radius: 16px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .filter-header {
            background: var(--background-color);
            padding: 20px 25px;
            border-bottom: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .filter-header:hover {
            background: #e9ecef;
        }

        .filter-header h6 {
            margin: 0;
            font-weight: 600;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-body {
            padding: 25px;
            display: none;
        }

        .filter-body.show {
            display: block;
            animation: fadeInDown 0.3s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .filter-buttons {
            display: flex;
            gap: 15px;
            justify-content: flex-start;
            flex-wrap: wrap;
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
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            outline: none;
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

        .chevron-icon {
            transition: transform 0.3s ease;
        }

        .chevron-icon.rotated {
            transform: rotate(180deg);
        }

        .candidate-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .candidate-card {
            background: var(--card-background);
            border-radius: 16px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .candidate-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), #5a6acf);
        }

        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .card-body {
            padding: 30px;
        }

        .candidate-avatar {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .candidate-avatar img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--background-color);
            box-shadow: var(--shadow);
        }

        .status-badge {
            position: absolute;
            top: 5px;
            right: calc(50% - 50px);
            background: var(--success-color);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            border: 2px solid white;
        }

        .candidate-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-color);
            text-align: center;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            color: var(--primary-color);
            width: 20px;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .info-label {
            font-weight: 500;
            color: var(--text-color);
            min-width: 120px;
            font-size: 0.9rem;
        }

        .info-value {
            color: var(--light-text-color);
            font-size: 0.9rem;
            flex: 1;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            grid-column: 1 / -1;
        }

        .empty-state i {
            color: var(--light-text-color);
            margin-bottom: 20px;
        }

        .empty-state h4 {
            color: var(--light-text-color);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--light-text-color);
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

            .page-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .filter-buttons {
                justify-content: center;
            }

            .candidate-grid {
                grid-template-columns: 1fr;
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
            <h1>Liste des Candidatures</h1>
            <span class="badge"><?= count($candidatures ?? []) ?> candidature(s)</span>
        </div>

        <!-- Filtres -->
        <div class="filter-card">
            <div class="filter-header" onclick="toggleFilters()">
                <h6>
                    <i data-feather="filter"></i>
                    Filtres de recherche
                </h6>
                <i data-feather="chevron-down" class="chevron-icon" id="chevronIcon"></i>
            </div>
            <div class="filter-body" id="filterBody">
                <form method="GET" action="/rh/recrutement/candidatures">
                    <div class="filter-grid">
                        <div>
                            <label for="nom_prenom" class="form-label">Nom ou Prénom</label>
                            <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" value="<?= htmlspecialchars($filters['nom_prenom'] ?? '') ?>" placeholder="Rechercher...">
                        </div>
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= htmlspecialchars($filters['email'] ?? '') ?>" placeholder="Rechercher...">
                        </div>
                        <div>
                            <label for="niveau_etude" class="form-label">Niveau d'étude</label>
                            <select class="form-control" id="niveau_etude" name="niveau_etude">
                                <option value="">Tous</option>
                                <option value="Bac" <?= ($filters['niveau_etude'] ?? '') === 'Bac' ? 'selected' : '' ?>>Bac</option>
                                <option value="Licence" <?= ($filters['niveau_etude'] ?? '') === 'Licence' ? 'selected' : '' ?>>Licence</option>
                                <option value="Master" <?= ($filters['niveau_etude'] ?? '') === 'Master' ? 'selected' : '' ?>>Master</option>
                            </select>
                        </div>
                        <div>
                            <label for="experience" class="form-label">Expérience</label>
                            <select class="form-control" id="experience" name="experience">
                                <option value="">Tous</option>
                                <option value="Débutant" <?= ($filters['experience'] ?? '') === 'Débutant' ? 'selected' : '' ?>>Débutant</option>
                                <option value="1-3 ans" <?= ($filters['experience'] ?? '') === '1-3 ans' ? 'selected' : '' ?>>1-3 ans</option>
                                <option value="3-5 ans" <?= ($filters['experience'] ?? '') === '3-5 ans' ? 'selected' : '' ?>>3-5 ans</option>
                                <option value="5+ ans" <?= ($filters['experience'] ?? '') === '5+ ans' ? 'selected' : '' ?>>5+ ans</option>
                            </select>
                        </div>
                        <div>
                            <label for="sexe" class="form-label">Sexe</label>
                            <select class="form-control" id="sexe" name="sexe">
                                <option value="">Tous</option>
                                <option value="Homme" <?= ($filters['sexe'] ?? '') === 'Homme' ? 'selected' : '' ?>>Homme</option>
                                <option value="Femme" <?= ($filters['sexe'] ?? '') === 'Femme' ? 'selected' : '' ?>>Femme</option>
                            </select>
                        </div>
                        <div>
                            <label for="date_debut" class="form-label">Date de début</label>
                            <input type="date" class="form-control" id="date_debut" name="date_debut" value="<?= htmlspecialchars($filters['date_debut'] ?? '') ?>">
                        </div>
                        <div>
                            <label for="date_fin" class="form-label">Date de fin</label>
                            <input type="date" class="form-control" id="date_fin" name="date_fin" value="<?= htmlspecialchars($filters['date_fin'] ?? '') ?>">
                        </div>
                    </div>
                    
                    <div class="filter-buttons">
                        <button type="submit" class="btn btn-primary">
                            <i data-feather="search"></i>
                            Filtrer
                        </button>
                        <a href="/rh/recrutement/candidatures" class="btn btn-secondary">
                            <i data-feather="x"></i>
                            Réinitialiser
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="candidate-grid">
            <?php if (!empty($candidatures)): ?>
                <?php foreach ($candidatures as $candidat): ?>
                    <div class="candidate-card">
                        <div class="card-body">
                            <div class="candidate-avatar">
                                <img src="<?= htmlspecialchars($candidat['photo']) ?>" alt="Photo candidat">
                                <div class="status-badge">
                                    <i data-feather="check" style="width: 12px; height: 12px;"></i>
                                </div>
                            </div>
                            
                            <h5 class="candidate-name">
                                <?= htmlspecialchars($candidat['nom'] . ' ' . $candidat['prenom']) ?>
                            </h5>
                            
                            <div class="info-item">
                                <i data-feather="mail" class="info-icon"></i>
                                <span class="info-label">Email :</span>
                                <span class="info-value"><?= htmlspecialchars($candidat['mail']) ?></span>
                            </div>
                            <div class="info-item">
                                <i data-feather="phone" class="info-icon"></i>
                                <span class="info-label">Téléphone :</span>
                                <span class="info-value"><?= htmlspecialchars($candidat['telephone']) ?></span>
                            </div>
                            <div class="info-item">
                                <i data-feather="award" class="info-icon"></i>
                                <span class="info-label">Niveau d'étude :</span>
                                <span class="info-value"><?= htmlspecialchars($candidat['niveau_etude']) ?></span>
                            </div>
                            <div class="info-item">
                                <i data-feather="briefcase" class="info-icon"></i>
                                <span class="info-label">Expérience :</span>
                                <span class="info-value"><?= htmlspecialchars($candidat['experience']) ?></span>
                            </div>
                            <div class="info-item">
                                <i data-feather="calendar" class="info-icon"></i>
                                <span class="info-label">Date de naissance :</span>
                                <span class="info-value"><?= htmlspecialchars($candidat['date_de_naissance']) ?></span>
                            </div>
                            <div class="info-item">
                                <i data-feather="map-pin" class="info-icon"></i>
                                <span class="info-label">Adresse :</span>
                                <span class="info-value"><?= htmlspecialchars($candidat['adresse']) ?></span>
                            </div>
                            <div class="info-item">
                                <i data-feather="user" class="info-icon"></i>
                                <span class="info-label">Sexe :</span>
                                <span class="info-value"><?= htmlspecialchars($candidat['sexe']) ?></span>
                            </div>
                            <div class="info-item">
                                <i data-feather="clock" class="info-icon"></i>
                                <span class="info-label">Date candidature :</span>
                                <span class="info-value"><?= date('d/m/Y', strtotime($candidat['date_candidature'])) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i data-feather="inbox" style="width: 64px; height: 64px;"></i>
                    <h4>Aucune candidature trouvée</h4>
                    <p>Il n'y a actuellement aucune candidature à afficher.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        feather.replace();
        
        function toggleFilters() {
            const filterBody = document.getElementById('filterBody');
            const chevronIcon = document.getElementById('chevronIcon');
            
            if (filterBody.classList.contains('show')) {
                filterBody.classList.remove('show');
                chevronIcon.classList.remove('rotated');
            } else {
                filterBody.classList.add('show');
                chevronIcon.classList.add('rotated');
            }
        }
        
        // Ouvrir automatiquement les filtres si des filtres sont appliqués
        <?php if (!empty(array_filter($filters ?? []))): ?>
        document.addEventListener('DOMContentLoaded', function() {
            toggleFilters();
        });
        <?php endif; ?>
    </script>
</body>
</html>