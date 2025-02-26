<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
    
    <!-- Lien vers la bibliothèque Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: white;
            color: black;
            height: 100vh;
            overflow: hidden;
        }

        .topbar {
            position: fixed;
            top: 0;
            width: 100%;
            height: 60px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center; /* Centre horizontalement */
            padding: 0 20px;
            z-index: 100;
        }

        .topbar img {
        width: 150px; /* Augmente la taille */
        height: auto; /* Garde les proportions */
        margin-top: 10px; /* Décale le logo vers le bas */
    }

        main {
            margin-top: 70px;
            padding: 20px;
            background-color: white;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 80px;
            overflow-y: auto;
            height: calc(100vh - 150px);
        }

        .card {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card h4 {
            font-weight: bold;
            margin-bottom: 30px;
        }

        .card p {
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #f0f0f0;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .form-options label {
            font-size: 15px;
        }

        .form-options a {
            color: orange;
            text-decoration: none;
            font-size: 15px;
            font-weight: bold;
        }

        .btn-submit {
            width: 100%;
            background-color: orange;
            color: white;
            border: none;
            padding: 5px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            margin-bottom: 15px;
        }

        .create-text {
            text-align: center;
            margin-top: 10px;
            font-size: 15px;
        }

        .create-text a {
            color: orange;
            text-decoration: none;
            font-weight: bold;
        }
        a {
            text-decoration: none;
        }

        /* Preloader */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .preloader img {
            width: 300px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="preloader">
        <img src="images/Bienvenu.png" alt="Logo">
    </div>

    <div class="topbar">
        <!-- Logo -->
        <img src="images/logo.png" alt="Logo">
    </div>

    <main>
        <div class="card">
            <h4>Créer un compte</h4>
            <form>
                <div class="form-group">
                    <label for="nomEtprenom">Nom et prénom</label>
                    <input type="text" id="nomEtprenom" name="nomEtprenom" required>
                </div>
                <div class="form-group">
                    <label for="email">Votre email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirmerpassword">Confirmer votre mot de passe</label>
                    <input type="password" id="confirmerpassword" name="confirmerpassword" required>
                </div>
                <div class="form-options">
                    <label>
                        <input type="checkbox" name="remember"> J'accepte les <a href="#">Termes et Conditions</a> 
                    </label>
                </div>
                <button type="submit" class="btn-submit">Créer un compte</button>
            </form>
            <p class="create-text">Vous avez déjà un compte ? <br><a href="connexion.php">Connectez-vous ici</a></p>
        </div>
    </main>
    <script>
        window.onload = function() {
            setTimeout(function() {
                document.querySelector(".preloader").style.display = "none";
                document.querySelector(".content").style.display = "block";
            }, 5000);
        };

        document.querySelector("form").addEventListener("submit", function(event) {
            event.preventDefault(); // Empêche l'envoi classique du formulaire
            window.location.href = "accueil.php"; // Redirige vers accueil.html
        });
    </script>
</body>
</html>
