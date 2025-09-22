<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres d'emploi - SARL TANA SERVICES</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
<style>
        :root {
            --primary-color: #1e293b;
            --secondary-color: #64748b;
            --accent-color: #3b82f6;
            --background-color: #f8fafc;
            --card-background: #ffffff;
            --text-color: #334155;
            --light-text-color: #64748b;
            --border-color: #e2e8f0;
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

        /* Navbar */
        .navbar {
            background: var(--card-background);
            box-shadow: var(--shadow);
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
            height: 70px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-link {
            color: var(--text-color);
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
            color: var(--accent-color);
            background-color: rgba(59, 130, 246, 0.1);
        }

        .btn {
            padding: 10px 20px;
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

        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
        }

        .btn-outline:hover {
            background: var(--accent-color);
            color: white;
        }

        .btn-primary {
            background: var(--accent-color);
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .hero-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 40px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .section-header p {
            font-size: 1.1rem;
            color: var(--light-text-color);
            max-width: 600px;
            margin: 0 auto;
        }

        .annonces-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .annonce {
            background: var(--card-background);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 30px;
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .annonce::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            /* background: linear-gradient(90deg, var(--accent-color), #8b5cf6); */
        }

        .annonce:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .annonce-header {
            margin-bottom: 25px;
        }

        .date-limite {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 6px 12px;
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent-color);
            border-radius: 20px;
            margin-bottom: 15px;
        }

        .annonce-header h3 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
        }

        .annonce-details {
            margin: 25px 0;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            color: var(--light-text-color);
        }

        .detail-value {
            font-weight: 500;
            color: var(--text-color);
            text-align: right;
        }

        .annonce-footer {
            margin-top: 25px;
        }

        .btn-apply {
            width: 100%;
            padding: 14px 20px;
            background: var(--primary-color);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-apply:hover {
            background: var(--accent-color);
            transform: translateY(-1px);
        }
        
        .no-annonces {
            text-align: center;
            padding: 60px 30px;
            background: var(--card-background);
            border-radius: 12px;
            color: var(--light-text-color);
            border: 1px solid var(--border-color);
        }

        .no-annonces i {
            font-size: 3rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        /* Footer */
        .footer {
            background: var(--primary-color);
            color: white;
            padding: 60px 20px 30px;
            margin-top: 80px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-section p, .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 30px;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .navbar-nav {
                gap: 10px;
            }

            .btn {
                padding: 8px 16px;
                font-size: 0.9rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .hero-stats {
                flex-direction: column;
                gap: 20px;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .annonces-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
<script>
        function setFonctionAndRedirect(id_fonction, id_annonce) {
            fetch('/set_fonction', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id_fonction=' + encodeURIComponent(id_fonction)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/postuler/' + id_annonce;
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
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="navbar-brand">
                <i data-feather="briefcase"></i>
                TANA SERVICES
            </a>
            <div class="navbar-nav">
                <a href="/" class="nav-link">
                    <i data-feather="home"></i>
                    Accueil
                </a>
                <a href="#jobs" class="nav-link">
                    <i data-feather="search"></i>
                    Emplois
                </a>
                <a href="/login" class="btn btn-outline">
                    <i data-feather="log-in"></i>
                    Se connecter
                </a>
                <a href="/register" class="btn btn-primary">
                    <i data-feather="user-plus"></i>
                    S'inscrire
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <h1>Trouvez votre emploi idéal</h1>
            <p>Découvrez les meilleures opportunités de carrière à Madagascar avec SARL TANA SERVICES, votre partenaire de confiance pour l'emploi.</p>
            
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number"><?= count($annonces) ?></span>
                    <span class="stat-label">Offres disponibles</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Candidats placés</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">15+</span>
                    <span class="stat-label">Années d'expérience</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container" id="jobs">
        <div class="section-header">
            <h2>Nos Offres d'Emploi</h2>
            <p>Explorez nos opportunités de carrière soigneusement sélectionnées et trouvez le poste qui correspond parfaitement à vos compétences et ambitions.</p>
        </div>

        <?php if (!empty($annonces)): ?>
            <div class="annonces-grid">
                <?php foreach ($annonces as $annonce): ?>
                    <div class="annonce">
                        <div class="annonce-header">
                            <span class="date-limite">
                                <i data-feather="calendar"></i>
                                Candidature avant le <?php echo date('d/m/Y', strtotime($annonce['date_depot_limite'])); ?>
                            </span>
                            <h3><?php echo htmlspecialchars($annonce['poste_voulu']); ?></h3>
                        </div>

                        <div class="annonce-details">
                            <div class="detail-item">
                                <span class="detail-label">
                                    <i data-feather="users"></i>
                                    Âge requis
                                </span>
                                <span class="detail-value"><?php echo htmlspecialchars($annonce['age_min']) . ' - ' . htmlspecialchars($annonce['age_max']); ?> ans</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">
                                    <i data-feather="user"></i>
                                    Genre
                                </span>
                                <span class="detail-value"><?php echo htmlspecialchars($annonce['sexe']); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">
                                    <i data-feather="clock"></i>
                                    Expérience
                                </span>
                                <span class="detail-value"><?php echo htmlspecialchars($annonce['experience']); ?> ans minimum</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">
                                    <i data-feather="award"></i>
                                    Diplôme
                                </span>
                                <span class="detail-value"><?php echo htmlspecialchars($annonce['diplome_requis']); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">
                                    <i data-feather="message-circle"></i>
                                    Langues
                                </span>
                                <span class="detail-value"><?php echo htmlspecialchars($annonce['langues_maitrisees']); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">
                                    <i data-feather="map-pin"></i>
                                    Localisation
                                </span>
                                <span class="detail-value"><?php echo htmlspecialchars($annonce['lieu_a_proximite']); ?></span>
                            </div>
                        </div>

                        <div class="annonce-footer">
                            <button class="btn-apply" onclick="setFonctionAndRedirect(<?php echo $annonce['id_fonction']; ?>, <?php echo $annonce['id_annonce']; ?>)">
                                <i data-feather="send"></i>
                                Postuler maintenant
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-annonces">
                <i data-feather="inbox"></i>
                <h3>Aucune offre disponible</h3>
                <p>Aucune annonce n'est disponible pour le moment. Revenez bientôt pour découvrir de nouvelles opportunités !</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>
                        <i data-feather="briefcase"></i>
                        SARL TANA SERVICES
                    </h3>
                    <p>Votre partenaire de confiance pour l'emploi à Madagascar. Nous connectons les talents aux opportunités depuis plus de 15 ans.</p>
                </div>
                
                <div class="footer-section">
                    <h3>
                        <i data-feather="map-pin"></i>
                        Contact
                    </h3>
                    <p>
                        <i data-feather="map-pin"></i>
                        Lot II M 45, Antananarivo 101, Madagascar
                    </p>
                    <p>
                        <i data-feather="phone"></i>
                        +261 20 22 xxx xx
                    </p>
                    <p>
                        <i data-feather="mail"></i>
                        contact@tanaservices.mg
                    </p>
                </div>
                
                <div class="footer-section">
                    <h3>
                        <i data-feather="user"></i>
                        Direction
                    </h3>
                    <p>
                        <i data-feather="user-check"></i>
                        Directeur Général: RAKOTONIRINA Sophie
                    </p>
                    <p>
                        <i data-feather="clock"></i>
                        Lun - Ven: 8h00 - 17h00
                    </p>
                    <p>
                        <i data-feather="calendar"></i>
                        Sam: 8h00 - 12h00
                    </p>
                </div>
                
                <div class="footer-section">
                    <h3>
                        <i data-feather="link"></i>
                        Liens rapides
                    </h3>
                    <a href="/about">
                        <i data-feather="info"></i>
                        À propos
                    </a>
                    <a href="/services">
                        <i data-feather="service"></i>
                        Nos services
                    </a>
                    <a href="/contact">
                        <i data-feather="phone"></i>
                        Nous contacter
                    </a>
                    <a href="/privacy">
                        <i data-feather="shield"></i>
                        Confidentialité
                    </a>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 SARL TANA SERVICES. Tous droits réservés. | Conçu avec ❤️ à Madagascar</p>
            </div>
        </div>
    </footer>

    <script>
        feather.replace();
    </script>
</body>
</html>