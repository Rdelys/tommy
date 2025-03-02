<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Merci</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
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

        main {
            text-align: center;
            padding: 20px;
            background-color: white;
            width: 100%;
            max-width: 600px;
        }

        .logo {
            width: 100px;
            margin-bottom: 20px;
        }

        .merci-text {
            color: #3bb3e6;
            font-size: 12px;
            font-weight: bold;
            margin: 10px 0;
        }

        .success-message {
            font-size: 12px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 8px 28px;
            background-color: orange;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            text-align: center;
        }

        .btn:hover {
            background-color: #e69500;
        }

    </style>
</head>
<body>
    <div class="topbar">
        <img width="100px" src="images/logo.png" alt="Logo">
    </div>

    <main>
        <img class="logo" src="images/logo-moyen.png" alt="Logo Moyen">
        <p class="merci-text">Merci</p>
        <p class="success-message">Votre annonce a été publiée avec succès</p>
        <a href="compte.php">
            <button class="btn">Continuer</button>
        </a>
    </main>
</body>
</html>
