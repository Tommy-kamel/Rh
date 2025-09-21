<?php
// File: app/views/rh/annonces.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des annonces - Recrutement</title>
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
                        <a class="nav-link active" href="#">Gestion des annonces</a>
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
        <h1 class="mb-4">Gestion des annonces</h1>
        
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Créer une nouvelle annonce</h5>
                    </div>
                    <div class="card-body">
                        <form action="/rh/recrutement/annonces/ajouter" method="post" id="annonceForm">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="poste_voulu" class="form-label">Intitulé du poste</label>
                                    <input type="text" class="form-control" id="poste_voulu" name="poste_voulu" required>
                                    <div class="form-text">Ce nom sera également utilisé pour créer un nouveau poste.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="date_depot_limite" class="form-label">Date limite de dépôt</label>
                                    <input type="date" class="form-control" id="date_depot_limite" name="date_depot_limite" required>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Créer l'annonce et définir les critères</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Liste des annonces existantes -->
        <h2 class="mb-3">Annonces existantes</h2>
        
        <?php if (isset($annonces) && !empty($annonces)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Poste</th>
                            <th>Date limite</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($annonces as $annonce): ?>
                            <tr>
                                <td><?= $annonce['id_annonce'] ?></td>
                                <td><?= $annonce['poste_voulu'] ?></td>
                                <td><?= date('d/m/Y', strtotime($annonce['date_depot_limite'])) ?></td>
                                <td>
                                    <a href="/rh/recrutement/annonces/modifier/<?= $annonce['id_annonce'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="/rh/recrutement/annonces/supprimer/<?= $annonce['id_annonce'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">Supprimer</a>
                                    <a href="/rh/recrutement/annonces/voir/<?= $annonce['id_annonce'] ?>" class="btn btn-sm btn-info">Voir les détails</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                Aucune annonce n'a été créée pour le moment.
            </div>
        <?php endif; ?>
    </div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>