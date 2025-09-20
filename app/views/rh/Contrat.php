<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Contrat - RH</title>
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
                        <a class="nav-link" href="/rh/menu-employe">Menu Employés</a>
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
        <h1>Détails du Contrat</h1>
        <div class="row">
            <div class="col-md-6">
                <h3>Informations de l'Employé</h3>
                <p><strong>Nom:</strong> <?= htmlspecialchars($employe['nom'] ?? '') ?></p>
                <p><strong>Prénom:</strong> <?= htmlspecialchars($employe['prenom'] ?? '') ?></p>
                <p><strong>Sexe:</strong> <?= htmlspecialchars($employe['sexe'] ?? '') ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($employe['mail'] ?? '') ?></p>
                <p><strong>Téléphone:</strong> <?= htmlspecialchars($employe['telephone'] ?? '') ?></p>
                <p><strong>Date de Naissance:</strong> <?= htmlspecialchars($employe['date_naissance'] ?? '') ?></p>
                <p><strong>Adresse:</strong> <?= htmlspecialchars($employe['adresse'] ?? '') ?></p>
            </div>
            <div class="col-md-6">
                <h3>Informations du Contrat</h3>
                <p><strong>ID Contrat:</strong> <?= htmlspecialchars($contrat['id_contrat'] ?? '') ?></p>
                <p><strong>Salaire:</strong> <?= htmlspecialchars($contrat['salaire'] ?? '') ?> Ar</p>
                <p><strong>Date de Début:</strong> <?= htmlspecialchars($contrat['date_debut'] ?? '') ?></p>
                <p><strong>Date de Fin:</strong> <?= htmlspecialchars($contrat['date_fin'] ?? 'Indéterminée') ?></p>
            </div>
        </div>
        <div class="mt-4">
            <a href="/contrat/export-pdf?id_contrat=<?= $contrat['id_contrat'] ?>" class="btn btn-primary">Générer PDF</a>
            <a href="/rh/menu_employe" class="btn btn-secondary">Retour au menu</a>
        </div>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>