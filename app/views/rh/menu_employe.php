<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Employés - RH</title>
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
                        <a class="nav-link active" href="/rh/menu-employe">Menu Employés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rh/recrutement">Recrutement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contrats</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">Connecté en tant que <?= $_SESSION['utilisateur']['nom_utilisateur'] ?? 'Utilisateur' ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Menu Employés</h1>
        
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Employés sous contrat</h5>
                        <p class="card-text">Consultez la liste des employés ayant un contrat permanent, leurs informations et leurs statuts.</p>
                        <a href="/rh/menu_employe/employes-contrat" class="btn btn-primary">Accéder à la liste</a>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-1"></div> -->
            
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Employés en contrat d'essai</h5>
                        <p class="card-text">Gérez les employés en période d'essai, consultez leurs contrats et suivez leur progression.</p>
                        <a href="/rh/menu_employe/employes-contrat-essai" class="btn btn-primary">Accéder à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>