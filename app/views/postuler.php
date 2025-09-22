<?php
// Fichier : app/views/postuler.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postuler</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
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
            --success-color: #22c55e;
            --danger-color: #ef4444;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-color);
        }

        .container {
            background-color: var(--card-background);
            padding: 0;
            border-radius: 16px;
            box-shadow: var(--shadow);
            max-width: 700px;
            width: 100%;
            overflow: hidden;
            position: relative;
            border: 1px solid var(--border-color);
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color), #8b5cf6);
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        h1 {
            color: white;
            margin-bottom: 10px;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .form-body {
            padding: 40px 30px;
        }

        .message {
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
            animation: fadeIn 0.5s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .message.success {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .message.error {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            margin-top: 0;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-color);
            display: block;
            font-size: 0.95rem;
        }

        .required {
            color: var(--danger-color);
            margin-left: 3px;
        }

        input, select {
            padding: 14px 16px;
            margin-top: 0;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            font-family: 'Poppins', sans-serif;
            background: white;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
            transform: translateY(-1px);
        }

        input[type="file"] {
            padding: 12px 16px;
            background: var(--background-color);
        }

        input[type="file"]:focus {
            background: white;
        }

        button {
            margin-top: 30px;
            padding: 16px 24px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        button:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        }

        .form-check {
            margin-top: 15px;
        }

        .form-check-container {
            display: flex;
            gap: 20px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 0;
            flex: 1;
            min-width: 120px;
        }

        .form-check:hover {
            border-color: var(--accent-color);
            background: rgba(59, 130, 246, 0.05);
        }

        .form-check input[type="radio"] {
            width: 18px;
            height: 18px;
            margin: 0;
            accent-color: var(--accent-color);
        }

        .form-check input[type="radio"]:checked + label {
            color: var(--accent-color);
            font-weight: 600;
        }

        .form-check.checked {
            border-color: var(--accent-color);
            background: rgba(59, 130, 246, 0.1);
        }

        .form-check-label {
            margin: 0;
            font-weight: 500;
            color: var(--text-color);
            cursor: pointer;
        }

        select option {
            padding: 10px;
        }

        .back-link {
            margin-top: 20px;
            text-align: center;
        }

        .back-link a {
            color: var(--light-text-color);
            text-decoration: none;
            font-weight: 500;
            padding: 12px 24px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .back-link a:hover {
            color: var(--text-color);
            border-color: var(--accent-color);
            text-decoration: none;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .container {
                max-width: 100%;
            }

            .form-header {
                padding: 30px 20px;
            }

            .form-body {
                padding: 30px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-check-container {
                flex-direction: column;
                gap: 10px;
            }

            .form-check {
                flex: none;
                min-width: auto;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>
                <i data-feather="user-plus" style="width: 24px; height: 24px; margin-right: 10px;"></i>
                Postuler pour l'Annonce <?php echo htmlspecialchars($annonce['titre'] ?? ''); ?>
            </h1>
        </div>
        
        <div class="form-body">
            <?php if (!empty($message)): ?>
                <div class="message <?php echo htmlspecialchars($message_type); ?>">
                    <i data-feather="<?php echo $message_type === 'success' ? 'check-circle' : 'alert-circle'; ?>" style="width: 20px; height: 20px;"></i>
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="/postuler/submit" enctype="multipart/form-data">
                <input type="hidden" name="id_annonce" value="<?php echo htmlspecialchars($id_annonce); ?>">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="nom">Nom <span class="required">*</span></label>
                        <input type="text" id="nom" name="nom" required placeholder="Votre nom de famille">
                    </div>
                    
                    <div class="form-group">
                        <label for="prenom">Prénom <span class="required">*</span></label>
                        <input type="text" id="prenom" name="prenom" required placeholder="Votre prénom">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="mail">Email <span class="required">*</span></label>
                        <input type="email" id="mail" name="mail" required placeholder="votre.email@exemple.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="telephone">Téléphone <span class="required">*</span></label>
                        <input type="tel" id="telephone" name="telephone" required placeholder="034 XX XXX XX">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="photo">Photo de profil</label>
                    <input type="file" id="photo" name="photo" accept="image/*">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="niveau_etude">Niveau d'étude <span class="required">*</span></label>
                        <select name="niveau_etude" id="niveau_etude" required>
                            <option value="" disabled selected>Choisir votre niveau d'étude</option>
                            <option value="CEPE">CEPE</option>
                            <option value="BEPC">BEPC</option>
                            <option value="BAC">BAC</option>
                            <option value="LICENCE">LICENCE</option>
                            <option value="MASTER">MASTER</option>
                            <option value="DOCTORAT">DOCTORAT</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="experience">Expérience (années) <span class="required">*</span></label>
                        <input type="number" id="experience" name="experience" min="0" required placeholder="Nombre d'années">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sexe <span class="required">*</span></label>
                    <div class="form-check-container">
                        <div class="form-check form-check-inline" onclick="selectRadio('homme')">
                            <input class="form-check-input" type="radio" name="sexe" id="homme" value="Homme" required>
                            <label class="form-check-label" for="homme">Homme</label>
                        </div>
                        <div class="form-check form-check-inline" onclick="selectRadio('femme')">
                            <input class="form-check-input" type="radio" name="sexe" id="femme" value="Femme">
                            <label class="form-check-label" for="femme">Femme</label>
                        </div>
                        <div class="form-check form-check-inline" onclick="selectRadio('autre')">
                            <input class="form-check-input" type="radio" name="sexe" id="autre" value="Autre">
                            <label class="form-check-label" for="autre">Autre</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date_naissance">Date de naissance <span class="required">*</span></label>
                    <input type="date" id="date_naissance" name="date_naissance" required>
                </div>
                
                <div class="form-group">
                    <label for="adresse">Adresse <span class="required">*</span></label>
                    <input type="text" id="adresse" name="adresse" required placeholder="Votre adresse complète">
                </div>
                
                <button type="submit">
                    <i data-feather="send" style="width: 18px; height: 18px;"></i>
                    Soumettre la Candidature
                </button>
            </form>

            <div class="back-link">
                <a href="/annonces">
                    <i data-feather="arrow-left" style="width: 16px; height: 16px;"></i>
                    Retour aux offres d'emploi
                </a>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
        
        function selectRadio(id) {
            // Remove checked class from all radio items
            document.querySelectorAll('.form-check').forEach(item => {
                item.classList.remove('checked');
            });
            
            // Add checked class to selected item
            document.getElementById(id).parentElement.classList.add('checked');
            document.getElementById(id).checked = true;
        }
        
        // Handle radio button styling
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.form-check').forEach(item => {
                    item.classList.remove('checked');
                });
                this.parentElement.classList.add('checked');
            });
        });
    </script>
</body>
</html>