<?php
// File: app/views/rh/annonce_detail.php
session_start();
if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
    header('Location: /login');
    exit;
}

$title = "Détail de l'annonce";
$activeMenu = "recrutement";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Gestion RH</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Gestion d'entreprise</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/dashboard">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/recrutement">Recrutement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/recrutement/annonces">Annonces</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Détail de l'annonce</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">Connecté en tant que <?= isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']['nom_utilisateur'] : 'Utilisateur' ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $successMessage ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $errorMessage ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($annonce)): ?>
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Détails de l'annonce #<?= htmlspecialchars($annonce['id_annonce']) ?></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Poste recherché:</strong> <?= htmlspecialchars($annonce['poste_voulu']) ?></p>
                            <p><strong>Date de publication:</strong> <?= date('d/m/Y', strtotime($annonce['date_publication'] ?? date('Y-m-d'))) ?></p>
                            <p><strong>Date limite de dépôt:</strong> <?= date('d/m/Y', strtotime($annonce['date_depot_limite'])) ?></p>
                            <p>
                                <strong>Statut:</strong> 
                                <?php if (strtotime($annonce['date_depot_limite']) < time()): ?>
                                    <span class="badge bg-danger">Clôturée</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Active</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des critères pour cette annonce -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-info text-white">
                    <h5 class="card-title mb-0">Critères de sélection</h5>
                    <a href="/rh/recrutement/annonces/<?= $annonce['id_annonce'] ?>/criteres/ajouter" class="btn btn-sm btn-light">Ajouter un critère</a>
                </div>
                <div class="card-body">
                    <?php if (isset($criteres) && !empty($criteres)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Critère</th>
                                        <th>Coefficient</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($criteres as $critere): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($critere['nom_critere']) ?></td>
                                            <td><?= htmlspecialchars($critere['coefficient']) ?></td>
                                            <td>
                                                <a href="/rh/recrutement/criteres/<?= $critere['id_critere'] ?>/modifier" class="btn btn-sm btn-warning">Modifier</a>
                                                <a href="/rh/recrutement/criteres/<?= $critere['id_critere'] ?>/supprimer" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce critère ?')">Supprimer</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Aucun critère défini pour cette annonce.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Liste des candidatures pour cette annonce -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-success text-white">
                    <h5 class="card-title mb-0">Candidatures reçues</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($candidatures) && !empty($candidatures)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nom du candidat</th>
                                        <th>Date de candidature</th>
                                        <th>Score</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($candidatures as $candidature): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($candidature['nom_candidat']) ?></td>
                                            <td><?= date('d/m/Y', strtotime($candidature['date_candidature'])) ?></td>
                                            <td><?= isset($candidature['score']) ? $candidature['score'] : 'Non évalué' ?></td>
                                            <td>
                                                <a href="/rh/recrutement/candidatures/<?= $candidature['id_candidature'] ?>" class="btn btn-sm btn-info">Voir</a>
                                                <a href="/rh/recrutement/candidatures/<?= $candidature['id_candidature'] ?>/evaluer" class="btn btn-sm btn-primary">Évaluer</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Aucune candidature reçue pour cette annonce.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                Annonce non trouvée.
            </div>
        <?php endif; ?>
        
        <div class="mt-4">
            <a href="/rh/recrutement/annonces" class="btn btn-secondary">Retour à la liste des annonces</a>
        </div>
    </div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>