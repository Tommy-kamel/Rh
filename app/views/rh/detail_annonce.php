<?php 
// Vérifie si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['fonction'] !== 'Ressources Humaines') {
    header('Location: /login');
    exit;
}

$title = "Détail de l'annonce";
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
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Détail de l'annonce</h4>
                        <a href="/recrutement/annonces" class="btn btn-light btn-sm">Retour aux annonces</a>
                    </div>
                    <div class="card-body">
                        <?php if (isset($annonce)): ?>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5>Informations générales</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Poste</th>
                                                <td><?= htmlspecialchars($annonce['poste_voulu']) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Date limite de dépôt</th>
                                                <td><?= (new DateTime($annonce['date_depot_limite']))->format('d/m/Y') ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5>Critères de sélection</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <?php if (!empty($annonce['age_min']) || !empty($annonce['age_max'])): ?>
                                                <tr>
                                                    <th>Âge</th>
                                                    <td>
                                                        <?php 
                                                        if (!empty($annonce['age_min']) && !empty($annonce['age_max'])) {
                                                            echo "{$annonce['age_min']} à {$annonce['age_max']} ans";
                                                        } elseif (!empty($annonce['age_min'])) {
                                                            echo "Min: {$annonce['age_min']} ans";
                                                        } elseif (!empty($annonce['age_max'])) {
                                                            echo "Max: {$annonce['age_max']} ans";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if (!empty($annonce['sexe'])): ?>
                                                <tr>
                                                    <th>Sexe</th>
                                                    <td><?= htmlspecialchars($annonce['sexe']) ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if (!empty($annonce['experience'])): ?>
                                                <tr>
                                                    <th>Expérience</th>
                                                    <td><?= $annonce['experience'] ?> année(s)</td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if (!empty($annonce['diplome_requis'])): ?>
                                                <tr>
                                                    <th>Diplôme requis</th>
                                                    <td><?= htmlspecialchars($annonce['diplome_requis']) ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if (!empty($annonce['langues_maitrisees'])): ?>
                                                <tr>
                                                    <th>Langues maîtrisées</th>
                                                    <td><?= htmlspecialchars($annonce['langues_maitrisees']) ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <h5 class="mt-4 mb-3">Candidats</h5>
                            <?php if (isset($candidats) && !empty($candidats)): ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Email</th>
                                                <th>Téléphone</th>
                                                <th>Date de candidature</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($candidats as $candidat): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($candidat['nom']) ?></td>
                                                    <td><?= htmlspecialchars($candidat['prenom']) ?></td>
                                                    <td><?= htmlspecialchars($candidat['mail']) ?></td>
                                                    <td><?= htmlspecialchars($candidat['telephone']) ?></td>
                                                    <td><?= (new DateTime($candidat['date_candidature']))->format('d/m/Y') ?></td>
                                                    <td>
                                                        <a href="/recrutement/candidats/detail?id=<?= $candidat['id_candidat'] ?>" class="btn btn-sm btn-info">Détails</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info">Aucun candidat n'a postulé à cette annonce pour le moment.</div>
                            <?php endif; ?>
                            
                            <div class="mt-4">
                                <a href="/recrutement/annonces/modifier?id=<?= $annonce['id_annonce'] ?>" class="btn btn-warning">Modifier l'annonce</a>
                                <a href="/recrutement/annonces/supprimer?id=<?= $annonce['id_annonce'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">Supprimer l'annonce</a>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-danger">Annonce introuvable</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>