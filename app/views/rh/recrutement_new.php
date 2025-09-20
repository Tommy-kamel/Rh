<?php 
// Vérifie si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
    header('Location: /login');
    exit;
}

$title = "Menu Recrutement";
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
                        <h4>Menu de Recrutement</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Annonces</h5>
                                        <p class="card-text">Gérer les annonces de recrutement et les critères de sélection.</p>
                                        <a href="/recrutement/annonces" class="btn btn-primary">Accéder</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Candidatures</h5>
                                        <p class="card-text">Gérer les candidatures reçues et évaluer les candidats.</p>
                                        <a href="/recrutement/candidatures" class="btn btn-primary">Accéder</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Entretiens</h5>
                                        <p class="card-text">Planifier et gérer les entretiens d'embauche.</p>
                                        <a href="/recrutement/entretiens" class="btn btn-primary">Accéder</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/rh/dashboard" class="btn btn-secondary">Retour au tableau de bord</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>