<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des employés sous contrat - RH</title>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Liste des employés sous contrat</h1>
            <a href="/rh/menu_employe" class="btn btn-secondary">Retour au menu</a>
        </div>
        
        <?php if (empty($employes)): ?>
            <div class="alert alert-info" role="alert">
                Aucun employé sous contrat trouvé.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Poste</th>
                            <th>Date d'embauche</th>
                            <th>Salaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employes as $employe): ?>
                            <tr>
                                <td><?= htmlspecialchars($employe['id_employe'] ?? '') ?></td>
                                <td><?= htmlspecialchars($employe['nom'] ?? '') ?></td>
                                <td><?= htmlspecialchars($employe['prenom'] ?? '') ?></td>
                                <td><?= htmlspecialchars($employe['poste'] ?? '') ?></td>
                                <td><?= htmlspecialchars($employe['date_embauche'] ?? '') ?></td>
                                <td><?= htmlspecialchars($employe['salaire'] ?? '') ?> Ar</td>
                                <td>
                                    <a href="/rh/employe/<?= $employe['id_employe'] ?>" class="btn btn-sm btn-primary">Voir détails</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>