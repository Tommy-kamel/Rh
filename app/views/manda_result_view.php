<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat QCM</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --primary-color: #0d6efd;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --light-bg: #f8f9fa;
            --dark-text: #2c3e50;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            color: var(--dark-text);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .result-container {
            max-width: 600px;
            width: 100%;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result-header {
            background: linear-gradient(135deg, var(--primary-color), #4285f4);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .result-header h1 {
            margin: 0 0 1rem 0;
            font-weight: 600;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .result-content {
            padding: 2rem;
            text-align: center;
        }

        .score-section {
            margin-bottom: 2rem;
        }

        .score-display {
            background: var(--light-bg);
            padding: 2rem;
            border-radius: 8px;
            margin: 1rem 0;
            border-left: 4px solid var(--primary-color);
        }

        .score-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .score-label {
            font-size: 1.1rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }

        .result-message {
            padding: 1.5rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 500;
            margin: 1.5rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .result-success {
            background: rgba(25, 135, 84, 0.1);
            color: var(--success-color);
            border: 2px solid rgba(25, 135, 84, 0.2);
        }

        .result-failure {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
            border: 2px solid rgba(220, 53, 69, 0.2);
        }

        .status-icon {
            width: 24px;
            height: 24px;
        }

        .next-steps {
            background: var(--light-bg);
            padding: 1.5rem;
            border-radius: 8px;
            margin-top: 2rem;
            text-align: left;
        }

        .next-steps h3 {
            color: var(--dark-text);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .next-steps ul {
            list-style: none;
            padding: 0;
        }

        .next-steps li {
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .action-button {
            background: linear-gradient(135deg, var(--primary-color), #4285f4);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
            transition: all 0.3s ease;
        }

        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3);
            color: white;
            text-decoration: none;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .stat-card {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .result-container {
                margin: 0;
                border-radius: 0;
                min-height: 100vh;
            }

            .result-header {
                padding: 1.5rem 1rem;
            }

            .result-header h1 {
                font-size: 1.5rem;
                flex-direction: column;
                gap: 0.25rem;
            }

            .result-content {
                padding: 1.5rem 1rem;
            }

            .score-number {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="result-container">
        <div class="result-header">
            <h1>
                <i data-feather="award" style="width: 28px; height: 28px;"></i>
                Résultat du Test QCM
            </h1>
        </div>

        <div class="result-content">
            <div class="score-section">
                <div class="score-display">
                    <div class="score-number"><?= $score ?>/20</div>
                    <div class="score-label">Votre score final</div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number"><?= round(($score / 20) * 100) ?>%</div>
                        <div class="stat-label">Pourcentage</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?= $score >= 12 ? 'Réussi' : 'Échoué' ?></div>
                        <div class="stat-label">Statut</div>
                    </div>
                </div>
            </div>

            <?php if ($score >= 12): ?>
                <div class="result-message result-success">
                    <i data-feather="check-circle" class="status-icon"></i>
                    Félicitations ! Vous avez réussi le test QCM
                </div>

                <div class="next-steps">
                    <h3>
                        <i data-feather="calendar" style="width: 20px; height: 20px;"></i>
                        Prochaines étapes
                    </h3>
                    <ul>
                        <li>
                            <i data-feather="clock" style="width: 16px; height: 16px; color: var(--warning-color);"></i>
                            En attente de planification d'entretien
                        </li>
                        <li>
                            <i data-feather="mail" style="width: 16px; height: 16px; color: var(--info-color);"></i>
                            Vous recevrez un email avec les détails
                        </li>
                        <li>
                            <i data-feather="user-check" style="width: 16px; height: 16px; color: var(--success-color);"></i>
                            Préparez-vous pour l'entretien
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="result-message result-failure">
                    <i data-feather="x-circle" class="status-icon"></i>
                    Vous n'avez pas atteint la moyenne requise
                </div>

                <!-- <div class="next-steps">
                    <h3>
                        <i data-feather="info" style="width: 20px; height: 20px;"></i>
                        Informations
                    </h3>
                    <ul>
                        <li>
                            <i data-feather="target" style="width: 16px; height: 16px; color: var(--danger-color);"></i>
                            Score minimum requis : 12/20
                        </li>
                        <li>
                            <i data-feather="trending-up" style="width: 16px; height: 16px; color: var(--warning-color);"></i>
                            Continuez à vous perfectionner
                        </li>
                        <li>
                            <i data-feather="refresh-cw" style="width: 16px; height: 16px; color: var(--info-color);"></i>
                            Vous pourrez retenter votre chance plus tard
                        </li>
                    </ul>
                </div> -->
            <?php endif; ?>

            <a href="/annonces" class="action-button">
                <i data-feather="home" style="width: 16px; height: 16px;"></i>
                Retour à l'accueil
            </a>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>