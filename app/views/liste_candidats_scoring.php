
<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidats avec Score - Gestion RH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --primary-color: #0d6efd;
            --primary-light: #e8f1fd;
            --success-color: #198754;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --info-color: #0dcaf0;
            --light-bg: #f8f9fa;
            --card-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            --card-hover-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Poppins', sans-serif;
            color: #495057;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #5a6acf 100%) !important;
            padding: 20px 0;
            box-shadow: var(--card-shadow);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 700;
            color: white !important;
            text-decoration: none;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .navbar-nav .nav-link:hover, 
        .navbar-nav .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .user-info {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .candidat-card {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .candidat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-hover-shadow);
        }
        
        .score-indicator {
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--success-color), #20c997);
            border-radius: 0 12px 0 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        .score-not-evaluated {
            background: linear-gradient(135deg, var(--warning-color), #ffcd39);
            color: #000;
        }
        
        .candidat-header {
            padding: 1.5rem;
            padding-right: 5rem;
            border-bottom: 1px solid #f1f3f4;
        }
        
        .candidat-id {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .candidat-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .candidat-email {
            color: #6c757d;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }
        
        .candidat-body {
            padding: 1.5rem;
        }
        
        .decision-section {
            background: var(--light-bg);
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }
        
        .decision-badge {
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .decision-accepted {
            background: linear-gradient(135deg, var(--success-color), #20c997);
            color: white;
        }
        
        .decision-rejected {
            background: linear-gradient(135deg, var(--danger-color), #e74c3c);
            color: white;
        }
        
        .decision-pending {
            background: linear-gradient(135deg, var(--warning-color), #ffcd39);
            color: #000;
        }
        
        .decision-under-review {
            background: linear-gradient(135deg, var(--info-color), #17a2b8);
            color: white;
        }
        
        .page-header {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
        }
        
        .page-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .page-subtitle {
            color: #6c757d;
            font-size: 1rem;
            margin-bottom: 0;
        }
        
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }
        
        .back-btn {
            background: white;
            border: 1px solid #dee2e6;
            color: #6c757d;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .back-btn:hover {
            background: var(--light-bg);
            color: #495057;
            text-decoration: none;
            transform: translateY(-1px);
        }
        
        .btn-icon {
            margin-right: 0.5rem;
            width: 16px;
            height: 16px;
        }
        
        .stats-row {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .stat-card {
            flex: 1;
            background: var(--light-bg);
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        .btn-contrat {
            background: linear-gradient(135deg, var(--success-color), #20c997);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .btn-contrat:hover {
            background: linear-gradient(135deg, #157347, #198754);
            color: white;
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
        }

        @media (max-width: 768px) {
            .navbar-nav {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i data-feather="briefcase"></i>
                SARL TANA SERVICES
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/dashboard">
                            <i data-feather="home"></i>
                            Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/menu-employe">
                            <i data-feather="users"></i>
                            Employés
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/rh/recrutement">
                            <i data-feather="user-plus"></i>
                            Recrutement
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link user-info">
                            <i data-feather="user"></i>
                            <?= $_SESSION['utilisateur']['nom_utilisateur'] ?? 'Utilisateur' ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">
                            <i data-feather="log-out"></i>
                            Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h1 class="page-title">Candidats Évalués</h1>
                    <p class="page-subtitle">Fonction ID: <?= htmlspecialchars($id_fonction ?? '') ?></p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-primary fs-6"><?= count($candidats ?? []) ?> candidat(s)</span>
                    <a href="/annonces" class="back-btn">
                        <i data-feather="arrow-left" class="btn-icon"></i>
                        Retour à l'accueil
                    </a>
                </div>
            </div>
            
            <?php if (!empty($candidats)): ?>
                <?php
                $evaluated = count(array_filter($candidats, function($c) { return $c['score_total'] != -1; }));
                $notEvaluated = count($candidats) - $evaluated;
                $accepted = count(array_filter($candidats, function($c) { 
                    return strtolower($c['decision']) === 'accepté' || strtolower($c['decision']) === 'retenu'; 
                }));
                ?>
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-number"><?= $evaluated ?></div>
                        <div class="stat-label">Évalués</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?= $notEvaluated ?></div>
                        <div class="stat-label">Non évalués</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?= $accepted ?></div>
                        <div class="stat-label">Retenus</div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if (empty($candidats)): ?>
            <div class="empty-state">
                <i data-feather="clipboard" style="width: 64px; height: 64px; color: #dee2e6; margin-bottom: 1rem;"></i>
                <h4 class="text-muted">Aucun candidat avec score trouvé</h4>
                <p class="text-muted">Il n'y a actuellement aucun candidat évalué pour cette fonction.</p>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($candidats as $candidat): ?>
                    <div class="col-lg-6 col-md-12">
                        <div class="candidat-card">
                            <div class="score-indicator <?= $candidat['score_total'] == -1 ? 'score-not-evaluated' : '' ?>">
                                <?= $candidat['score_total'] == -1 ? 'N/A' : $candidat['score_total'] ?>
                            </div>
                            
                            <div class="candidat-header">
                                <div class="candidat-id">
                                    <i data-feather="hash" style="width: 14px; height: 14px; margin-right: 3px;"></i>
                                    <?= htmlspecialchars($candidat['id_candidat']) ?>
                                </div>
                                <div class="candidat-name"><?= htmlspecialchars($candidat['nom'] . ' ' . $candidat['prenom']) ?></div>
                                <div class="candidat-email">
                                    <i data-feather="mail" style="width: 16px; height: 16px; margin-right: 8px;"></i>
                                    <?= htmlspecialchars($candidat['mail']) ?>
                                </div>
                            </div>
                            
                            <div class="candidat-body">
                                <div class="decision-section">
                                    <div style="margin-bottom: 0.5rem; font-weight: 500; color: #6c757d;">Décision finale</div>
                                    <?php
                                    $decision = strtolower($candidat['decision']);
                                    $badgeClass = 'decision-pending';
                                    $icon = 'clock';
                                    
                                    if (in_array($decision, ['accepté', 'retenu', 'embauché'])) {
                                        $badgeClass = 'decision-accepted';
                                        $icon = 'check-circle';
                                    } elseif (in_array($decision, ['rejeté', 'refusé', 'éliminé'])) {
                                        $badgeClass = 'decision-rejected';
                                        $icon = 'x-circle';
                                    } elseif (in_array($decision, ['en attente', 'pending', 'en cours'])) {
                                        $badgeClass = 'decision-pending';
                                        $icon = 'clock';
                                    } elseif (in_array($decision, ['en révision', 'review', 'analyse'])) {
                                        $badgeClass = 'decision-under-review';
                                        $icon = 'eye';
                                    }
                                    ?>
                                    <div class="decision-badge <?= $badgeClass ?>">
                                        <i data-feather="<?= $icon ?>" style="width: 16px; height: 16px; margin-right: 8px;"></i>
                                        <?= htmlspecialchars($candidat['decision']) ?>
                                    </div>
                                    
                                    
                                    <div class="mt-3">
                                        <a href="/contrat-essai/<?= $candidat['id_candidat'] ?>" class="btn btn-success btn-sm">
                                            <i data-feather="file-text" style="width: 16px; height: 16px; margin-right: 8px;"></i>
                                            Contrat d'essai
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>