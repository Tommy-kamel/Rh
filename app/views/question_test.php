<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Questions</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .question-box { border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
        .choices-list { margin-left: 20px; }
        .form-container { margin-top: 20px; }
        input, textarea { width: 100%; margin: 5px 0; padding: 5px; }
        button, .action-button { padding: 8px 15px; margin: 5px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover, .action-button:hover { background-color: #0056b3; }
        .delete-button { background-color: #dc3545; }
        .delete-button:hover { background-color: #c82333; }
        .add-choice { background-color: #28a745; }
        .add-choice:hover { background-color: #218838; }
        .choice-input { display: flex; align-items: center; margin-bottom: 5px; }
        .choice-input input[type="text"] { flex-grow: 1; margin-right: 10px; }
    </style>
    <script>
        function addChoice(containerId) {
            const container = document.getElementById(containerId);
            const div = document.createElement('div');
            div.className = 'choice-input';
            div.innerHTML = `
                <input type="text" name="choix_texte[]" placeholder="Texte du choix" required>
                <label><input type="checkbox" name="choix_correct[]"> Correct</label>
                <button type="button" class="delete-button" onclick="this.parentElement.remove()">Supprimer</button>
            `;
            container.appendChild(div);
        }

        function toggleEditForm(questionId) {
            const form = document.getElementById('edit-form-' + questionId);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Gestion des Questions pour la Fonction ID: <?= htmlspecialchars($id_fonction) ?></h1>
        <p>le pourcentage du test QCM dans le systeme de scoring est <?=$pourcentage_test * 100 ?>%</p>
        <p>le pourcentage de l entretien dans le systeme de scoring est <?=$pourcentage_entretien * 100 ?>% <a href="modifier_pourcentages">modifier</a></p>

        <button onclick="document.getElementById('add-question-form').style.display='block'">Ajouter une Question</button>
        
        <div id="add-question-form" class="form-container" style="display: none;">
            <h2>Nouvelle Question</h2>
            <form method="POST" action="/question_test/add">
                <input type="hidden" name="id_fonction" value="<?= $id_fonction ?>">
                <label>Intitulé :</label>
                <textarea name="intitule" required></textarea>
                <label>Durée max (secondes) :</label>
                <input type="number" name="duree_max" min="1" required>
                <h3>Choix</h3>
                <div id="choices-container">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <div class="choice-input">
                            <input type="text" name="choix_texte[]" placeholder="Texte du choix" required>
                            <label><input type="checkbox" name="choix_correct[]"> Correct</label>
                            <button type="button" class="delete-button" onclick="this.parentElement.remove()">Supprimer</button>
                        </div>
                    <?php endfor; ?>
                </div>
                <button type="button" class="add-choice" onclick="addChoice('choices-container')">Ajouter un choix</button>
                <button type="submit">Enregistrer</button>
            </form>
        </div>

        <h2>Liste des Questions</h2>
        <?php foreach ($questions as $question): ?>
            <div class="question-box">
                <p><strong>ID:</strong> <?= htmlspecialchars($question['id']) ?></p>
                <p><strong>Intitulé:</strong> <?= htmlspecialchars($question['intitule']) ?></p>
                <p><strong>Durée max:</strong> <?= htmlspecialchars($question['duree_max']) ?> secondes</p>
                <h3>Choix:</h3>
                <ul class="choices-list">
                    <?php foreach ($question['choices'] as $choice): ?>
                        <li>
                            <?= htmlspecialchars($choice['texte']) ?>
                            (<?= $choice['est_correct'] ? 'Correct' : 'Incorrect' ?>)
                        </li>
                    <?php endforeach; ?>
                </ul>
                <button class="action-button" onclick="toggleEditForm(<?= $question['id'] ?>)">Modifier</button>
                <form method="POST" action="/question_test/delete/<?= $question['id'] ?>" style="display: inline;">
                    <button type="submit" class="delete-button">Supprimer</button>
                </form>

                <div id="edit-form-<?= $question['id'] ?>" class="form-container" style="display: none;">
                    <h3>Modifier la Question</h3>
                    <form method="POST" action="/question_test/update/<?= $question['id'] ?>">
                        <input type="hidden" name="id_fonction" value="<?= $id_fonction ?>">
                        <label>Intitulé :</label>
                        <textarea name="intitule" required><?= htmlspecialchars($question['intitule']) ?></textarea>
                        <label>Durée max (secondes) :</label>
                        <input type="number" name="duree_max" min="1" value="<?= htmlspecialchars($question['duree_max']) ?>" required>
                        <h3>Choix</h3>
                        <div id="edit-choices-<?= $question['id'] ?>">
                            <?php foreach ($question['choices'] as $choice): ?>
                                <div class="choice-input">
                                    <input type="hidden" name="choix_id[]" value="<?= $choice['id'] ?>">
                                    <input type="text" name="choix_texte[]" value="<?= htmlspecialchars($choice['texte']) ?>" required>
                                    <label><input type="checkbox" name="choix_correct[]" <?= $choice['est_correct'] ? 'checked' : '' ?>> Correct</label>
                                    <button type="button" class="delete-button" onclick="this.parentElement.remove()">Supprimer</button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="add-choice" onclick="addChoice('edit-choices-<?= $question['id'] ?>')">Ajouter un choix</button>
                        <button type="submit">Enregistrer</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        <a href="/annonces">Retour à l'accueil</a>
    </div>
</body>
</html>