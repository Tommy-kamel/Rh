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
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            animation: fadeIn 0.5s ease-in-out;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 15px;
            font-weight: 600;
            color: #555;
        }
        input, select {
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        button {
            margin-top: 25px;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .form-check {
            margin-top: 15px;
        }
        .form-check-label {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Postuler pour l'Annonce <?php echo htmlspecialchars($annonce['titre'] ?? ''); ?></h1>
        
        <?php if (!empty($message)): ?>
            <div class="message <?php echo htmlspecialchars($message_type); ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="/postuler/submit" enctype="multipart/form-data">
            <input type="hidden" name="id_annonce" value="<?php echo htmlspecialchars($id_annonce); ?>">
            
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>
            
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>
            
            <label for="mail">Email:</label>
            <input type="email" id="mail" name="mail" required>
            
            <label for="telephone">Téléphone:</label>
            <input type="tel" id="telephone" name="telephone" required>
            
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*">
            
            <label for="niveau_etude">Niveau d'étude:</label>
            <select name="niveau_etude" id="niveau_etude">
                <option value="" disabled selected>Choisir votre niveau d'étude</option>
                <option value="CEPE">CEPE</option>
                <option value="BEPC">BEPC</option>
                <option value="BAC">BAC</option>
                <option value="LICENCE">LICENCE</option>
                <option value="MASTER">MASTER</option>
                <option value="DOCTORAT">DOCTORAT</option>
            </select>

            <div class="mb-3">
                <label class="form-label">Sexe:</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexe" id="homme" value="Homme" required>
                        <label class="form-check-label" for="homme">Homme</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexe" id="femme" value="Femme">
                        <label class="form-check-label" for="femme">Femme</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexe" id="autre" value="Autre">
                        <label class="form-check-label" for="autre">Autre</label>
                    </div>
                </div>
            </div>

            <label for="experience">Expérience (années):</label>
            <input type="number" id="experience" name="experience" min="0" required>
            
            <label for="date_naissance">Date de naissance:</label>
            <input type="date" id="date_naissance" name="date_naissance" required>
            
            <label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse" required>
            
            <button type="submit">Soumettre la Candidature</button>
        </form>
    </div>
</body>
</html>
?>