<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test QCM</title>
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
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            color: var(--dark-text);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .quiz-container {
            max-width: 800px;
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

        .quiz-header {
            background: linear-gradient(135deg, var(--primary-color), #4285f4);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .quiz-header h1 {
            margin: 0 0 1rem 0;
            font-weight: 600;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .progress-bar {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            height: 8px;
            margin: 1rem 0;
            overflow: hidden;
        }

        .progress-fill {
            background: #ffd700;
            height: 100%;
            border-radius: 10px;
            transition: width 0.3s ease;
            width: <?= (($current_index + 1) / $total_questions) * 100 ?>%;
        }

        .timer-container {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .timer {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .timer.warning {
            color: #ffd700;
            animation: pulse 1s infinite;
        }

        .timer.danger {
            color: #ff6b6b;
            animation: pulse 0.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .quiz-content {
            padding: 2rem;
        }

        .question-section {
            margin-bottom: 2rem;
        }

        .question-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-text);
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: var(--light-bg);
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }

        .choices-container {
            display: grid;
            gap: 1rem;
        }

        .choice-option {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .choice-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .choice-label {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .choice-label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, rgba(13, 110, 253, 0.1), transparent);
            transition: width 0.3s ease;
        }

        .choice-option:hover .choice-label {
            border-color: var(--primary-color);
            transform: translateX(5px);
        }

        .choice-option:hover .choice-label::before {
            width: 100%;
        }

        .choice-option input[type="radio"]:checked + .choice-label {
            border-color: var(--primary-color);
            background: rgba(13, 110, 253, 0.1);
            transform: translateX(5px);
        }

        .choice-option input[type="radio"]:checked + .choice-label::before {
            width: 100%;
        }

        .choice-indicator {
            width: 20px;
            height: 20px;
            border: 2px solid #dee2e6;
            border-radius: 50%;
            margin-right: 1rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .choice-option input[type="radio"]:checked + .choice-label .choice-indicator {
            border-color: var(--primary-color);
            background: var(--primary-color);
        }

        .choice-indicator::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.2s ease;
        }

        .choice-option input[type="radio"]:checked + .choice-label .choice-indicator::after {
            transform: translate(-50%, -50%) scale(1);
        }

        .choice-text {
            flex: 1;
            font-weight: 500;
        }

        .submit-button {
            background: linear-gradient(135deg, var(--success-color), #20c997);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            margin-top: 2rem;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(25, 135, 84, 0.3);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .function-id {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .question-counter {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .quiz-container {
                margin: 0;
                border-radius: 0;
                min-height: 100vh;
            }

            .quiz-header {
                padding: 1.5rem 1rem;
            }

            .quiz-header h1 {
                font-size: 1.5rem;
                flex-direction: column;
                gap: 0.25rem;
            }

            .timer-container {
                position: static;
                margin: 1rem auto 0;
                width: fit-content;
            }

            .function-id {
                position: static;
                margin: 0 auto 1rem;
                width: fit-content;
            }

            .quiz-content {
                padding: 1.5rem 1rem;
            }

            .choice-label {
                padding: 0.75rem 1rem;
            }
        }
    </style>
    <script>
        let timeLeft = <?= $question['duree_max'] ?? 60 ?>;
        let timer;
        const totalQuestions = <?= $total_questions ?>;
        const currentIndex = <?= $current_index ?> + 1;

        function updateTimerDisplay() {
            const timerElement = document.getElementById('timer');
            timerElement.innerText = timeLeft + 's';
            
            // Change timer color based on time left
            timerElement.classList.remove('warning', 'danger');
            if (timeLeft <= 10) {
                timerElement.classList.add('danger');
            } else if (timeLeft <= 30) {
                timerElement.classList.add('warning');
            }
        }

        function startTimer() {
            updateTimerDisplay();
            timer = setInterval(() => {
                timeLeft--;
                updateTimerDisplay();
                
                if (timeLeft <= 0) {
                    timeLeft = <?= $question['duree_max'] ?? 60 ?>;
                    clearInterval(timer);
                    document.getElementById('timeout').value = 'true';

                    let choices = document.getElementsByName('id_choix');
                    let incorrectChoice = null;

                    const incorrectChoices = [
                        <?php foreach ($question['choices'] as $choice): ?>
                            <?php if (!$choice['est_correct']): ?>
                                "<?= $choice['id'] ?>",
                            <?php endif; ?>
                        <?php endforeach; ?>
                    ];

                    if (incorrectChoices.length > 0) {
                        incorrectChoice = document.querySelector(`input[value="${incorrectChoices[0]}"]`);
                    }
                    if (!incorrectChoice && choices.length > 0) {
                        incorrectChoice = choices[0];
                    }

                    if (incorrectChoice) {
                        incorrectChoice.checked = true;
                    } else {
                        console.error('Aucun choix disponible');
                        return;
                    }

                    const formData = new FormData();
                    formData.append('id_question', document.querySelector('input[name="id_question"]').value);
                    formData.append('timeout', 'true');
                    formData.append('id_choix', incorrectChoice.value);

                    fetch('<?= $action ?>', {
                        method: 'POST',
                        body: formData,
                        redirect: 'follow'
                    }).then(response => {
                        if (response.redirected) {
                            window.location.href = response.url;
                        } else if (response.ok) {
                            return response.text().then(html => {
                                document.open();
                                document.write(html);
                                document.close();
                            });
                        } else {
                            console.error('Erreur lors de la soumission:', response.status);
                            window.location.href = '/annonces';
                        }
                    }).catch(error => {
                        console.error('Erreur réseau:', error);
                        window.location.href = '/annonces';
                    });
                }
            }, 1000);
        }

        function stopTimer() {
            clearInterval(timer);
        }
    </script>
</head>
<body onload="startTimer()">
    <div class="quiz-container">
        <div class="quiz-header">
            <div class="function-id">Fonction: <?= $_SESSION['id_fonction'] ?></div>
            <div class="timer-container">
                <i data-feather="clock" style="width: 16px; height: 16px;"></i>
                <span id="timer" class="timer"><?= $question['duree_max'] ?? 60 ?>s</span>
            </div>
            
            <h1>
                <i data-feather="help-circle" style="width: 28px; height: 28px;"></i>
                Test QCM
            </h1>
            
            <div class="question-counter">
                <i data-feather="list" style="width: 16px; height: 16px;"></i>
                Question <?= $current_index + 1 ?> sur <?= $total_questions ?>
            </div>
            
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>

        <div class="quiz-content">
            <div class="question-section">
                <div class="question-title">
                    <i data-feather="message-circle" style="width: 20px; height: 20px; margin-right: 8px; vertical-align: middle;"></i>
                    <?= htmlspecialchars($question['intitule'] ?? 'Question non définie') ?>
                </div>
            </div>

            <form id="form" method="POST" action="<?= $action ?>" onsubmit="stopTimer()">
                <input type="hidden" name="id_question" value="<?= $question['id'] ?>">
                <input type="hidden" id="timeout" name="timeout" value="false">

                <div class="choices-container">
                    <?php foreach ($question['choices'] as $index => $choice): ?>
                        <div class="choice-option">
                            <input type="radio" name="id_choix" value="<?= $choice['id'] ?>" id="choice_<?= $index ?>" required>
                            <label class="choice-label" for="choice_<?= $index ?>">
                                <div class="choice-indicator"></div>
                                <div class="choice-text">
                                    <?= htmlspecialchars($choice['texte'] ?? 'Choix non défini') ?>
                                    <?= htmlspecialchars($choice['est_correct'] ? ' (Correct)' : '') ?>
                                </div>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button type="submit" class="submit-button">
                    <i data-feather="check-circle" style="width: 20px; height: 20px;"></i>
                    Valider ma réponse
                </button>
            </form>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>