<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des employés sous contrat - RH</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --background-color: #f8f9fa;
            --card-background: #ffffff;
            --text-color: #212529;
            --light-text-color: #6c757d;
            --border-color: #dee2e6;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --danger-color: #dc3545;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #5a6acf 100%);
            padding: 20px 0;
            box-shadow: var(--shadow);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-color);
        }

        .badge {
            background: var(--secondary-color);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 1rem;
        }

        .filter-card {
            background: var(--card-background);
            border-radius: 16px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .filter-header {
            background: var(--background-color);
            padding: 20px 25px;
            border-bottom: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .filter-header:hover {
            background: #e9ecef;
        }

        .filter-header h6 {
            margin: 0;
            font-weight: 600;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-body {
            padding: 25px;
            display: none;
        }

        .filter-body.show {
            display: block;
            animation: fadeInDown 0.3s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-label {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            outline: none;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #5a6acf);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0b5ed7, #4c63d2);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3);
        }

        .btn-secondary {
            background: var(--secondary-color);
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
            padding: 6px 12px;
            font-size: 0.875rem;
        }

        .btn-danger:hover {
            background: #bb2d3b;
            transform: translateY(-1px);
        }

        .table-container {
            background: var(--card-background);
            border-radius: 16px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .table {
            margin: 0;
            width: 100%;
            border-collapse: collapse;
        }

        .table thead {
            background: linear-gradient(135deg, var(--primary-color), #5a6acf);
            color: white;
        }

        .table th, .table td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table th {
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }

        .alert {
            padding: 20px;
            border-radius: 12px;
            border: none;
            margin-bottom: 20px;
        }

        .alert-info {
            background: rgba(13, 202, 240, 0.1);
            color: #055160;
            /* border-left: 4px solid #0dcaf0; */
        }

        .user-info {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .filter-buttons {
            display: flex;
            gap: 15px;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .chevron-icon {
            transition: transform 0.3s ease;
        }

        .chevron-icon.rotated {
            transform: rotate(180deg);
        }

        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                gap: 15px;
            }

            .navbar-nav {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            .filter-grid {
                    grid-template-columns: 1fr;
                }

                .filter-buttons {
                    justify-content: center;
                }

            .page-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .filter-body {
                padding: 20px;
            }

            .table-container {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="navbar-brand">
                <i data-feather="briefcase"></i>
                SARL TANA SERVICES
            </a>
            <div class="navbar-nav">
                <a href="/rh/dashboard" class="nav-link">
                    <i data-feather="home"></i>
                    Tableau de bord
                </a>
                <a href="/rh/menu-employe" class="nav-link">
                    <i data-feather="users"></i>
                    Employés
                </a>
                <a href="/rh/recrutement" class="nav-link">
                    <i data-feather="user-plus"></i>
                    Recrutement
                </a>
                <span class="user-info">
                    <i data-feather="user"></i>
                    <?= $_SESSION['utilisateur']['nom_utilisateur'] ?? 'Utilisateur' ?>
                </span>
                <a href="/logout" class="nav-link">
                    <i data-feather="log-out"></i>
                    Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1>Liste des employés sous contrat</h1>
            <span class="badge"><?= count($employes ?? []) ?> employé(s)</span>
        </div>

        <!-- Filtres -->
        <div class="filter-card">
            <div class="filter-header" onclick="toggleFilters()">
                <h6>
                    <i data-feather="filter"></i>
                    Filtres de recherche
                </h6>
                <i data-feather="chevron-down" class="chevron-icon" id="chevronIcon"></i>
            </div>
            <div class="filter-body" id="filterBody">
                <form method="GET" action="/rh/menu_employe/employes-contrat">
                    <div class="filter-grid">
                        <div>
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($filters['nom'] ?? '') ?>" placeholder="Rechercher par nom...">
                        </div>
                        <div>
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($filters['prenom'] ?? '') ?>" placeholder="Rechercher par prénom...">
                        </div>
                        <div>
                            <label for="date_debut_debut" class="form-label">Date d'embauche (de)</label>
                            <input type="date" class="form-control" id="date_debut_debut" name="date_debut_debut" value="<?= htmlspecialchars($filters['date_debut_debut'] ?? '') ?>">
                        </div>
                        <div>
                            <label for="date_debut_fin" class="form-label">Date d'embauche (à)</label>
                            <input type="date" class="form-control" id="date_debut_fin" name="date_debut_fin" value="<?= htmlspecialchars($filters['date_debut_fin'] ?? '') ?>">
                        </div>
                        <div>
                            <label for="salaire_min" class="form-label">Salaire minimum</label>
                            <input type="number" class="form-control" id="salaire_min" name="salaire_min" value="<?= htmlspecialchars($filters['salaire_min'] ?? '') ?>" placeholder="0">
                        </div>
                        <div>
                            <label for="salaire_max" class="form-label">Salaire maximum</label>
                            <input type="number" class="form-control" id="salaire_max" name="salaire_max" value="<?= htmlspecialchars($filters['salaire_max'] ?? '') ?>" placeholder="1 000 000">
                        </div>
                    </div>
                    
                    <div class="filter-buttons">
                        <button type="submit" class="btn btn-primary">
                            <i data-feather="search"></i>
                            Filtrer
                        </button>
                        <a href="/rh/menu_employe/employes-contrat" class="btn btn-secondary">
                            <i data-feather="x"></i>
                            Réinitialiser
                        </a>
                    </div>
                </form>
            </div>
        
        <?php if (empty($employes)): ?>
            <div class="alert alert-info">
                <i data-feather="info" style="width: 20px; height: 20px; margin-right: 8px; vertical-align: middle;"></i>
                Aucun employé sous contrat trouvé.
            </div>
        <?php else: ?>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
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
                                <td><?= htmlspecialchars($employe['date_debut'] ?? '') ?></td>
                                <td><?= htmlspecialchars($employe['salaire'] ?? '') ?> Ar</td>
                                <td>
                                    <a href="/rh/employe/terminer/<?= $employe['id_employe'] ?>" class="btn btn-danger">
                                        <i data-feather="x-circle" style="width: 14px; height: 14px;"></i>
                                        Terminer le contrat
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    
    <script>
        feather.replace();
        
        function toggleFilters() {
            const filterBody = document.getElementById('filterBody');
            const chevronIcon = document.getElementById('chevronIcon');
            
            if (filterBody.classList.contains('show')) {
                filterBody.classList.remove('show');
                chevronIcon.classList.remove('rotated');
            } else {
                filterBody.classList.add('show');
                chevronIcon.classList.add('rotated');
            }
        }
        
        // Ouvrir automatiquement les filtres si des filtres sont appliqués
        <?php if (!empty(array_filter($filters ?? []))): ?>
        document.addEventListener('DOMContentLoaded', function() {
            toggleFilters();
        });
        <?php endif; ?>
    </script>
</body>
</html>