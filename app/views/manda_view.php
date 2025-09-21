<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test QCM</title>
<script>
    let timeLeft = <?= $question['duree_max'] ?? 60 ?>;
    let timer;
    const totalQuestions = <?= $total_questions ?>;
    const currentIndex = <?= $current_index ?> + 1;

    function startTimer() {
        timer = setInterval(() => {
            timeLeft--;
            document.getElementById('timer').innerText = timeLeft + 's';
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
                    redirect: 'follow' // Suivre automatiquement les redirections
                }).then(response => {
                    if (response.redirected) {
                        // Suivre la redirection fournie par le serveur
                        window.location.href = response.url;
                    } else if (response.ok) {
                        // Attendre la réponse du serveur (contenu HTML de la question suivante)
                        return response.text().then(html => {
                            // Remplacer le contenu de la page avec la nouvelle question
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
    <h1><?=$_SESSION['id_fonction'] ?>Test QCM - Question <?= $current_index + 1 ?> / <?= $total_questions ?></h1>
    <p><strong>Question :</strong> <?= htmlspecialchars($question['intitule'] ?? 'Question non définie') ?></p>
    <p><strong>Temps restant :</strong> <span id="timer"><?= $question['duree_max'] ?? 60 ?>s</span></p>

    <form id="form" method="POST" action="<?= $action ?>" onsubmit="stopTimer()">
        <input type="hidden" name="id_question" value="<?= $question['id'] ?>">
        <input type="hidden" id="timeout" name="timeout" value="false">

        <?php foreach ($question['choices'] as $choice): ?>
            <label>
                <input type="radio" name="id_choix" value="<?= $choice['id'] ?>" required>
                <?= htmlspecialchars($choice['est_correct'] ?? 'Choix non défini') ?>
            </label><br>
        <?php endforeach; ?>

        <button type="submit">Valider</button>
    </form>
</body>
</html>