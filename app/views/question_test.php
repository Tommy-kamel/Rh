<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Questions - RH</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --primary-color: #0d6efd;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #0dcaf0;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            color: var(--dark-text);
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color), #4285f4);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .header h1 {
            margin: 0 0 1rem 0;
            font-weight: 600;
            font-size: 2rem;
        }

        .header p {
            margin: 0.5rem 0;
            opacity: 0.9;
        }

        .header a {
            color: #ffd700;
            text-decoration: none;
            font-weight: 500;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .header a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .content {
            padding: 2rem;
        }

        .add-question-btn {
            background: linear-gradient(135deg, var(--success-color), #20c997);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .add-question-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(25, 135, 84, 0.3);
        }

        .question-box {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin: 1.5rem 0;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s ease;
        }

        .question-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .question-header {
            border-bottom: 2px solid var(--light-bg);
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .question-id {
            background: var(--primary-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .question-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0.5rem 0;
            color: var(--dark-text);
        }

        .question-duration {
            color: #6c757d;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .choices-list {
            list-style: none;
            padding: 0;
            margin: 1rem 0;
        }

        .choices-list li {
            background: var(--light-bg);
            padding: 0.75rem;
            margin: 0.5rem 0;
            border-radius: 8px;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
        }

        .choices-list li:hover {
            background: #e9ecef;
        }

        .choices-list li.correct {
            border-left-color: var(--success-color);
            background: rgba(25, 135, 84, 0.1);
        }

        .choices-list li.incorrect {
            border-left-color: var(--danger-color);
            background: rgba(220, 53, 69, 0.1);
        }

        .choice-status {
            float: right;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .choice-status.correct {
            background: var(--success-color);
            color: white;
        }

        .choice-status.incorrect {
            background: var(--danger-color);
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .action-button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .edit-button {
            background: var(--info-color);
            color: white;
        }

        .edit-button:hover {
            background: #0bb4d1;
            transform: translateY(-1px);
        }

        .delete-button {
            background: var(--danger-color);
            color: white;
        }

        .delete-button:hover {
            background: #bb2d3b;
            transform: translateY(-1px);
        }

        .form-container {
            background: var(--light-bg);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            margin: 1rem 0;
            border: 1px solid #dee2e6;
        }

        .form-container h2,
        .form-container h3 {
            color: var(--dark-text);
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-text);
        }

        input, textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.9rem;
            transition: border-color 0.3s ease;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .choice-input {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            padding: 0.75rem;
            background: white;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .choice-input input[type="text"] {
            flex: 1;
            margin: 0;
        }

        .choice-input label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
            white-space: nowrap;
        }

        .choice-input input[type="checkbox"] {
            width: auto;
            margin: 0;
        }

        .add-choice {
            background: var(--success-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            margin: 0.5rem 0;
            transition: background-color 0.3s ease;
        }

        .add-choice:hover {
            background: #157347;
        }

        .submit-button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }

        .submit-button:hover {
            background: #0b5ed7;
            transform: translateY(-1px);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            padding: 0.75rem 1rem;
            border: 2px solid var(--primary-color);
            border-radius: 8px;
            margin-top: 2rem;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-1px);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            text-align: center;
            box-shadow: var(--box-shadow);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        @media (max-width: 768px) {
            .container {
                margin: 0;
                border-radius: 0;
            }
            
            .choice-input {
                flex-direction: column;
                align-items: stretch;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
    <script>
        function addChoice(containerId) {
            const container = document.getElementById(containerId);
            const div = document.createElement('div');
            div.className = 'choice-input';
            div.innerHTML = `
                <input type="text" name="choix_texte[]" placeholder="Texte du choix" required>
                <label><input type="checkbox" name="choix_correct[]"> Correct</label>
                <button type="button" class="delete-button" onclick="this.parentElement.remove()">
                    <i data-feather="trash-2" style="width: 16px; height: 16px;"></i>
                    Supprimer
                </button>
            `;
            container.appendChild(div);
            feather.replace();
        }

        function toggleEditForm(questionId) {
            const form = document.getElementById('edit-form-' + questionId);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function toggleAddForm() {
            const form = document.getElementById('add-question-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i data-feather="help-circle" style="width: 32px; height: 32px; margin-right: 10px;"></i>Gestion des Questions</h1>
            <p>Fonction ID: <?= htmlspecialchars($id_fonction) ?></p>
            <div class="stats-grid">
                <div>
                    <div style="font-size: 1.2rem; font-weight: 600;">Test QCM</div>
                    <div><?= $pourcentage_test * 100 ?>%</div>
                </div>
                <div>
                    <div style="font-size: 1.2rem; font-weight: 600;">Entretien</div>
                    <div><?= $pourcentage_entretien * 100 ?>% <a href="modifier_pourcentages">modifier</a></div>
                </div>
            </div>
        </div>

        <div class="content">
            <button class="add-question-btn" onclick="toggleAddForm()">
                <i data-feather="plus" style="width: 20px; height: 20px;"></i>
                Ajouter une Question
            </button>
            
            <div id="add-question-form" class="form-container" style="display: none;">
                <h2><i data-feather="edit-3" style="width: 24px; height: 24px; margin-right: 8px;"></i>Nouvelle Question</h2>
                <form method="POST" action="/question_test/add">
                    <input type="hidden" name="id_fonction" value="<?= $id_fonction ?>">
                    <div class="form-group">
                        <label>Intitulé :</label>
                        <textarea name="intitule" required placeholder="Saisissez votre question..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Durée max (secondes) :</label>
                        <input type="number" name="duree_max" min="1" required placeholder="60">
                    </div>
                    <h3><i data-feather="list" style="width: 20px; height: 20px; margin-right: 8px;"></i>Choix</h3>
                    <div id="choices-container">
                        <?php for ($i = 0; $i < 4; $i++): ?>
                            <div class="choice-input">
                                <input type="text" name="choix_texte[]" placeholder="Texte du choix" required>
                                <label><input type="checkbox" name="choix_correct[]"> Correct</label>
                                <button type="button" class="delete-button" onclick="this.parentElement.remove()">
                                    <i data-feather="trash-2" style="width: 16px; height: 16px;"></i>
                                    Supprimer
                                </button>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <button type="button" class="add-choice" onclick="addChoice('choices-container')">
                        <i data-feather="plus" style="width: 16px; height: 16px; margin-right: 5px;"></i>
                        Ajouter un choix
                    </button>
                    <button type="submit" class="submit-button">
                        <i data-feather="save" style="width: 16px; height: 16px; margin-right: 5px;"></i>
                        Enregistrer
                    </button>
                </form>
            </div>

            <h2><i data-feather="list" style="width: 24px; height: 24px; margin-right: 8px;"></i>Liste des Questions</h2>
            
            <?php if (empty($questions)): ?>
                <div style="text-align: center; padding: 3rem; color: #6c757d;">
                    <i data-feather="inbox" style="width: 48px; height: 48px; margin-bottom: 1rem;"></i>
                    <h3>Aucune question trouvée</h3>
                    <p>Commencez par ajouter votre première question.</p>
                </div>
            <?php else: ?>
                <?php foreach ($questions as $question): ?>
                    <div class="question-box">
                        <div class="question-header">
                            <div class="question-id">Question #<?= htmlspecialchars($question['id']) ?></div>
                            <div class="question-title"><?= htmlspecialchars($question['intitule']) ?></div>
                            <div class="question-duration">
                                <i data-feather="clock" style="width: 16px; height: 16px;"></i>
                                Durée max: <?= htmlspecialchars($question['duree_max']) ?> secondes
                            </div>
                        </div>
                        
                        <h3><i data-feather="check-square" style="width: 20px; height: 20px; margin-right: 8px;"></i>Choix:</h3>
                        <ul class="choices-list">
                            <?php foreach ($question['choices'] as $choice): ?>
                                <li class="<?= $choice['est_correct'] ? 'correct' : 'incorrect' ?>">
                                    <?= htmlspecialchars($choice['texte']) ?>
                                    <span class="choice-status <?= $choice['est_correct'] ? 'correct' : 'incorrect' ?>">
                                        <?= $choice['est_correct'] ? 'Correct' : 'Incorrect' ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <div class="action-buttons">
                            <button class="action-button edit-button" onclick="toggleEditForm(<?= $question['id'] ?>)">
                                <i data-feather="edit" style="width: 16px; height: 16px;"></i>
                                Modifier
                            </button>
                            <form method="POST" action="/question_test/delete/<?= $question['id'] ?>" style="display: inline;">
                                <button type="submit" class="action-button delete-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?')">
                                    <i data-feather="trash-2" style="width: 16px; height: 16px;"></i>
                                    Supprimer
                                </button>
                            </form>
                        </div>

                        <div id="edit-form-<?= $question['id'] ?>" class="form-container" style="display: none;">
                            <h3><i data-feather="edit-3" style="width: 20px; height: 20px; margin-right: 8px;"></i>Modifier la Question</h3>
                            <form method="POST" action="/question_test/update/<?= $question['id'] ?>">
                                <input type="hidden" name="id_fonction" value="<?= $id_fonction ?>">
                                <div class="form-group">
                                    <label>Intitulé :</label>
                                    <textarea name="intitule" required><?= htmlspecialchars($question['intitule']) ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Durée max (secondes) :</label>
                                    <input type="number" name="duree_max" min="1" value="<?= htmlspecialchars($question['duree_max']) ?>" required>
                                </div>
                                <h3><i data-feather="list" style="width: 20px; height: 20px; margin-right: 8px;"></i>Choix</h3>
                                <div id="edit-choices-<?= $question['id'] ?>">
                                    <?php foreach ($question['choices'] as $choice): ?>
                                        <div class="choice-input">
                                            <input type="hidden" name="choix_id[]" value="<?= $choice['id'] ?>">
                                            <input type="text" name="choix_texte[]" value="<?= htmlspecialchars($choice['texte']) ?>" required>
                                            <label><input type="checkbox" name="choix_correct[]" <?= $choice['est_correct'] ? 'checked' : '' ?>> Correct</label>
                                            <button type="button" class="delete-button" onclick="this.parentElement.remove()">
                                                <i data-feather="trash-2" style="width: 16px; height: 16px;"></i>
                                                Supprimer
                                            </button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="add-choice" onclick="addChoice('edit-choices-<?= $question['id'] ?>')">
                                    <i data-feather="plus" style="width: 16px; height: 16px; margin-right: 5px;"></i>
                                    Ajouter un choix
                                </button>
                                <button type="submit" class="submit-button">
                                    <i data-feather="save" style="width: 16px; height: 16px; margin-right: 5px;"></i>
                                    Enregistrer
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <a href="/annonces" class="back-link">
                <i data-feather="arrow-left" style="width: 16px; height: 16px;"></i>
                Retour à l'accueil
            </a>
        </div>
    </div>
    
    <script>
        feather.replace();
    </script>
</body>
</html>