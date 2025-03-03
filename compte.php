<?php
session_start(); // Démarre la session PHP pour accéder aux variables de session

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Redirigez l'utilisateur vers la page de connexion si ce n'est pas le cas
    header('Location: connexion.php'); // Remplacez 'login.php' par la page de votre choix
    exit(); // Arrête l'exécution du script
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compte</title>
    
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
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .topbar {
            position: fixed;
            top: 0;
            width: 100%;
            height: 60px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 100;
        }
        
        .navbar {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f5f5f5;
            display: flex;
            justify-content: space-around;
            padding: 25px;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .navbar a {
            color: #636363;
            text-align: center;
            text-decoration: none;
            font-size: 24px;
            width: 20%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar a:hover, .navbar a.active {
            color: #10bacf;
        }

        .icon {
            font-size: 22px;
        }

        .navbar span {
            font-size: 12px;
            margin-top: 5px;
            color: #636363;
        }

        .dropdown-icon {
            font-size: 24px;
            cursor: pointer;
            color: #fd9b00;
        }

        main {
            margin-top: 70px;
            margin-bottom: 70px;
            width: 100%;
            max-width: 800px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card {
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin: 10px;
            width: 90%;
            max-width: 400px;
            display: flex;
            align-items: center;
        }

        .card2 {
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin: 10px;
            width: 90%;
            max-width: 400px;
            display: flex;
            align-items: center;
        }

        .card .icon {
            width: 80px;
            height: 80px;
            background-color: #4a7aff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-right: 15px;
        }

        .card2 .icon2 {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #636363;
            font-size: 20px;
            margin-right: 15px;
        }

        .card .text {
            display: flex;
            flex-direction: column;
        }

        .card2 .text {
            display: flex;
            flex-direction: column;
            padding-left: 10px;
        }

        @media (min-width: 768px) {
            main {
                max-width: 800px;
            }
        }
    </style>
</head>
<body>
    <?php include('topbar.php'); ?>

    <main>
        <div class="card">
            <div class="icon"><i class="fas fa-user"></i></div>
            <div class="text">
                <p style="font-weight: bold;">Nom prénom</p><br>
                <p style="color: #898989; font-size: 15px;">Mail</p>
                <p style="color: #898989; font-size: 14px;">Membre depuis</p>
            </div>
        </div>

        <div class="card">
            <div class="text">
                <p style="font-weight: bold;">Porte-monnaie</p>
                <p style="color: #159062; font-weight: bold;">€</p>
                <p style="color: #898989; font-size: 14px;">Solde disponible</p>
            </div>
        </div>
        <div class="card2" onclick="window.location.href='publier.php';">
            <div class="icon2"><i class="fas fa-plus"></i></div>
            <div class="text">
                <p style="font-size: 18px;">Publier une nouvelle annonce</p>
                <p style="color: #898989; font-size: 12px;">Créer et publier une nouvelle annonce pour...</p>
            </div>
        </div>
        <div class="card2" onclick="window.location.href='#';">
            <div class="icon2"><i class="fa-brands fa-buffer"></i></div>
            <div class="text">
                <p style="font-size: 18px;">Voir mes annonces</p>
                <p style="color: #898989; font-size: 12px;">Accéder et gérez les annonces...</p>
            </div>
        </div>
        <div class="card2">
            <div class="icon2"><i class="fas fa-message"></i></div>
            <div class="text">
                <p style="font-size: 20px;">Mes messages</p>
                <p style="color: #898989; font-size: 12px;">Consulter et répondre aux messages des...</p>
            </div>
        </div>
        <div class="card2">
            <div class="icon2"><i class="fas fa-user-cog"></i></div>
            <div class="text">
                <p style="font-size: 20px;">Modifier mon profil</p>
                <p style="color: #898989; font-size: 12px;">Mettre à jour mes informations personnelles...</p>
            </div>
        </div>
        <div class="card2">
            <div class="icon2"><i class="fas fa-cog"></i></div>
            <div class="text">
                <p style="font-size: 20px;">Parametres</p>
                <p style="color: #898989; font-size: 12px;">Gérer vos paramètres des comptes</p>
           </div>
        </div>
        <div class="card2" onclick="window.location.href='deconnexion.php';">
            <div class="icon2"><i class="fas fa-lock-open"></i></div>
            <div class="text">
                <p style="font-size: 20px;">Deconnexion</p>
                <p style="color: #898989; font-size: 12px;">Deconnecter de votre compte</p>
            </div>
        </div>

    </main>
</body>
</html>
