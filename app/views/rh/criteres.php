<?php 
// Vérifie si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'rh') {
    header('Location: /login');
    exit;
}

$title = "Définition des critères";
$activeMenu = "recrutement";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Gestion RH</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/../nav.php'; ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Définition des critères pour l'annonce</h4>
                    </div>
                    <div class="card-body">
                        <!-- Formulaire pour ajouter des critères -->
                        <form action="/recrutement/criteres/ajouter" method="post">
                            <input type="hidden" name="annonce_id" value="<?= isset($_GET['annonce_id']) ? $_GET['annonce_id'] : '' ?>">
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="poste_voulu" class="form-label">Poste voulu</label>
                                    <input type="text" class="form-control" id="poste_voulu" name="poste_voulu" required>
                                    <small class="text-muted">Ce nom sera enregistré dans la table poste</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="date_limite" class="form-label">Date limite de dépôt</label>
                                    <input type="date" class="form-control" id="date_limite" name="date_limite" required>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Critères de sélection</h5>
                            <div id="criteres-container">
                                <div class="critere-item mb-3 border p-3 rounded">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="critere_nom_1" class="form-label">Nom du critère</label>
                                            <input type="text" class="form-control" id="critere_nom_1" name="criteres[1][nom]" placeholder="Ex: Expérience, Diplôme, Langue" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="critere_valeur_1" class="form-label">Valeur requise</label>
                                            <input type="text" class="form-control" id="critere_valeur_1" name="criteres[1][valeur]" placeholder="Ex: 5 ans, Master, Français courant" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="critere_coef_1" class="form-label">Coefficient</label>
                                            <input type="number" class="form-control" id="critere_coef_1" name="criteres[1][coefficient]" min="1" max="10" value="1" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="button" id="ajouter-critere" class="btn btn-outline-secondary">
                                    <i class="bi bi-plus-circle"></i> Ajouter un critère
                                </button>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="/recrutement/annonces" class="btn btn-secondary">Retour aux annonces</a>
                                <button type="submit" class="btn btn-primary">Enregistrer les critères</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ajouter un nouveau critère
            let critereCount = 1;
            const container = document.getElementById('criteres-container');
            const btnAjouter = document.getElementById('ajouter-critere');

            btnAjouter.addEventListener('click', function() {
                critereCount++;
                const nouvelleLigne = document.createElement('div');
                nouvelleLigne.className = 'critere-item mb-3 border p-3 rounded';
                nouvelleLigne.innerHTML = `
                    <div class="row">
                        <div class="col-md-5">
                            <label for="critere_nom_${critereCount}" class="form-label">Nom du critère</label>
                            <input type="text" class="form-control" id="critere_nom_${critereCount}" name="criteres[${critereCount}][nom]" placeholder="Ex: Expérience, Diplôme, Langue" required>
                        </div>
                        <div class="col-md-5">
                            <label for="critere_valeur_${critereCount}" class="form-label">Valeur requise</label>
                            <input type="text" class="form-control" id="critere_valeur_${critereCount}" name="criteres[${critereCount}][valeur]" placeholder="Ex: 5 ans, Master, Français courant" required>
                        </div>
                        <div class="col-md-2">
                            <label for="critere_coef_${critereCount}" class="form-label">Coefficient</label>
                            <input type="number" class="form-control" id="critere_coef_${critereCount}" name="criteres[${critereCount}][coefficient]" min="1" max="10" value="1" required>
                        </div>
                    </div>
                    <div class="text-end mt-2">
                        <button type="button" class="btn btn-sm btn-outline-danger supprimer-critere">Supprimer</button>
                    </div>
                `;
                container.appendChild(nouvelleLigne);

                // Ajouter l'écouteur d'événement pour supprimer
                nouvelleLigne.querySelector('.supprimer-critere').addEventListener('click', function() {
                    container.removeChild(nouvelleLigne);
                });
            });
        });
    </script>
</body>
</html>