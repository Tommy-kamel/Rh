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
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .candidate-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            font-family: Poppins, sans-serif;
            border: 1px solid #e9ecef;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            border-color: #007bff;
        }
        .card-body {
            padding: 1.8rem;
        }
        .candidate-avatar {
            position: relative;
            display: inline-block;
        }
        .candidate-avatar img {
            border: 4px solid #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .status-badge {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: 2px solid #ffffff;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
        }
        .candidate-name {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1.2rem;
        }
        .info-item {
            padding: 0.4rem 0;
            border-bottom: 1px solid #f1f3f4;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 500;
            color: #495057;
            min-width: 120px;
        }
        .info-value {
            color: #6c757d;
            font-weight: 400;
        }
        .info-icon {
            color: #007bff;
            width: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#" style="font-family: 'Poppins', sans-serif; font-weight: 600;">Gestion d'entreprise</a>
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
                        <a class="nav-link active" href="#">Candidatures</a>
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
        <div class="d-flex justify-content-between align-items-center mb-4" style="font-family: 'Poppins', sans-serif;">
            <h1 class="mb-0" style="font-weight: 600; color: #2c3e50;">Liste des Candidatures</h1>
            <span class="badge bg-secondary fs-6" style="font-family: 'Poppins', sans-serif; font-weight: 500;"><?= count($candidatures ?? []) ?> candidature(s)</span>
        </div>

        <!-- Filtres collapsibles -->
        <div class="card mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center" 
                 style="cursor: pointer;" 
                 data-bs-toggle="collapse" 
                 data-bs-target="#filterCollapse" 
                 aria-expanded="false" 
                 aria-controls="filterCollapse">
                <div class="d-flex align-items-center">
                    <i class="fas fa-filter me-2 text-primary"></i>
                    <h6 class="mb-0 fw-semibold">Filtres de recherche</h6>
                </div>
                <i class="fas fa-chevron-down transition-transform" id="filterToggleIcon"></i>
            </div>
            <div class="collapse" id="filterCollapse">
                <div class="card-body">
                    <form method="GET" action="/rh/recrutement/candidatures" class="row g-3">
                        <div class="col-md-3">
                            <label for="nom_prenom" class="form-label">Nom ou Prénom</label>
                            <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" value="<?= htmlspecialchars($filters['nom_prenom'] ?? '') ?>" placeholder="Rechercher...">
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= htmlspecialchars($filters['email'] ?? '') ?>" placeholder="Rechercher...">
                        </div>
                        <div class="col-md-2">
                            <label for="niveau_etude" class="form-label">Niveau d'étude</label>
                            <select class="form-select" id="niveau_etude" name="niveau_etude">
                                <option value="">Tous</option>
                                <option value="Bac" <?= ($filters['niveau_etude'] ?? '') === 'Bac' ? 'selected' : '' ?>>Bac</option>
                                <option value="Licence" <?= ($filters['niveau_etude'] ?? '') === 'Licence' ? 'selected' : '' ?>>Licence</option>
                                <option value="Master" <?= ($filters['niveau_etude'] ?? '') === 'Master' ? 'selected' : '' ?>>Master</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="experience" class="form-label">Expérience</label>
                            <select class="form-select" id="experience" name="experience">
                                <option value="">Tous</option>
                                <option value="Débutant" <?= ($filters['experience'] ?? '') === 'Débutant' ? 'selected' : '' ?>>Débutant</option>
                                <option value="1-3 ans" <?= ($filters['experience'] ?? '') === '1-3 ans' ? 'selected' : '' ?>>1-3 ans</option>
                                <option value="3-5 ans" <?= ($filters['experience'] ?? '') === '3-5 ans' ? 'selected' : '' ?>>3-5 ans</option>
                                <option value="5+ ans" <?= ($filters['experience'] ?? '') === '5+ ans' ? 'selected' : '' ?>>5+ ans</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="sexe" class="form-label">Sexe</label>
                            <select class="form-select" id="sexe" name="sexe">
                                <option value="">Tous</option>
                                <option value="Homme" <?= ($filters['sexe'] ?? '') === 'Homme' ? 'selected' : '' ?>>Homme</option>
                                <option value="Femme" <?= ($filters['sexe'] ?? '') === 'Femme' ? 'selected' : '' ?>>Femme</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="date_debut" class="form-label">Date de début</label>
                            <input type="date" class="form-control" id="date_debut" name="date_debut" value="<?= htmlspecialchars($filters['date_debut'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="date_fin" class="form-label">Date de fin</label>
                            <input type="date" class="form-control" id="date_fin" name="date_fin" value="<?= htmlspecialchars($filters['date_fin'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-search me-1"></i>Filtrer
                            </button>
                            <a href="/rh/recrutement/candidatures" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Réinitialiser
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="row">
            <?php if (!empty($candidatures)): ?>
                <?php foreach ($candidatures as $candidat): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card candidate-card h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="text-center mb-3">
                                    <div class="candidate-avatar">
                                        <img src="<?= htmlspecialchars($candidat['photo']) ?>" 
                                             width="90" height="90" 
                                             class="rounded-circle" 
                                             alt="Photo candidat"
                                             style="object-fit: cover;">
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill status-badge">
                                            <i class="fas fa-check" style="font-size: 0.7rem;"></i>
                                        </span>
                                    </div>
                                </div>
                                
                                <h5 class="card-title text-center candidate-name">
                                    <?= htmlspecialchars($candidat['nom'] . ' ' . $candidat['prenom']) ?>
                                </h5>
                                
                                <div class="flex-grow-1">
                                    <div class="info-item d-flex align-items-center">
                                        <i class="fas fa-envelope info-icon me-3"></i>
                                        <span class="info-label me-2">Email :</span>
                                        <span class="info-value text-truncate small"><?= htmlspecialchars($candidat['mail']) ?></span>
                                    </div>
                                    <div class="info-item d-flex align-items-center">
                                        <i class="fas fa-phone info-icon me-3"></i>
                                        <span class="info-label me-2">Téléphone :</span>
                                        <span class="info-value small"><?= htmlspecialchars($candidat['telephone']) ?></span>
                                    </div>
                                    <div class="info-item d-flex align-items-center">
                                        <i class="fas fa-graduation-cap info-icon me-3"></i>
                                        <span class="info-label me-2">Niveau d'étude :</span>
                                        <span class="info-value small"><?= htmlspecialchars($candidat['niveau_etude']) ?></span>
                                    </div>
                                    <div class="info-item d-flex align-items-center">
                                        <i class="fas fa-briefcase info-icon me-3"></i>
                                        <span class="info-label me-2">Expérience :</span>
                                        <span class="info-value small"><?= htmlspecialchars($candidat['experience']) ?></span>
                                    </div>
                                    <div class="info-item d-flex align-items-center">
                                        <i class="fas fa-birthday-cake info-icon me-3"></i>
                                        <span class="info-label me-2">Date de naissance :</span>
                                        <span class="info-value small"><?= htmlspecialchars($candidat['date_de_naissance']) ?></span>
                                    </div>
                                    <div class="info-item d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt info-icon me-3"></i>
                                        <span class="info-label me-2">Adresse :</span>
                                        <span class="info-value small text-truncate"><?= htmlspecialchars($candidat['adresse']) ?></span>
                                    </div>
                                    <div class="info-item d-flex align-items-center">
                                        <i class="fas fa-venus-mars info-icon me-3"></i>
                                        <span class="info-label me-2">Sexe :</span>
                                        <span class="info-value small"><?= htmlspecialchars($candidat['sexe']) ?></span>
                                    </div>
                                    <div class="info-item d-flex align-items-center">
                                        <i class="fas fa-calendar info-icon me-3"></i>
                                        <span class="info-label me-2">Date de candidature :</span>
                                        <span class="info-value small"><?= date('d/m/Y', strtotime($candidat['date_candidature'])) ?></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Aucune candidature trouvée</h4>
                        <p class="text-muted">Il n'y a actuellement aucune candidature à afficher.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation de l'icône flèche lors de l'ouverture/fermeture des filtres
        document.getElementById('filterCollapse').addEventListener('show.bs.collapse', function () {
            document.getElementById('filterToggleIcon').style.transform = 'rotate(180deg)';
        });
        
        document.getElementById('filterCollapse').addEventListener('hide.bs.collapse', function () {
            document.getElementById('filterToggleIcon').style.transform = 'rotate(0deg)';
        });
        
        // Ouvrir automatiquement les filtres si des filtres sont appliqués
        <?php if (!empty(array_filter($filters ?? []))): ?>
        document.addEventListener('DOMContentLoaded', function() {
            var filterCollapse = new bootstrap.Collapse(document.getElementById('filterCollapse'), {
                toggle: false
            });
            filterCollapse.show();
        });
        <?php endif; ?>
    </script>
</body>
</html>