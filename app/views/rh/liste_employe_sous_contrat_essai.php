<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des employés en contrat d'essai - RH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .transition-transform {
            transition: transform 0.3s ease;
        }
        .card-header:hover {
            background-color: #e9ecef !important;
        }
    </style>
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
            <h1>Liste des employés en contrat d'essai</h1>
            <span class="badge bg-secondary fs-6" style="font-family: 'Poppins', sans-serif; font-weight: 500;"><?= count($employesEssai ?? []) ?> employé(s)</span>
        </div>

        <!-- Filtres collapsibles -->
        <div class="card mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center" 
                 style="cursor: pointer;" 
                 data-bs-toggle="collapse" 
                 data-bs-target="#filterCollapse" 
                 aria-expanded="false" 
                 aria-controls="filterCollapse">
                <div class="d-flex align-items-center">
                    <!-- <i data-feather="filter" class="me-2 text-primary"></i> -->
                    <h6 class="mb-0 fw-semibold">Filtres de recherche</h6>
                </div>
                <i data-feather="chevron-down" class="transition-transform" id="filterToggleIcon"></i>
            </div>
            <div class="collapse" id="filterCollapse">
                <div class="card-body">
                    <form method="GET" action="/rh/menu_employe/employes-contrat-essai" class="row g-3">
                        <div class="col-md-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($filters['nom'] ?? '') ?>" placeholder="Rechercher...">
                        </div>
                        <div class="col-md-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($filters['prenom'] ?? '') ?>" placeholder="Rechercher...">
                        </div>
                        <div class="col-md-3">
                            <label for="date_debut_debut" class="form-label">Date de début (de)</label>
                            <input type="date" class="form-control" id="date_debut_debut" name="date_debut_debut" value="<?= htmlspecialchars($filters['date_debut_debut'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="date_debut_fin" class="form-label">Date de début (à)</label>
                            <input type="date" class="form-control" id="date_debut_fin" name="date_debut_fin" value="<?= htmlspecialchars($filters['date_debut_fin'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="date_fin_debut" class="form-label">Date de fin (de)</label>
                            <input type="date" class="form-control" id="date_fin_debut" name="date_fin_debut" value="<?= htmlspecialchars($filters['date_fin_debut'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="date_fin_fin" class="form-label">Date de fin (à)</label>
                            <input type="date" class="form-control" id="date_fin_fin" name="date_fin_fin" value="<?= htmlspecialchars($filters['date_fin_fin'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="salaire_min" class="form-label">Salaire min</label>
                            <input type="number" class="form-control" id="salaire_min" name="salaire_min" value="<?= htmlspecialchars($filters['salaire_min'] ?? '') ?>" placeholder="0">
                        </div>
                        <div class="col-md-3">
                            <label for="salaire_max" class="form-label">Salaire max</label>
                            <input type="number" class="form-control" id="salaire_max" name="salaire_max" value="<?= htmlspecialchars($filters['salaire_max'] ?? '') ?>" placeholder="1000000">
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <!-- <i data-feather="search" class="me-1"></i>--> Filtrer
                            </button>
                            <a href="/rh/menu_employe/employes-contrat-essai" class="btn btn-secondary">
                                Réinitialiser
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php if (!empty($message)): ?>
            <div class="alert alert-<?= $message_type == 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if (empty($employesEssai)): ?>
            <div class="alert alert-info" role="alert">
                Aucun employé en contrat d'essai trouvé.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <!-- <th>Poste</th> -->
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Salaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employesEssai as $employe): ?>
                            <tr>
                                <td><?= htmlspecialchars($employe['id_contrat_essai'] ?? '') ?></td>
                                <td><?= htmlspecialchars($employe['nom'] ?? '') ?></td>
                                <td><?= htmlspecialchars($employe['prenom'] ?? '') ?></td>
                                <td><?= htmlspecialchars($employe['date_debut'] ?? '') ?></td>
                                <td><?= htmlspecialchars($employe['date_fin'] ?? 'En cours') ?></td>
                                <td><?= htmlspecialchars($employe['salaire'] ?? '') ?> Ar</td>
                                <td>
                                    <a href="/rh/employe-essai/embaucher/<?= $employe['id_contrat_essai'] ?>" class="btn btn-sm btn-primary">Embaucher</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();
        
        // Animation de l'icône flèche lors de l'ouverture/fermeture des filtres
        document.getElementById('filterCollapse').addEventListener('show.bs.collapse', function () {
            document.getElementById('filterToggleIcon').style.transform = 'rotate(180deg)';
        });
        
        document.getElementById('filterCollapse').addEventListener('hide.bs.collapse', function () {
            document.getElementById('filterToggleIcon').style.transform = 'rotate(0deg)';
        });
        
        // Ouvrir automatiquement les filtres si des filtres sont appliqués
        <?php if (!empty(array_filter($filters ?? []))): ?>
        document.addEventListener('DOMContentLoaded', function() {
            var filterCollapse = new bootstrap.Collapse(document.getElementById('filterCollapse'), {
                toggle: false
            });
            filterCollapse.show();
        });
        <?php endif; ?>
    </script>
</body>
</html>