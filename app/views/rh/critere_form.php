<?php
// File: app/views/rh/critere_form.php
session_start();
if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
    header('Location: /login');
    exit;
}

$title = isset($critere) ? "Modifier un critère" : "Ajouter un critère";
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
                        <a class="nav-link" href="/rh/recrutement/annonces/<?= $id_annonce ?>">Détail de l'annonce</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><?= $title ?></a>
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
                <h5 class="card-title mb-0"><?= $title ?></h5>
            </div>
            <div class="card-body">
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $errorMessage ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= isset($critere) ? "/rh/recrutement/criteres/{$critere['id_critere']}/update" : "/rh/recrutement/annonces/{$id_annonce}/criteres/save" ?>" method="post">
                    <input type="hidden" name="id_annonce" value="<?= $id_annonce ?>">
                    <?php if (isset($critere)): ?>
                        <input type="hidden" name="id_critere" value="<?= $critere['id_critere'] ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="nom_critere" class="form-label">Nom du critère</label>
                        <input type="text" class="form-control" id="nom_critere" name="nom_critere" value="<?= isset($critere) ? htmlspecialchars($critere['nom_critere']) : '' ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="coefficient" class="form-label">Coefficient (importance)</label>
                        <input type="number" class="form-control" id="coefficient" name="coefficient" min="1" max="10" value="<?= isset($critere) ? htmlspecialchars($critere['coefficient']) : '1' ?>" required>
                        <div class="form-text">Valeur entre 1 (moins important) et 10 (très important)</div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="/rh/recrutement/annonces/<?= $id_annonce ?>" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary"><?= isset($critere) ? 'Mettre à jour' : 'Ajouter' ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>