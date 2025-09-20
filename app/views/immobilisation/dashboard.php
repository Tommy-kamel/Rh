<?php
// File: app/views/immobilisation/dashboard.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Gestion d'Immobilisation</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="#">Gestion d'entreprise</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Actifs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Amortissements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Maintenance</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">Connecté en tant que <?= $_SESSION['utilisateur']['nom_utilisateur'] ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Tableau de bord Gestion d'Immobilisation</h1>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des actifs</h5>
                        <p class="card-text">Consultez et gérez les actifs immobilisés de l'entreprise.</p>
                        <a href="#" class="btn btn-secondary">Accéder</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Amortissements</h5>
                        <p class="card-text">Gérez les amortissements des actifs immobilisés.</p>
                        <a href="#" class="btn btn-secondary">Accéder</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Maintenance</h5>
                        <p class="card-text">Planifiez et suivez la maintenance des équipements.</p>
                        <a href="#" class="btn btn-secondary">Accéder</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>