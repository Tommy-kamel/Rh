<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Contrat - SARL TANA SERVICES</title>
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
            --info-color: #0dcaf0;
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
            min-height: 100vh;
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
            padding: 40px 20px;
        }

        .contract-card {
            background: var(--card-background);
            border-radius: 20px;
            box-shadow: var(--shadow);
            overflow: hidden;
            position: relative;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .contract-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-color), #5a6acf);
        }

        .contract-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #5a6acf 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .contract-header h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .contract-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .contract-body {
            padding: 40px 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .info-section {
            background: var(--background-color);
            border-radius: 16px;
            padding: 30px;
            position: relative;
            transition: all 0.3s ease;
        }

        .info-section:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .info-icon {
            color: var(--primary-color);
            margin-right: 15px;
            flex-shrink: 0;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-weight: 600;
            color: var(--light-text-color);
            font-size: 0.9rem;
            margin-bottom: 3px;
        }

        .info-value {
            font-weight: 600;
            color: var(--text-color);
            font-size: 1.05rem;
        }

        .contract-details {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.05), rgba(90, 106, 207, 0.05));
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(13, 110, 253, 0.1);
        }

        .details-title {
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .contract-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .meta-item {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .meta-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .meta-label {
            font-size: 0.9rem;
            color: var(--light-text-color);
            font-weight: 500;
        }

        .actions-section {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            min-width: 180px;
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
            color: white;
            text-decoration: none;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color), #20c997);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #157347, #198754);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(25, 135, 84, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-secondary {
            background: var(--secondary-color);
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: linear-gradient(135deg, var(--success-color), #20c997);
            color: white;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            margin-top: 20px;
        }

        .contract-type {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: linear-gradient(135deg, var(--info-color), #17a2b8);
            color: white;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 10px;
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

            .contract-header,
            .contract-body {
                padding: 25px 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .contract-meta {
                grid-template-columns: repeat(2, 1fr);
            }

            .actions-section {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .contract-meta {
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
        <div class="contract-card">
            <div class="contract-header">
                <div class="contract-type">
                    <i data-feather="shield-check"></i>
                    Contrat Permanent
                </div>
                <h2>Contrat de Travail</h2>
                <p>Document officiel d'embauche</p>
                <div class="status-badge">
                    <i data-feather="check-circle"></i>
                    Contrat Actif
                </div>
            </div>

            <div class="contract-body">
                <div class="info-grid">
                    <div class="info-section">
                        <h3 class="section-title">
                            <i data-feather="user"></i>
                            Informations de l'Employé
                        </h3>
                        
                        <div class="info-item">
                            <i data-feather="user" class="info-icon"></i>
                            <div class="info-content">
                                <div class="info-label">Nom complet</div>
                                <div class="info-value"><?= htmlspecialchars(($employe['nom'] ?? '') . ' ' . ($employe['prenom'] ?? '')) ?></div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i data-feather="users" class="info-icon"></i>
                            <div class="info-content">
                                <div class="info-label">Sexe</div>
                                <div class="info-value"><?= htmlspecialchars($employe['sexe'] ?? 'Non renseigné') ?></div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i data-feather="mail" class="info-icon"></i>
                            <div class="info-content">
                                <div class="info-label">Email</div>
                                <div class="info-value"><?= htmlspecialchars($employe['mail'] ?? 'Non renseigné') ?></div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i data-feather="phone" class="info-icon"></i>
                            <div class="info-content">
                                <div class="info-label">Téléphone</div>
                                <div class="info-value"><?= htmlspecialchars($employe['telephone'] ?? 'Non renseigné') ?></div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i data-feather="calendar" class="info-icon"></i>
                            <div class="info-content">
                                <div class="info-label">Date de naissance</div>
                                <div class="info-value"><?= htmlspecialchars($employe['date_naissance'] ?? 'Non renseigné') ?></div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i data-feather="map-pin" class="info-icon"></i>
                            <div class="info-content">
                                <div class="info-label">Adresse</div>
                                <div class="info-value"><?= htmlspecialchars($employe['adresse'] ?? 'Non renseigné') ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="section-title">
                            <i data-feather="file-text"></i>
                            Informations du Contrat
                        </h3>
                        
                        <div class="info-item">
                            <i data-feather="hash" class="info-icon"></i>
                            <div class="info-content">
                                <div class="info-label">ID Contrat</div>
                                <div class="info-value"><?= htmlspecialchars($contrat['id_contrat'] ?? 'Non renseigné') ?></div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i data-feather="dollar-sign" class="info-icon"></i>
                            <div class="info-content">
                                <div class="info-label">Salaire</div>
                                <div class="info-value"><?= number_format($contrat['salaire'] ?? 0, 0, ',', ' ') ?> Ar</div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i data-feather="play-circle" class="info-icon"></i>
                            <div class="info-content">
                                <div class="info-label">Date de début</div>
                                <div class="info-value"><?= date('d/m/Y', strtotime($contrat['date_debut'] ?? 'now')) ?></div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i data-feather="stop-circle" class="info-icon"></i>
                            <div class="info-content">
                                <div class="info-label">Date de fin</div>
                                <div class="info-value">
                                    <?= $contrat['date_fin'] ? date('d/m/Y', strtotime($contrat['date_fin'])) : 'Indéterminée' ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i data-feather="building" class="info-icon"></i>
                            <div class="info-content">
                                <div class="info-label">Entreprise</div>
                                <div class="info-value">SARL TANA SERVICES</div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i data-feather="map" class="info-icon"></i>
                            <div class="info-content">
                                <div class="info-label">Lieu de travail</div>
                                <div class="info-value">Antananarivo, Madagascar</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contract-details">
                    <h3 class="details-title">
                        <i data-feather="clipboard"></i>
                        Détails du Contrat
                    </h3>
                    
                    <div class="contract-meta">
                        <div class="meta-item">
                            <div class="meta-value"><?= htmlspecialchars($contrat['id_contrat'] ?? 'N/A') ?></div>
                            <div class="meta-label">Numéro de contrat</div>
                        </div>
                        
                        <div class="meta-item">
                            <div class="meta-value">
                                <?= $contrat['date_fin'] ? 'Déterminée' : 'Indéterminée' ?>
                            </div>
                            <div class="meta-label">Durée</div>
                        </div>
                        
                        <div class="meta-item">
                            <div class="meta-value"><?= date('d/m/Y', strtotime($contrat['date_debut'] ?? 'now')) ?></div>
                            <div class="meta-label">Date d'embauche</div>
                        </div>
                        
                        <div class="meta-item">
                            <div class="meta-value">
                                <?php
                                $debut = new DateTime($contrat['date_debut'] ?? 'now');
                                $now = new DateTime();
                                $diff = $debut->diff($now);
                                echo $diff->days;
                                ?>
                            </div>
                            <div class="meta-label">Jours d'ancienneté</div>
                        </div>
                    </div>
                </div>

                <div class="actions-section">
                    <a href="/rh/contrat/export-pdf/<?= $contrat['id_contrat'] ?>" class="btn btn-primary">
                        <i data-feather="download"></i>
                        Télécharger PDF
                    </a>
                    
                    <a href="#" class="btn btn-success" onclick="window.print()">
                        <i data-feather="printer"></i>
                        Imprimer
                    </a>
                    
                    <a href="/rh/menu-employe" class="btn btn-secondary">
                        <i data-feather="arrow-left"></i>
                        Retour au menu
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
        
        // Animation d'entrée pour les cartes
        document.addEventListener('DOMContentLoaded', function() {
            const infoSections = document.querySelectorAll('.info-section');
            infoSections.forEach((section, index) => {
                setTimeout(() => {
                    section.style.opacity = '0';
                    section.style.transform = 'translateY(20px)';
                    section.style.transition = 'all 0.5s ease';
                    
                    setTimeout(() => {
                        section.style.opacity = '1';
                        section.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 100);
            });
        });
    </script>
</body>
</html>