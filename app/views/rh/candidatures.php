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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --light-bg: #ecf0f1;
            --card-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="%23ffffff" opacity="0.05"/><circle cx="80" cy="80" r="1" fill="%23ffffff" opacity="0.05"/><circle cx="40" cy="60" r="1" fill="%23ffffff" opacity="0.03"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            pointer-events: none;
            z-index: -1;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            border: none;
            padding: 1.2rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.6rem;
            letter-spacing: 1px;
            color: #ffffff !important;
            transition: var(--transition);
        }

        .navbar-brand:hover {
            color: var(--accent-color) !important;
            transform: scale(1.05);
        }

        .nav-link {
            font-weight: 500;
            transition: var(--transition);
            border-radius: var(--border-radius);
            margin: 0 4px;
            padding: 0.7rem 1.2rem !important;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition);
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            color: #ffffff !important;
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--accent-color), #2980b9);
            color: white !important;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .container.mt-4 {
            margin-top: 2rem !important;
            padding: 2rem;
        }

        h1.mb-4 {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 3rem !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        h1.mb-4::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(135deg, var(--accent-color), var(--success-color));
            border-radius: 2px;
        }

        .row {
            gap: 2rem 0;
        }

        .col-md-4 {
            padding: 0 1rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            overflow: hidden;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--accent-color), var(--success-color));
        }

        .card:hover {
            transform: translateY(-10px) rotate(1deg);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border-color: var(--accent-color);
        }

        .card-body {
            padding: 2rem;
            position: relative;
        }

        .card-body::before {
            content: '';
            position: absolute;
            top: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--accent-color), var(--success-color));
            opacity: 0.1;
            border-radius: 50%;
        }

        .card img {
            border-radius: 50%;
            border: 4px solid var(--accent-color);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            transition: var(--transition);
            margin-bottom: 1rem;
            object-fit: cover;
        }

        .card:hover img {
            transform: scale(1.1);
            border-color: var(--success-color);
        }

        .card-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .card-text {
            line-height: 1.8;
            color: var(--secondary-color);
            position: relative;
            z-index: 2;
        }

        .card-text strong {
            color: var(--primary-color);
            font-weight: 600;
            display: inline-block;
            min-width: 140px;
            position: relative;
        }

        .card-text strong::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, var(--accent-color), var(--success-color));
            transition: var(--transition);
        }

        .card:hover .card-text strong::after {
            width: 100%;
        }

        .card-text br {
            content: '';
            display: block;
            margin: 0.8rem 0;
        }

        .alert-info {
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.1), rgba(155, 89, 182, 0.1));
            border: 2px solid rgba(52, 152, 219, 0.3);
            border-radius: var(--border-radius);
            color: var(--primary-color);
            font-weight: 600;
            padding: 2rem;
            text-align: center;
            font-size: 1.2rem;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }

        .alert-info::before {
            content: '📋';
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 3rem;
            opacity: 0.3;
        }

        /* Animations */
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

        .card {
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }
        .card:nth-child(5) { animation-delay: 0.5s; }
        .card:nth-child(6) { animation-delay: 0.6s; }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .container.mt-4 {
                padding: 1rem;
            }
            
            h1.mb-4 {
                font-size: 2rem;
            }
            
            .card {
                margin-bottom: 2rem;
            }
            
            .card:hover {
                transform: translateY(-5px) rotate(0deg);
            }
            
            .navbar-brand {
                font-size: 1.3rem;
            }
            
            .nav-link {
                padding: 0.5rem 1rem !important;
                margin: 2px 0;
            }
        }

        /* Loading animation */
        .card {
            position: relative;
        }

        .card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.4), 
                transparent
            );
            transition: var(--transition);
        }

        .card:hover::after {
            left: 100%;
        }

        /* Glassmorphism effect */
        .navbar,
        .card {
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Focus states for accessibility */
        .nav-link:focus,
        .card:focus {
            outline: 3px solid var(--accent-color);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Gestion d'entreprise</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/dashboard">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/recrutement">Recrutement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/recrutement/annonces">Annonces</a>
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
    <h1 class="mb-4">Liste des Candidatures</h1>
    <div class="row">
        <?php if (!empty($candidatures)): ?>
            <?php foreach ($candidatures as $candidat): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <img src="<?= htmlspecialchars($candidat['photo']) ?>" width="90" height="90"><br>
                            <h5 class="card-title"><?= htmlspecialchars($candidat['nom'] . ' ' . $candidat['prenom']) ?></h5>
                            <p class="card-text">
                                <strong>Email :</strong> <?= htmlspecialchars($candidat['mail']) ?><br>
                                <strong>Telephone :</strong> <?= htmlspecialchars($candidat['telephone']) ?><br>
                                <strong>Niveau d'etude :</strong> <?= htmlspecialchars($candidat['niveau_etude']) ?><br>
                                <strong>Experience :</strong> <?= htmlspecialchars($candidat['experience']) ?><br>
                                <strong>Date de naissance :</strong> <?= htmlspecialchars($candidat['date_de_naissance']) ?><br>
                                <strong>Adresse :</strong> <?= htmlspecialchars($candidat['adresse']) ?><br>
                                <strong>Sexe :</strong> <?= htmlspecialchars($candidat['sexe']) ?><br>
                                <strong>Date de candidature :</strong> <?= htmlspecialchars($candidat['date_candidature']) ?><br>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info">Aucune candidature trouvée.</div>
        <?php endif; ?>
    </div>
</div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>