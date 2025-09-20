<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Candidats</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .candidat-box { border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
        .action-button { padding: 8px 15px; margin: 5px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .action-button:hover { background-color: #0056b3; }
        .score-info { color: #28a745; font-weight: bold; }
        .filter-container { margin-bottom: 20px; }
        .filter-container input, .filter-container select { margin: 5px; padding: 5px; width: 150px; }
        .search-container { margin-bottom: 10px; }
        .search-container input { width: 300px; padding: 5px; }
        .entretien-container { display: flex; align-items: center; }
        .entretien-container select { margin-right: 10px; }
    </style>
    <script>
        function setFonctionAndRedirect(id_fonction, id_candidat) {
            fetch('/set_fonction', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id_fonction=' + encodeURIComponent(id_fonction)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/entretien/' + id_candidat;
                } else {
                    alert('Erreur lors de la définition de la fonction : ' + (data.error || 'Erreur inconnue'));
                }
            })
            .catch(error => {
                alert('Erreur : ' + error.message);
            });
        }

        function applyFilters() {
            const nom = document.getElementById('filter-nom').value.toLowerCase();
            const prenom = document.getElementById('filter-prenom').value.toLowerCase();
            const mail = document.getElementById('filter-mail').value.toLowerCase();
            const search = document.getElementById('search').value.toLowerCase();
            const candidats = document.querySelectorAll('.candidat-box');
            
            candidats.forEach(candidat => {
                const nomText = candidat.querySelector('.nom').textContent.toLowerCase();
                const prenomText = candidat.querySelector('.prenom').textContent.toLowerCase();
                const mailText = candidat.querySelector('.mail').textContent.toLowerCase();
                
                const matchesSearch = !search || nomText.includes(search) || prenomText.includes(search) || mailText.includes(search);
                const matchesNom = !nom || nomText.includes(nom);
                const matchesPrenom = !prenom || prenomText.includes(prenom);
                const matchesMail = !mail || mailText.includes(mail);
                
                if (matchesSearch && matchesNom && matchesPrenom && matchesMail) {
                    candidat.style.display = '';
                } else {
                    candidat.style.display = 'none';
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Liste des Candidats</h1>
        <!-- <div class="search-container">
            <input type="text" id="search" placeholder="Recherche globale..." oninput="applyFilters()">
        </div>
        <div class="filter-container">
            <input type="text" id="filter-nom" placeholder="Filtrer par nom" oninput="applyFilters()">
            <input type="text" id="filter-prenom" placeholder="Filtrer par prénom" oninput="applyFilters()">
            <input type="text" id="filter-mail" placeholder="Filtrer par email" oninput="applyFilters()">
        </div> -->
        <?php if (empty($candidats)): ?>
            <p>Aucun candidat trouvé.</p>
        <?php else: ?>
            <?php foreach ($candidats as $candidat): ?>
                <div class="candidat-box">
                    <p><strong>ID:</strong> <?= htmlspecialchars($candidat['id_candidat']) ?></p>
                    <p><strong>Nom:</strong> <span class="nom"><?= htmlspecialchars($candidat['nom']) ?></span></p>
                    <p><strong>Prénom:</strong> <span class="prenom"><?= htmlspecialchars($candidat['prenom']) ?></span></p>
                    <p><strong>Email:</strong> <span class="mail"><?= htmlspecialchars($candidat['mail']) ?></span></p>
                    Score total: <?php echo $candidat['score_total'] == -1 ? 'Non évalué' : htmlspecialchars($candidat['score_total']); ?><br>
                    <?php if ($candidat['has_entretien']): ?>
                        Décision: <?= $candidat['decision'] ?>
                        <p class="">
                        </p>
                    <?php else: ?>
                        <div class="entretien-container">
                            <!-- <select onchange="this.nextElementSibling.disabled = !this.value">
                                <option value="">Choisir une fonction</option>
                                <?php foreach ($fonctions as $fonction): ?>
                                    <option value="<?= $fonction['id_fonction'] ?>">
                                        <?= htmlspecialchars($fonction['nom_fonction']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select> -->
                            <!-- <button class="action-button" disabled onclick="setFonctionAndRedirect(this.previousElementSibling.value, <?= $candidat['id_candidat'] ?>)">
                                entretien
                            </button> -->
                            <a href="/entretien/<?= $candidat['id_candidat'] ?>">entretien</a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
        <a href="/annonces">Retour à l'accueil</a>
    </div>
</body>
</html>