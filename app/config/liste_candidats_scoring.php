<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Candidats avec Score</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .candidat-box { border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
        .score-info { color: #28a745; font-weight: bold; }
        .action-button { padding: 8px 15px; margin: 5px; background-color: #6c757d; color: white; border: none; border-radius: 5px; cursor: not-allowed; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des Candidats avec Score pour la Fonction ID: <?= htmlspecialchars($id_fonction) ?></h1>
        <?php if (empty($candidats)): ?>
            <p>Aucun candidat avec un score trouvé.</p>
        <?php else: ?>
            <?php foreach ($candidats as $candidat): ?>
                <div class="candidat-box">
                    <p><strong>ID:</strong> <?= htmlspecialchars($candidat['id_candidat']) ?></p>
                    <p><strong>Nom:</strong> <?= htmlspecialchars($candidat['nom']) ?></p>
                    <p><strong>Prénom:</strong> <?= htmlspecialchars($candidat['prenom']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($candidat['mail']) ?></p>
                    <p class="score-info">
                        Score total: <?= $candidat['score_total'] == -1 ? 'Non évalué' : htmlspecialchars($candidat['score_total']) ?><br>
                        Décision: <?= htmlspecialchars($candidat['decision']) ?>
                    </p>
                    <button class="action-button" disabled>Action</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <a href="/annonces">Retour à l'accueil</a>
    </div>
</body>
</html>