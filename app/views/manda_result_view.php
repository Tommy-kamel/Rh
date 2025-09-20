<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat QCM</title>
</head>
<body>
    <h1>Résultat du Test QCM</h1>
    <p>Votre score : <?= $score ?> / 20</p>
    <?php if ($score >= 12): ?>
        <p>en attente de planification d entretient</p>
    <?php else: ?>
        <p>vous n avez pas eu la moyenne</p>
    <?php endif; ?>
</body>
</html>