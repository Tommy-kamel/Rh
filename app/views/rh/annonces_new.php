<?php 
// Vérifie si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
    header('Location: /login');
    exit;
}

$title = "Gestion des annonces";
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
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Gestion des annonces</h4>
                        <a href="/recrutement" class="btn btn-light btn-sm">Retour au menu</a>
                    </div>
                    <div class="card-body">
                        <!-- Affichage des messages d'erreur ou de succès -->
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger"><?= $_GET['error'] ?></div>
                        <?php endif; ?>
                        <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success"><?= $_GET['success'] ?></div>
                        <?php endif; ?>

                        <!-- Formulaire pour ajouter une nouvelle annonce -->
                        <div class="mb-4">
                            <h5>Créer une nouvelle annonce</h5>
                            <form action="/recrutement/annonces/ajouter" method="post" class="border rounded p-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="poste_voulu" class="form-label">Poste voulu</label>
                                        <input type="text" class="form-control" id="poste_voulu" name="poste_voulu" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="date_depot_limite" class="form-label">Date limite de dépôt</label>
                                        <input type="date" class="form-control" id="date_depot_limite" name="date_depot_limite" required>
                                    </div>
                                </div>
                                
                                <h6 class="mt-3">Critères</h6>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="age_min" class="form-label">Âge minimum</label>
                                        <input type="number" class="form-control" id="age_min" name="age_min" min="18" max="65">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="age_max" class="form-label">Âge maximum</label>
                                        <input type="number" class="form-control" id="age_max" name="age_max" min="18" max="65">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="sexe" class="form-label">Sexe</label>
                                        <select class="form-select" id="sexe" name="sexe">
                                            <option value="">Indifférent</option>
                                            <option value="Homme">Homme</option>
                                            <option value="Femme">Femme</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="experience" class="form-label">Expérience (années)</label>
                                        <input type="number" class="form-control" id="experience" name="experience" min="0" max="30">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="diplome_requis" class="form-label">Diplôme requis</label>
                                        <input type="text" class="form-control" id="diplome_requis" name="diplome_requis">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="langues_maitrisees" class="form-label">Langues maîtrisées</label>
                                        <input type="text" class="form-control" id="langues_maitrisees" name="langues_maitrisees">
                                    </div>
                                </div>
                                
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary">Créer l'annonce</button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Liste des annonces existantes -->
                        <h5>Annonces existantes</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Poste</th>
                                        <th>Date limite</th>
                                        <th>Critères</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($annonces) && !empty($annonces)): ?>
                                        <?php foreach ($annonces as $annonce): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($annonce['poste_voulu']) ?></td>
                                                <td><?= (new DateTime($annonce['date_depot_limite']))->format('d/m/Y') ?></td>
                                                <td>
                                                    <ul class="mb-0 ps-3">
                                                        <?php if (!empty($annonce['age_min'])): ?>
                                                            <li>Âge: <?= $annonce['age_min'] ?> - <?= $annonce['age_max'] ?> ans</li>
                                                        <?php endif; ?>
                                                        <?php if (!empty($annonce['sexe'])): ?>
                                                            <li>Sexe: <?= htmlspecialchars($annonce['sexe']) ?></li>
                                                        <?php endif; ?>
                                                        <?php if (!empty($annonce['experience'])): ?>
                                                            <li>Expérience: <?= $annonce['experience'] ?> ans</li>
                                                        <?php endif; ?>
                                                        <?php if (!empty($annonce['diplome_requis'])): ?>
                                                            <li>Diplôme: <?= htmlspecialchars($annonce['diplome_requis']) ?></li>
                                                        <?php endif; ?>
                                                        <?php if (!empty($annonce['langues_maitrisees'])): ?>
                                                            <li>Langues: <?= htmlspecialchars($annonce['langues_maitrisees']) ?></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <a href="/recrutement/annonces/detail?id=<?= $annonce['id_annonce'] ?>" class="btn btn-sm btn-info">Détails</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Aucune annonce disponible</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>