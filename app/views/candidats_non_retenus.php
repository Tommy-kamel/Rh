<?php
// Fichier : app/views/candidats_non_retenus.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Traitement CV</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link active" href="#">Candidatures</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">Connecté en tant que <?php echo isset($_SESSION['utilisateur']) ? htmlspecialchars($_SESSION['utilisateur']['nom_utilisateur']) : 'Utilisateur'; ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Traitement des CV des candidats</h1>

        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <!-- Formulaire de recherche multicritère -->
        <div class="mb-4">
            <form method="GET" action="/rh/recrutement/candidats-non-retenus" class="row g-3">
                <div class="col-md-4">
                    <label for="nom_prenom" class="form-label">Nom ou Prénom</label>
                    <input type="text" id="nom_prenom" name="nom_prenom" class="form-control" value="<?php echo isset($_GET['nom_prenom']) ? htmlspecialchars($_GET['nom_prenom']) : ''; ?>">
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" id="email" name="email" class="form-control" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
                </div>
                <div class="col-md-4">
                    <label for="niveau_etude" class="form-label">Niveau d'Étude</label>
                    <select id="niveau_etude" name="niveau_etude" class="form-select">
                        <option value="">Tous</option>
                        <option value="CEPE" <?php echo isset($_GET['niveau_etude']) && $_GET['niveau_etude'] == 'CEPE' ? 'selected' : ''; ?>>CEPE</option>
                        <option value="BEPC" <?php echo isset($_GET['niveau_etude']) && $_GET['niveau_etude'] == 'BEPC' ? 'selected' : ''; ?>>BEPC</option>
                        <option value="BAC" <?php echo isset($_GET['niveau_etude']) && $_GET['niveau_etude'] == 'BAC' ? 'selected' : ''; ?>>BAC</option>
                        <option value="LICENCE" <?php echo isset($_GET['niveau_etude']) && $_GET['niveau_etude'] == 'LICENCE' ? 'selected' : ''; ?>>LICENCE</option>
                        <option value="MASTER" <?php echo isset($_GET['niveau_etude']) && $_GET['niveau_etude'] == 'MASTER' ? 'selected' : ''; ?>>MASTER</option>
                        <option value="DOCTORAT" <?php echo isset($_GET['niveau_etude']) && $_GET['niveau_etude'] == 'DOCTORAT' ? 'selected' : ''; ?>>DOCTORAT</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="experience_min" class="form-label">Exp. Min (années)</label>
                    <input type="number" id="experience_min" name="experience_min" class="form-control" value="<?php echo isset($_GET['experience_min']) ? htmlspecialchars($_GET['experience_min']) : ''; ?>">
                </div>
                <div class="col-md-2">
                    <label for="experience_max" class="form-label">Exp. Max (années)</label>
                    <input type="number" id="experience_max" name="experience_max" class="form-control" value="<?php echo isset($_GET['experience_max']) ? htmlspecialchars($_GET['experience_max']) : ''; ?>">
                </div>
                <div class="col-md-2">
                    <label for="age_min" class="form-label">Âge Min</label>
                    <input type="number" id="age_min" name="age_min" class="form-control" value="<?php echo isset($_GET['age_min']) ? htmlspecialchars($_GET['age_min']) : ''; ?>">
                </div>
                <div class="col-md-2">
                    <label for="age_max" class="form-label">Âge Max</label>
                    <input type="number" id="age_max" name="age_max" class="form-control" value="<?php echo isset($_GET['age_max']) ? htmlspecialchars($_GET['age_max']) : ''; ?>">
                </div>
                <div class="col-md-2">
                    <label for="sexe" class="form-label">Sexe</label>
                    <select id="sexe" name="sexe" class="form-select">
                        <option value="">Tous</option>
                        <option value="Homme" <?php echo isset($_GET['sexe']) && $_GET['sexe'] == 'Homme' ? 'selected' : ''; ?>>Homme</option>
                        <option value="Femme" <?php echo isset($_GET['sexe']) && $_GET['sexe'] == 'Femme' ? 'selected' : ''; ?>>Femme</option>
                        <option value="Autre" <?php echo isset($_GET['sexe']) && $_GET['sexe'] == 'Autre' ? 'selected' : ''; ?>>Autre</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="date_candidature" class="form-label">Date de Candidature</label>
                    <input type="date" id="date_candidature" name="date_candidature" class="form-control" value="<?php echo isset($_GET['date_candidature']) ? htmlspecialchars($_GET['date_candidature']) : ''; ?>">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary mt-3">Rechercher</button>
                </div>
                <!-- Tri -->
                <div class="col-md-4">
                    <label for="tri" class="form-label">Trier par :</label>
                    <select id="tri" name="tri" class="form-select" onchange="this.form.submit()">
                        <option value="age" <?php echo isset($_GET['tri']) && $_GET['tri'] == 'age' ? 'selected' : ''; ?>>Âge</option>
                        <option value="diplome" <?php echo isset($_GET['tri']) && $_GET['tri'] == 'diplome' ? 'selected' : ''; ?>>Diplôme</option>
                        <option value="experience" <?php echo isset($_GET['tri']) && $_GET['tri'] == 'experience' ? 'selected' : ''; ?>>Expérience</option>
                    </select>
                </div>
            </form>
        </div>

        <?php if (empty($candidats)): ?>
            <div class="alert alert-info">Aucun candidat non retenu à traiter.</div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>ID Candidat</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Niveau d'Étude</th>
                        <th>Expérience (années)</th>
                        <th>Âge</th>
                        <th>Date de Naissance</th>
                        <th>Adresse</th>
                        <th>Sexe</th>
                        <th>Date de Candidature</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($candidats as $candidat): ?>
                        <tr>
                            <td><img src="<?php echo htmlspecialchars($candidat['photo'] ? $candidat['photo'] : '/images/default.jpg'); ?>" alt="Photo du candidat" width="60" height="60"></td>
                            <td><?php echo htmlspecialchars($candidat['id_candidat']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['nom']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['mail']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['telephone']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['niveau_etude']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['experience']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['age']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['date_de_naissance']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['adresse']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['sexe']); ?></td>
                            <td><?php echo htmlspecialchars($candidat['date_candidature']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <form method="post" action="/rh/recrutement/traiter-candidats">
                <button type="submit" class="btn btn-primary mt-3">Traiter Tous les Candidats Non Retenus</button>
            </form>
        <?php endif; ?>

        <a href="/rh/recrutement" class="btn btn-primary mt-3">Retour au Menu Recrutement</a>
        <a href="/rh/recrutement/candidats-retenus" class="btn btn-secondary mt-3">Voir la liste complète des candidats</a>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
?>