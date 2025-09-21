<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres d'emploi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
        :root {
            --primary-color: #2c3e50; /* Bleu nuit sobre */
            --secondary-color: #3498db; /* Bleu clair pour l'accent */
            --background-color: #f4f7f6; /* Fond gris très clair */
            --card-background: #ffffff;
            --text-color: #34495e; /* Gris foncé pour le texte */
            --light-text-color: #7f8c8d; /* Gris plus clair */
            --border-color: #ecf0f1;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
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
            line-height: 1.7;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .page-header p {
            font-size: 1.1rem;
            color: var(--light-text-color);
        }

        .annonces-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .annonce {
            background-color: var(--card-background);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 30px;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-top: 4px solid var(--secondary-color);
        }

        .annonce:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .annonce-header .date-limite {
            display: inline-block;
            font-size: 0.8rem;
            font-weight: 500;
            padding: 4px 12px;
            background-color: #eaf4fc;
            color: var(--secondary-color);
            border-radius: 20px;
            margin-bottom: 15px;
        }

        .annonce-header h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
        }

        .annonce-details {
            margin: 25px 0;
            flex-grow: 1;
        }

        .annonce-details p {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.95rem;
        }
        
        .annonce-details p:last-child {
            border-bottom: none;
        }

        .annonce-details strong {
            font-weight: 500;
            color: var(--light-text-color);
            margin-right: 15px;
        }

        .annonce-details span {
            text-align: right;
            font-weight: 500;
        }

        .annonce-footer button {
            width: 100%;
            padding: 14px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .annonce-footer button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .no-annonces {
            text-align: center;
            padding: 50px;
            background-color: var(--card-background);
            border-radius: 12px;
            color: var(--light-text-color);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="page-header">
            <h1>Nos Offres d'Emploi</h1>
            <p>Trouvez l'opportunité qui vous correspond.</p>
        </div>

        <?php if (!empty($annonces)): ?>
            <div class="annonces-grid">
                <?php foreach ($annonces as $annonce): ?>
                    <div class="annonce">
                        <div class="annonce-header">
                            <span class="date-limite">Date limite: <?php echo date('d/m/Y', strtotime($annonce['date_depot_limite'])); ?></span>
                            <h3><?php echo htmlspecialchars($annonce['poste_voulu']); ?></h3>
                        </div>

                        <div class="annonce-details">
                            <p><strong>Âge :</strong> <span><?php echo htmlspecialchars($annonce['age_min']) . ' - ' . htmlspecialchars($annonce['age_max']); ?> ans</span></p>
                            <p><strong>Sexe :</strong> <span><?php echo htmlspecialchars($annonce['sexe']); ?></span></p>
                            <p><strong>Expérience :</strong> <span><?php echo htmlspecialchars($annonce['experience']); ?> ans</span></p>
                            <p><strong>Diplôme requis :</strong> <span><?php echo htmlspecialchars($annonce['diplome_requis']); ?></span></p>
                            <p><strong>Langues :</strong> <span><?php echo htmlspecialchars($annonce['langues_maitrisees']); ?></span></p>
                            <p><strong>Lieu :</strong> <span><?php echo nl2br(htmlspecialchars($annonce['lieu_a_proximite'])); ?></span></p>
                        </div>

                        <div class="annonce-footer">
                            <button onclick="window.location.href='/postuler/<?php echo $annonce['id_annonce']; ?>'">Postuler</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-annonces">Aucune annonce n'est disponible pour le moment. Revenez bientôt !</p>
        <?php endif; ?>
    </div>

</body>
</html>