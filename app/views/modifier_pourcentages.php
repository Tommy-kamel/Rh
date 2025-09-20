<?php
$variables = $variables ?? ['pourcentage_test' => 0.60, 'pourcentage_entretien' => 0.40];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier les pourcentages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
        }
        .form-container input {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
        }
        .form-container button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Modifier les pourcentages</h1>
    <div class="form-container">
        <form method="POST" action="/modifier_pourcentages">
            <label for="pourcentage_test">Pourcentage du test (0 à 100) :</label>
            <input type="number" name="pourcentage_test" step="0.01" min="0" max="100" value="<?= htmlspecialchars($variables['pourcentage_test']) ?>" required>
            <label for="pourcentage_entretien">Pourcentage de l'entretien (0 à 100) :</label>
            <input type="number" name="pourcentage_entretien" step="0.01" min="0" max="100" value="<?= htmlspecialchars($variables['pourcentage_entretien']) ?>" required>
            <button type="submit">Enregistrer</button>
        </form>
    </div>
    <a href="/annonces">Retour à l'accueil</a>
</body>
</html>