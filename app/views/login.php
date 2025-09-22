<?php
// File: app/views/login.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - SARL TANA SERVICES</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --primary-color: #1e293b;
            --secondary-color: #64748b;
            --accent-color: #3b82f6;
            --background-color: #f8fafc;
            --card-background: #ffffff;
            --text-color: #334155;
            --light-text-color: #64748b;
            --border-color: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --success-color: #22c55e;
            --danger-color: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: var(--card-background);
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            position: relative;
            border: 1px solid var(--border-color);
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            /* background: linear-gradient(90deg, var(--accent-color), #8b5cf6); */
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .login-header .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .login-header h2 {
            color: white;
            margin-bottom: 10px;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .login-header p {
            opacity: 0.9;
            font-size: 1rem;
            margin: 0;
        }

        .login-body {
            padding: 40px 30px;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid var(--danger-color);
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 8px;
            display: block;
            font-size: 1rem;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 14px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            font-family: 'Poppins', sans-serif;
            background: white;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
            outline: none;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light-text-color);
            z-index: 2;
        }

        .form-control.with-icon {
            padding-left: 50px;
        }

        .btn-login {
            background: var(--primary-color);
            border: none;
            color: white;
            padding: 16px 24px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            margin-top: 30px;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        }

        .login-footer {
            padding: 20px 30px;
            background: var(--background-color);
            text-align: center;
            border-top: 1px solid var(--border-color);
        }

        .login-footer p {
            color: var(--light-text-color);
            margin: 0;
            font-size: 0.9rem;
        }

        .login-footer a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .features {
            margin-top: 30px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            color: var(--light-text-color);
            font-size: 0.9rem;
        }

        .feature-item i {
            color: var(--success-color);
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .login-header {
                padding: 30px 20px;
            }

            .login-header h2 {
                font-size: 1.6rem;
            }

            .login-body {
                padding: 30px 20px;
            }

            .login-footer {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="brand">
                <i data-feather="briefcase" style="width: 28px; height: 28px;"></i>
                TANA SERVICES
            </div>
            <h2>Connexion</h2>
            <p>Accédez à votre espace de gestion RH</p>
        </div>
        
        <div class="login-body">
            <?php if (isset($error)): ?>
                <div class="error-message">
                    <i data-feather="alert-circle" style="width: 20px; height: 20px;"></i>
                    <?= $error ?>
                </div>
            <?php endif; ?>
            
            <form action="/login" method="post" id="loginForm">
                <div class="form-group">
                    <label for="nom_utilisateur" class="form-label">Nom d'utilisateur</label>
                    <div class="input-group">
                        <i data-feather="user" class="input-icon"></i>
                        <input type="text" class="form-control with-icon" id="nom_utilisateur" name="nom_utilisateur" value="rh_user" required placeholder="Entrez votre nom d'utilisateur">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="mot_de_passe" class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <i data-feather="lock" class="input-icon"></i>
                        <input type="password" class="form-control with-icon" id="mot_de_passe" name="mot_de_passe" value="RH" required placeholder="Entrez votre mot de passe">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-login" id="loginBtn">
                    <i data-feather="log-in" style="width: 18px; height: 18px;"></i>
                    Se connecter
                </button>
            </form>

            <div class="features">
                <div class="feature-item">
                    <i data-feather="shield-check" style="width: 16px; height: 16px;"></i>
                    Connexion sécurisée
                </div>
                <div class="feature-item">
                    <i data-feather="users" style="width: 16px; height: 16px;"></i>
                    Gestion complète des employés
                </div>
                <div class="feature-item">
                    <i data-feather="clipboard" style="width: 16px; height: 16px;"></i>
                    Suivi des recrutements
                </div>
            </div>
        </div>

        <div class="login-footer">
            <p>&copy; 2024 SARL TANA SERVICES. Tous droits réservés.</p>
        </div>
    </div>
    
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>