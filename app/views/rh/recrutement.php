<?php
// File: app/views/rh/recrutement.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recrutement - Gestion RH</title>
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
                        <a class="nav-link active" href="#">Recrutement</a>
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
        <h1 class="mb-4">Recrutement</h1>
        <p class="lead">Choisissez l'action que vous souhaitez effectuer</p>
        
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Gérer les annonces</h5>
                        <p class="card-text">Créez et gérez des annonces de recrutement pour différents postes.</p>
                        <a href="/rh/annonces/creer" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Examiner les candidatures</h5>
                        <p class="card-text">Consultez et évaluez les candidatures reçues pour les différentes annonces.</p>
                        <a href="/rh/recrutement/candidatures" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Planifier les entretiens</h5>
                        <p class="card-text">Programmez des entretiens avec les candidats sélectionnés.</p>
                        <a href="/rh/recrutement/entretiens" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>