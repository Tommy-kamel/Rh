<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Fonctions - Gestion RH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --primary-color: #0d6efd;
            --primary-light: #e8f1fd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            /* --info-color: #0dcaf0; */
            --info-color: #000000ff;
            --warning-color: #ffc107;
            --light-bg: #f8f9fa;
            --card-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            --card-hover-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            color: #495057;
        }
        
        .fonction-card {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }
        
        .fonction-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-hover-shadow);
        }
        
        .fonction-icon-container {
            background-color: var(--primary-light);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            transition: all 0.3s ease;
        }
        
        .fonction-card:hover .fonction-icon-container {
            background-color: var(--primary-color);
            transform: scale(1.05);
        }
        
        .fonction-icon {
            color: var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .fonction-card:hover .fonction-icon {
            color: white;
        }
        
        .fonction-name {
            color: #2c3e50;
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        
        .btn-custom {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.6rem 1rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .btn-questions {
            background-color: white;
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-questions:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-candidats {
            background-color: white;
            color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .btn-candidats:hover {
            background-color: var(--success-color);
            color: white;
        }
        
        .btn-entretien {
            background-color: white;
            color: var(--info-color);
            border-color: var(--info-color);
        }
        
        .btn-entretien:hover {
            background-color: var(--info-color);
            color: white;
        }
        
        .btn-icon {
            margin-right: 8px;
            width: 16px;
            height: 16px;
        }
        
        .page-header {
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-weight: 600;
            color: #2c3e50;
            position: relative;
            display: inline-block;
        }
        
        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }
        
        .badge-count {
            background-color: var(--primary-light);
            color: var(--primary-color);
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .empty-state {
            padding: 3rem 1rem;
            text-align: center;
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }
        
        .empty-state i {
            color: #dee2e6;
            margin-bottom: 1rem;
        }
    </style>
    <script>
        function setFonctionAndRedirect(id_fonction, url) {
            fetch('/set_fonction', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id_fonction=' + encodeURIComponent(id_fonction)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = url;
                } else {
                    alert('Erreur lors de la définition de la fonction : ' + (data.error || 'Erreur inconnue'));
                }
            })
            .catch(error => {
                alert('Erreur : ' + error.message);
            });
        }

        function getFunctionIcon(nomFonction) {
            const nom = nomFonction.toLowerCase();
            if (nom.includes('développ') || nom.includes('program') || nom.includes('tech')) return 'code';
            if (nom.includes('design') || nom.includes('créat') || nom.includes('graph')) return 'palette';
            if (nom.includes('market') || nom.includes('commercial') || nom.includes('vente')) return 'trending-up';
            if (nom.includes('rh') || nom.includes('ressources') || nom.includes('humain')) return 'users';
            if (nom.includes('compta') || nom.includes('financ') || nom.includes('gestion')) return 'dollar-sign';
            if (nom.includes('manager') || nom.includes('direction') || nom.includes('chef')) return 'star';
            if (nom.includes('support') || nom.includes('assistance') || nom.includes('service')) return 'headphones';
            return 'briefcase';
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
                        <a class="nav-link" href="#">Fonctions</a>
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
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h1 class="page-title">Liste des Fonctions</h1>
                
                <div class="header-actions">
                    <span class="badge-count"><?= count($fonctions ?? []) ?> fonction(s)</span>
                    <a href="/annonces" class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                        <i data-feather="arrow-left" class="btn-icon"></i>
                        Retour
                    </a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <?php if (!empty($fonctions)): ?>
                <?php foreach ($fonctions as $fonction): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card fonction-card">
                            <div class="card-body d-flex flex-column p-4">
                                <div class="text-center mb-3">
                                    <div class="fonction-icon-container">
                                        <i data-feather="briefcase" class="fonction-icon" data-fonction="<?= htmlspecialchars($fonction['nom_fonction']) ?>"></i>
                                    </div>
                                </div>
                                
                                <h5 class="fonction-name">
                                    <?= htmlspecialchars($fonction['nom_fonction']) ?>
                                </h5>
                                
                                <div class="btn-container mt-auto">
                                    <button class="btn btn-custom btn-questions" onclick="setFonctionAndRedirect(<?= $fonction['id_fonction'] ?>, '/question_test')">
                                        <i data-feather="edit-3" class="btn-icon"></i>
                                        Modifier les Questions
                                    </button>
                                    <button class="btn btn-custom btn-candidats" onclick="setFonctionAndRedirect(<?= $fonction['id_fonction'] ?>, '/liste_candidat')">
                                        <i data-feather="users" class="btn-icon"></i>
                                        Voir les candidats
                                    </button>
                                    <button class="btn btn-custom btn-entretien" onclick="setFonctionAndRedirect(<?= $fonction['id_fonction'] ?>, '/liste_candidats_scoring')">
                                        <i data-feather="check-circle" class="btn-icon"></i>
                                        Candidats après entretien
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i data-feather="inbox" style="width: 64px; height: 64px;"></i>
                        <h4 class="text-muted mt-3">Aucune fonction trouvée</h4>
                        <p class="text-muted">Il n'y a actuellement aucune fonction à afficher.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();
        
        // Mettre à jour les icônes en fonction du nom de la fonction
        document.querySelectorAll('.fonction-icon').forEach(icon => {
            const nomFonction = icon.getAttribute('data-fonction');
            const iconName = getFunctionIcon(nomFonction);
            icon.setAttribute('data-feather', iconName);
        });
        
        // Re-render les icônes mises à jour
        feather.replace();
    </script>
</body>
</html>