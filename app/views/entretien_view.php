<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Planification de l'entretien</title>
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
        .form-container input, .form-container textarea {
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
    <h1>Planification de l'entretien</h1>
    <!-- <p>Candidat ID: <?= htmlspecialchars($id_candidat) ?></p>
    <p>Fonction ID: <?= htmlspecialchars($id_fonction) ?></p> -->
    <div class="form-container">
        <form method="POST" action="/enregistrer_entretien">
            <input type="hidden" name="id_candidat" value="<?= $id_candidat ?>">
            <input type="hidden" name="id_fonction" value="<?= $id_fonction ?>">
            <label for="date_entretien">Date de l'entretien :</label>
            <input type="date" name="date_entretien" required>
            <select name="note" id="note">
                <option value="5">bas</option>
                <option value="10">moyen</option>
                <option value="15">haut</option>
            </select>
            <label for="commentaire">Commentaire :</label>
            <textarea name="commentaire" rows="4"></textarea>
            <button type="submit">Enregistrer l'entretien</button>
        </form>
    </div>
    <a href="/annonces">Retour à l'accueil</a>
</body>
</html>