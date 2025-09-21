<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Fonctions</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .fonction-box { border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
        .action-button { padding: 8px 15px; margin: 5px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .action-button:hover { background-color: #0056b3; }
        .entretien-button { background-color: #28a745; }
        .entretien-button:hover { background-color: #218838; }
    </style>
    <script>
        function setFonctionAndRedirect(id_fonction, url) {
            fetch('/set_fonction', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id_fonction=' + encodeURIComponent(id_fonction)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = url;
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
    <div class="container">
        <h1>Liste des Fonctions</h1>
        <?php foreach ($fonctions as $fonction): ?>
            <div class="fonction-box">
                <p><strong>ID:</strong> <?= htmlspecialchars($fonction['id_fonction']) ?></p>
                <p><strong>Nom:</strong> <?= htmlspecialchars($fonction['nom_fonction']) ?></p>
                <button class="action-button" onclick="setFonctionAndRedirect(<?= $fonction['id_fonction'] ?>, '/question_test')">Modifier les Questions</button>
                <button class="entretien-button" onclick="setFonctionAndRedirect(<?= $fonction['id_fonction'] ?>, '/liste_candidat')">voir la liste des candidats</button>
                <button class="action-button" onclick="setFonctionAndRedirect(<?= $fonction['id_fonction'] ?>, '/liste_candidats_scoring')">voir la liste qui ont passer l entretien</button>
            </div>
        <?php endforeach; ?>
        <a href="/annonces">Retour à l'accueil</a>
    </div>
</body>
</html>