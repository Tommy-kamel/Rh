<?php
// File: app/views/login.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-login {
            width: 100%;
            background-color: #007bff;
            border-color: #007bff;
        }
        .error-message {
            color: #dc3545;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <h2>Connexion</h2>
                <p>Veuillez vous connecter pour accéder à votre espace</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="error-message">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            
            <form action="/login" method="post">
                <div class="form-group mb-3">
                    <label for="nom_utilisateur">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="nom_utilisateur" name="nom_utilisateur" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-login mt-3">Se connecter</button>
            </form>
        </div>
    </div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>