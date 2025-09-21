<?php
// File: app/views/rh/annonce_form.php
session_start();
if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
    header('Location: /login');
    exit;
}

$title = "Nouvelle annonce";
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
                        <a class="nav-link active" href="#">Nouvelle annonce</a>
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
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Nouvelle annonce de recrutement</h5>
            </div>
            <div class="card-body">
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $errorMessage ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="/rh/recrutement/annonces/ajouter" method="post">
                    <div class="mb-3">
                        <label for="poste_voulu" class="form-label">Intitulé du poste</label>
                        <input type="text" class="form-control" id="poste_voulu" name="poste_voulu" required>
                        <div class="form-text">Indiquez le titre du poste à pourvoir</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="date_depot_limite" class="form-label">Date limite de candidature</label>
                        <input type="date" class="form-control" id="date_depot_limite" name="date_depot_limite" required>
                        <div class="form-text">Date de clôture des candidatures</div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="/rh/recrutement/annonces" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Créer l'annonce</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>