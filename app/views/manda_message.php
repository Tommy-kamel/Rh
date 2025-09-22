<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
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

        .message-container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            text-align: center;
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

        .message-header {
            padding: 2rem;
            color: white;
        }

        .message-header.error {
            background: linear-gradient(135deg, var(--danger-color), #e74c3c);
        }

        .message-header.success {
            background: linear-gradient(135deg, var(--success-color), #20c997);
        }

        .message-header.default {
            background: linear-gradient(135deg, var(--primary-color), #4285f4);
        }

        .message-header h1 {
            margin: 0 0 1rem 0;
            font-weight: 600;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .message-icon {
            width: 32px;
            height: 32px;
        }

        .message-content {
            padding: 2rem;
        }

        .message-text {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            color: var(--dark-text);
        }

        .error-message {
            color: var(--danger-color);
            background: rgba(220, 53, 69, 0.1);
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid var(--danger-color);
        }

        .success-message {
            color: var(--success-color);
            background: rgba(25, 135, 84, 0.1);
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid var(--success-color);
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 2rem;
        }

        .button {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .home-button {
            background: linear-gradient(135deg, var(--primary-color), #4285f4);
            color: white;
        }

        .home-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3);
            color: white;
            text-decoration: none;
        }

        .custom-link {
            background: linear-gradient(135deg, var(--warning-color), #ffcd39);
            color: var(--dark-text);
        }

        .custom-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
            color: var(--dark-text);
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .message-container {
                margin: 0;
                border-radius: 0;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .message-header {
                padding: 1.5rem 1rem;
            }

            .message-header h1 {
                font-size: 1.5rem;
                flex-direction: column;
                gap: 0.25rem;
            }

            .message-content {
                padding: 1.5rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php if (isset($error_message)): ?>
            <div class="message-header error">
                <h1>
                    <i data-feather="alert-circle" class="message-icon"></i>
                    Erreur
                </h1>
            </div>
            <div class="message-content">
                <div class="message-text error-message">
                    <?= htmlspecialchars($error_message) ?>
                </div>
                <div class="button-group">
                    <?php if (isset($lien)): ?>
                        <a href="<?= htmlspecialchars($lien) ?>" class="button custom-link">
                            <i data-feather="external-link" style="width: 16px; height: 16px;"></i>
                            <?= htmlspecialchars($libele_lien ?? 'Lien personnalisé') ?>
                        </a>
                    <?php endif; ?>
                    <a href="/annonces" class="button home-button">
                        <i data-feather="home" style="width: 16px; height: 16px;"></i>
                        Retour à l'accueil
                    </a>
                </div>
            </div>
        <?php elseif (isset($succes_message)): ?>
            <div class="message-header success">
                <h1>
                    <i data-feather="check-circle" class="message-icon"></i>
                    Succès
                </h1>
            </div>
            <div class="message-content">
                <div class="message-text success-message">
                    <?= htmlspecialchars($succes_message) ?>
                </div>
                <div class="button-group">
                    <?php if (isset($lien)): ?>
                        <a href="<?= htmlspecialchars($lien) ?>" class="button custom-link">
                            <i data-feather="external-link" style="width: 16px; height: 16px;"></i>
                            <?= htmlspecialchars($libele_lien ?? 'Lien personnalisé') ?>
                        </a>
                    <?php endif; ?>
                    <a href="/annonces" class="button home-button">
                        <i data-feather="home" style="width: 16px; height: 16px;"></i>
                        Retour à l'accueil
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="message-header default">
                <h1>
                    <i data-feather="info" class="message-icon"></i>
                    Message
                </h1>
            </div>
            <div class="message-content">
                <div class="message-text error-message">
                    Une erreur est survenue.
                </div>
                <div class="button-group">
                    <a href="/annonces" class="button home-button">
                        <i data-feather="home" style="width: 16px; height: 16px;"></i>
                        Retour à l'accueil
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>