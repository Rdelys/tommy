<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Publier</title>
    
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
            justify-content: space-between;
            padding: 0 20px;
            z-index: 100;
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

        h4 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .input-container {
            position: relative;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        select {
            width: 100%;
            padding: 6px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 5px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        .select-container {
            position: relative;
            width: 100%;
            margin-bottom: 10px;
        }

        .select-container i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: black;
        }

        p.info-text {
            color: gray;
            font-size: 12px;
            margin-bottom: 450px;
            text-align: justify;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-group a {
            text-decoration: none;
        }

        .btn {
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
            text-align: center;
        }

        .btn-return {
            background-color: #ddd;
            color: black;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-return i {
            margin-right: 5px;
        }

        .btn-submit {
            background-color: #646464;
            color: white;
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
        label
        {
            display: block;
            margin-bottom: 10px;
            font-size: 15px;
        }

        @media (min-width: 768px) {
            main {
                max-width: 800px;
            }
        }

    </style>
</head>
<body>
    <div class="topbar">
        <img width="100px" src="images/logo.png" alt="Logo">
        <i class="fas fa-bars dropdown-icon"></i>
    </div>

    <main>
        <h4>Ajouter plus de détails à votre annonce</h4>

        <label for="etat">État du produit</label>
        <div class="select-container">
            <select id="etat">
                <option value="" disabled selected>Sélectionner une option</option>
                <option value="neuf">Neuf</option>
                <option value="tresbon">Très bon état</option>
                <option value="bon">Bon état</option>
                <option value="acceptable">Acceptable</option>
            </select>            
            <i class="fas fa-chevron-down"></i>
        </div>
        <p class="info-text">Sélectionnez l'état général du produit parmi les
            options disponibles. Cela aide les acheteurs à évaluer la Condition
            de l'objet avant l'achat. Assurez vous de choisier l'option qui décrit le mieux
            l'état actuel du produit.
        </p>

        <div class="btn-group">
            <a href="publierPhoto.html" class="btn btn-return"><i class="fas fa-arrow-left"></i> Retour</a>
            <a href="publierAnnonce.html" class="btn btn-submit">Suivant</a>
        </div>
    </main>

    <div class="navbar">
        <a href="accueil.html" title="Accueil"><i class="fas fa-house-chimney icon"></i><span>Accueil</span></a>
        <a href="accueil.html" title="Recherche"><i class="fas fa-search icon"></i><span>Recherche</span></a>
        <a class="active" href="#" title="Publier"><i class="fas fa-plus-circle icon"></i><span>Publier</span></a>
        <a href="#" title="Messages"><i class="fas fa-message icon"></i><span>Messages</span></a>
        <a href="compte.html" title="Compte"><i class="fas fa-user icon"></i><span>Compte</span></a>
    </div>
</body>
</html>
