<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord RH - SARL TANA SERVICES</title>
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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 50px;
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

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .card {
            background: var(--card-background);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 30px;
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), #5a6acf);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: rgba(13, 110, 253, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .card h5 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-color);
        }

        .card p {
            color: var(--light-text-color);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .btn {
            background: linear-gradient(135deg, var(--primary-color), #5a6acf);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn:hover {
            background: linear-gradient(135deg, #0b5ed7, #4c63d2);
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        .user-info {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
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

            .cards-grid {
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
                <a href="/rh/dashboard" class="nav-link active">
                    <i data-feather="home"></i>
                    Tableau de bord
                </a>
                <a href="/rh/menu-employe" class="nav-link">
                    <i data-feather="users"></i>
                    Employés
                </a>
                <a href="/rh/recrutement" class="nav-link">
                    <i data-feather="user-plus"></i>
                    Recrutement
                </a>
                <span class="user-info">
                    <i data-feather="user"></i>
                    <?= $_SESSION['utilisateur']['nom_utilisateur'] ?>
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
            <h1>Tableau de bord Ressources Humaines</h1>
            <p>Gérez efficacement vos ressources humaines avec notre plateforme intégrée</p>
        </div>
        
        <div class="cards-grid">
            <div class="card">
                <div class="card-icon">
                    <i data-feather="users" style="width: 32px; height: 32px;"></i>
                </div>
                <h5>Gestion des employés</h5>
                <p>Gérez les employés, consultez leurs informations et mettez à jour leurs dossiers personnels et professionnels.</p>
                <a href="/rh/menu_employe" class="btn">
                    <i data-feather="arrow-right"></i>
                    Accéder
                </a>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <i data-feather="user-plus" style="width: 32px; height: 32px;"></i>
                </div>
                <h5>Recrutement</h5>
                <p>Gérez les annonces d'emploi, examinez les candidatures et planifiez les entretiens avec les candidats.</p>
                <a href="/rh/recrutement" class="btn">
                    <i data-feather="arrow-right"></i>
                    Accéder
                </a>
            </div>
        </div>
    </div>
    
    <script>
        feather.replace();
    </script>
</body>
</html>