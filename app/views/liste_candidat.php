<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Candidats - Gestion RH</title>
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
            --light-bg: #f8f9fa;
            --card-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            --card-hover-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Poppins', sans-serif;
            color: #495057;
        }
        
        .candidat-card {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }
        
        .candidat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-hover-shadow);
        }
        
        .candidat-header {
            background: linear-gradient(135deg, var(--primary-color), #4285f4);
            color: white;
            padding: 1.5rem;
            position: relative;
        }
        
        .candidat-id {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .candidat-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .candidat-email {
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .candidat-body {
            padding: 1.5rem;
        }
        
        .score-section {
            background: var(--light-bg);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .score-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .score-evaluated {
            background: var(--success-color);
            color: white;
        }
        
        .score-not-evaluated {
            background: var(--warning-color);
            color: white;
        }
        
        .btn-entretien {
            background: linear-gradient(135deg, var(--primary-color), #4285f4);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-entretien:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .btn-icon {
            margin-right: 0.5rem;
            width: 16px;
            height: 16px;
        }
        
        .decision-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            display: inline-block;
        }
        
        .decision-accepted {
            background: var(--success-color);
            color: white;
        }
        
        .decision-rejected {
            background: var(--danger-color);
            color: white;
        }
        
        .decision-pending {
            background: var(--warning-color);
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
            margin-bottom: 0;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
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
    </style>
    <script>
        function setFonctionAndRedirect(id_fonction, id_candidat) {
            fetch('/set_fonction', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id_fonction=' + encodeURIComponent(id_fonction)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/entretien/' + id_candidat;
                } else {
                    alert('Erreur lors de la définition de la fonction : ' + (data.error || 'Erreur inconnue'));
                }
            })
            .catch(error => {
                alert('Erreur : ' + error.message);
            });
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#" style="font-weight: 600;">Gestion d'entreprise</a>
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
                        <a class="nav-link active" href="/rh/recrutement">Recrutement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Candidats</a>
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

    <div class="container mt-4">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="page-title">Liste des Candidats</h1>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-primary fs-6"><?= count($candidats ?? []) ?> candidat(s)</span>
                    <a href="/annonces" class="back-btn">
                        <i data-feather="arrow-left" class="btn-icon"></i>
                        Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
        
        <?php if (empty($candidats)): ?>
            <div class="empty-state">
                <i data-feather="users" style="width: 64px; height: 64px; color: #dee2e6; margin-bottom: 1rem;"></i>
                <h4 class="text-muted">Aucun candidat trouvé</h4>
                <p class="text-muted">Il n'y a actuellement aucun candidat à afficher pour cette fonction.</p>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($candidats as $candidat): ?>
                    <div class="col-lg-6 col-md-12">
                        <div class="candidat-card">
                            <div class="candidat-header">
                                <div class="candidat-id">ID: <?= htmlspecialchars($candidat['id_candidat']) ?></div>
                                <div class="candidat-name"><?= htmlspecialchars($candidat['nom'] . ' ' . $candidat['prenom']) ?></div>
                                <div class="candidat-email">
                                    <i data-feather="mail" style="width: 14px; height: 14px; margin-right: 5px;"></i>
                                    <?= htmlspecialchars($candidat['mail']) ?>
                                </div>
                            </div>
                            
                            <div class="candidat-body">
                                <div class="score-section">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-semibold">Score d'évaluation :</span>
                                        <?php if ($candidat['score_total'] == -1): ?>
                                            <span class="score-badge score-not-evaluated">Non évalué</span>
                                        <?php else: ?>
                                            <span class="score-badge score-evaluated"><?= htmlspecialchars($candidat['score_total']) ?>/20</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <?php if ($candidat['has_entretien']): ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-semibold">Décision :</span>
                                        <?php
                                        $decision = $candidat['decision'];
                                        $badgeClass = 'decision-pending';
                                        if (strtolower($decision) === 'accepté' || strtolower($decision) === 'retenu') {
                                            $badgeClass = 'decision-accepted';
                                        } elseif (strtolower($decision) === 'rejeté' || strtolower($decision) === 'refusé') {
                                            $badgeClass = 'decision-rejected';
                                        }
                                        ?>
                                        <span class="decision-badge <?= $badgeClass ?>"><?= htmlspecialchars($decision) ?></span>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center">
                                        <a href="/entretien/<?= $candidat['id_candidat'] ?>" class="btn-entretien">
                                            <i data-feather="calendar" class="btn-icon"></i>
                                            Programmer un entretien
                                        </a>
                                    </div>
                                <?php endif; ?>
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