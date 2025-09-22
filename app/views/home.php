<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - SARL TANA SERVICES</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --accent-color: #0d6efd;
            --background-color: #ffffff;
            --card-background: #ffffff;
            --text-color: #212529;
            --light-text-color: #6c757d;
            --border-color: #dee2e6;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--text-color);
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #5a6acf 100%);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
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

        .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .main-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px 20px;
        }

        .hero-section {
            max-width: 800px;
            text-align: center;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
            color: var(--text-color);
        }

        .hero-section p {
            font-size: 1.3rem;
            margin-bottom: 40px;
            /* color: var(--light-text-color); */
            color: white;
            line-height: 1.6;
        }

        .buttons-container {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .action-button {
            background: var(--card-background);
            color: var(--text-color);
            padding: 30px 40px;
            border: none;
            border-radius: 16px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            min-width: 250px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .action-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), #5a6acf);
        }

        .action-button:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
            color: var(--text-color);
            text-decoration: none;
        }

        .action-button.admin {
            background: linear-gradient(135deg, var(--primary-color), #5a6acf);
            color: white;
            border: none;
        }

        .action-button.admin:hover {
            background: linear-gradient(135deg, #0b5ed7, #4c63d2);
            color: white;
        }

        .action-button.emploi {
            background: linear-gradient(135deg, var(--primary-color), #5a6acf);
            color: white;
            border: none;
        }

        .action-button.emploi:hover {
            background: linear-gradient(135deg, #0b5ed7, #4c63d2);
            color: white;
        }

        .action-button .icon {
            width: 48px;
            height: 48px;
            padding: 12px;
            background: rgba(13, 110, 253, 0.1);
            border-radius: 12px;
            color: var(--primary-color);
        }

        .action-button.admin .icon {
            background: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
        }

        .action-button.emploi .icon {
            background: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
        }

        .action-button h3 {
            font-size: 1.2rem;
            margin: 0;
        }

        .action-button p {
            font-size: 0.9rem;
            opacity: 0.7;
            margin: 0;
            text-align: center;
            line-height: 1.4;
        }

        .features-section {
            margin-top: 80px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .feature-card {
            background: var(--card-background);
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .feature-card .icon {
            width: 40px;
            height: 40px;
            margin: 0 auto 15px;
            color: var(--primary-color);
        }

        .feature-card h3 {
            font-size: 1.1rem;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--text-color);
        }

        .feature-card p {
            font-size: 0.9rem;
            color: var(--light-text-color);
            line-height: 1.5;
        }

        .footer {
            background: linear-gradient(135deg, var(--primary-color) 0%, #5a6acf 100%);
            color: white;
            padding: 40px 20px 20px;
            text-align: center;
            margin-top: 80px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer-section h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .footer-section p {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            opacity: 0.6;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }

            .hero-section p {
                font-size: 1.1rem;
            }

            .buttons-container {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .action-button {
                min-width: 280px;
                padding: 25px 30px;
            }

            .features-section {
                grid-template-columns: 1fr;
                margin-top: 60px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 20px;
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
                <a href="/" class="nav-link">
                    <i data-feather="home"></i>
                    Accueil
                </a>
                <a href="/annonces" class="nav-link">
                    <i data-feather="search"></i>
                    Emplois
                </a>
                <a href="/about" class="nav-link">
                    <i data-feather="info"></i>
                    À propos
                </a>
            </div>
        </div>
    </nav>

    <div class="main-container">
        <div class="hero-section">
            <h1>Bienvenue sur TANA SERVICES</h1>
            <p>Votre plateforme de référence pour l'emploi à Madagascar. Connectez-vous à votre avenir professionnel avec notre système de gestion des ressources humaines moderne et efficace.</p>
            
            <div class="buttons-container">
                <a href="/login" class="action-button admin">
                    <div class="icon">
                        <i data-feather="settings"></i>
                    </div>
                    <h3>Administration</h3>
                    <p>Accédez au tableau de bord administrateur pour gérer les offres d'emploi et les candidatures</p>
                </a>
                
                <a href="/annonces" class="action-button emploi">
                    <div class="icon">
                        <i data-feather="search"></i>
                    </div>
                    <h3>Chercher un emploi</h3>
                    <p>Découvrez les opportunités de carrière disponibles et postulez en ligne facilement</p>
                </a>
            </div>

            <div class="features-section">
                <div class="feature-card">
                    <i data-feather="users" class="icon"></i>
                    <h3>Gestion des candidats</h3>
                    <p>Système complet de suivi des candidatures et des entretiens</p>
                </div>
                
                <div class="feature-card">
                    <i data-feather="file-text" class="icon"></i>
                    <h3>Tests QCM</h3>
                    <p>Évaluations automatisées pour mesurer les compétences des candidats</p>
                </div>
                
                <div class="feature-card">
                    <i data-feather="award" class="icon"></i>
                    <h3>Scoring automatique</h3>
                    <p>Système de notation intelligent pour faciliter la sélection</p>
                </div>
                
                <div class="feature-card">
                    <i data-feather="clipboard" class="icon"></i>
                    <h3>Contrats d'essai</h3>
                    <p>Génération automatique de contrats professionnels</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>
                    <i data-feather="briefcase"></i>
                    SARL TANA SERVICES
                </h4>
                <p>Excellence en recrutement depuis 2010</p>
                <p>Votre partenaire RH de confiance</p>
            </div>
            
            <div class="footer-section">
                <h4>
                    <i data-feather="map-pin"></i>
                    Adresse
                </h4>
                <p>
                    <i data-feather="map-pin"></i>
                    Lot II M 45, Antananarivo 101
                </p>
                <p>
                    <i data-feather="flag"></i>
                    Madagascar
                </p>
            </div>
            
            <div class="footer-section">
                <h4>
                    <i data-feather="user"></i>
                    Direction
                </h4>
                <p>
                    <i data-feather="user-check"></i>
                    RAKOTONIRINA Sophie
                </p>
                <p>Directeur Général</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2025 SARL TANA SERVICES. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        feather.replace();
    </script>
</body>
</html>