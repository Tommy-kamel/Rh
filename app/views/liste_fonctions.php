<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Fonctions - Gestion RH</title>
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
            --info-color: #000000ff;
            --primary-light: #e8f1fd;
            --card-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            --card-hover-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
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
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .page-title {
            font-weight: 600;
            color: var(--text-color);
            position: relative;
            display: inline-block;
            font-size: 2.5rem;
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

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .badge-count {
            background-color: var(--primary-light);
            color: var(--primary-color);
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-outline-secondary {
            background: transparent;
            border: 1px solid var(--secondary-color);
            color: var(--secondary-color);
        }

        .btn-outline-secondary:hover {
            background: var(--secondary-color);
            color: white;
        }

        .fonction-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .fonction-card {
            background: var(--card-background);
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
            padding: 30px;
            position: relative;
        }

        .fonction-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), #5a6acf);
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
            color: var(--text-color);
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-custom {
            border-radius: 8px;
            font-weight: 500;
            padding: 12px 20px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
            font-family: Poppins;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
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

        .empty-state {
            padding: 3rem 1rem;
            text-align: center;
            background: var(--card-background);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            grid-column: 1 / -1;
        }

        .empty-state i {
            color: #dee2e6;
            margin-bottom: 1rem;
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

            .page-title {
                font-size: 2rem;
            }

            .fonction-grid {
                grid-template-columns: 1fr;
            }
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
            <h1 class="page-title">Liste des Fonctions</h1>
            
            <div class="header-actions">
                <span class="badge-count"><?= count($fonctions ?? []) ?> fonction(s)</span>
                <a href="/annonces" class="btn btn-outline-secondary">
                    <i data-feather="arrow-left"></i>
                    Retour
                </a>
            </div>
        </div>
        
        <div class="fonction-grid">
            <?php if (!empty($fonctions)): ?>
                <?php foreach ($fonctions as $fonction): ?>
                    <div class="fonction-card">
                        <div class="text-center">
                            <div class="fonction-icon-container">
                                <i data-feather="briefcase" class="fonction-icon" data-fonction="<?= htmlspecialchars($fonction['nom_fonction']) ?>"></i>
                            </div>
                        </div>
                        
                        <h5 class="fonction-name">
                            <?= htmlspecialchars($fonction['nom_fonction']) ?>
                        </h5>
                        
                        <div class="btn-container">
                            <button class="btn-custom btn-questions" onclick="setFonctionAndRedirect(<?= $fonction['id_fonction'] ?>, '/question_test')">
                                <i data-feather="edit-3" class="btn-icon"></i>
                                Modifier les Questions
                            </button>
                            <button class="btn-custom btn-candidats" onclick="setFonctionAndRedirect(<?= $fonction['id_fonction'] ?>, '/liste_candidat')">
                                <i data-feather="users" class="btn-icon"></i>
                                Voir les candidats
                            </button>
                            <button class="btn-custom btn-entretien" onclick="setFonctionAndRedirect(<?= $fonction['id_fonction'] ?>, '/liste_candidats_scoring')">
                                <i data-feather="check-circle" class="btn-icon"></i>
                                Candidats après entretien
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i data-feather="inbox" style="width: 64px; height: 64px;"></i>
                    <h4 class="text-muted mt-3">Aucune fonction trouvée</h4>
                    <p class="text-muted">Il n'y a actuellement aucune fonction à afficher.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
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