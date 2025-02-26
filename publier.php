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
            margin-bottom: 30px;
        }

        .input-container {
            position: relative;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .clear-icon {
            position: absolute;
            right: 10px;
            cursor: pointer;
            font-size: 18px;
        }

        p.info-text {
            color: gray;
            font-size: 12px;
        }

        .category-container {
            display: flex;
            align-items: center;
            background-color: #f5f5f5;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            justify-content: space-between;
            margin-bottom: 30px;

        }

        .category-container input {
            border: none;
            background: none;
            padding: 5px;
            flex: 1;

        }

        .category-container button {
            color: Red;
            border: none;
            padding: 5px;
            cursor: pointer;
        }

        button.submit-btn {
            width: 100%;
            padding: 8px;
            background-color: orange;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 20px;
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

        label{
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
        <h4>Ajouter des détails à votre annonce</h4>
        
        <label for="titre">Titre de l'annonce</label>
        <div class="input-container">
            <input type="text" id="titre" placeholder="">
            <i class="fas fa-times clear-icon" onclick="document.getElementById('titre').value = '';" title="Effacer"></i>
        </div>
        <p class="info-text">Le titre de l'annonce doit être concis et informatif. <br>
        par exemple "vente d'un Iphone 15 neuf</p>
        <br>
        <label for="description">Description de l'annonce</label>
        <div class="input-container">
            <textarea id="description" placeholder="Décrivez en détails votre annonce..." rows="6"></textarea>
        </div>
        <p class="info-text">La description doit fournir toutes les informations <br>
        pertinentes sur l'objet ou le service que vous annoncez</p>
        <br>
        <label for="categorie">Choisir une catégorie</label>
        <div class="category-container">
            <input type="text" id="categorie">
            <button onclick="document.getElementById('categorie').value = '';">Modifier</button>
        </div>
        <p class="info-text">Caravanes, camping-car, Mobil-homes, Accessoires de caravaning</p>
        <br><br><br><br><br>
        <a href="publierPhoto.html"><button class="submit-btn">Suivant</button></a>
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

