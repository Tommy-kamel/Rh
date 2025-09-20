<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        .error-message {
            color: red;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .success-message {
            color: green;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .home-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .home-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php if (isset($error_message)): ?>
        <h1>Erreur</h1>
        <p class="error-message"><?= htmlspecialchars($error_message) ?></p>
        <?php if (isset($lien)){ ?>
        <a href="<?=$lien ?>"><?=$libele_lien ?></a>
        <?php } ?>
    <?php elseif (isset($succes_message)): ?>
        <h1>Succès</h1>
        <p class="success-message"><?= htmlspecialchars($succes_message) ?></p>
    <?php else: ?>
        <h1>Message</h1>
        <p class="error-message">Une erreur est survenue.</p>
    <?php endif; ?>
    <a href="/annonces" class="home-button">Retour à l'accueil</a>
</body>
</html>