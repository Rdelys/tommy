<?php
include 'connecte.php';

if (isset($_GET['id'])) {
    $idproduit = intval($_GET['id']);
} else {
    echo "Aucun produit trouvé";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer le prix depuis le formulaire
    $prix = $_POST['prix'];

    // Vérifier que le prix est valide
    if (is_numeric($prix) && $prix > 0) {
        // Préparer la requête SQL pour insérer le prix dans la table prixproduit
        $sql = "INSERT INTO prixproduit (idproduit, prix) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Lier les paramètres
            $stmt->bind_param("is", $idproduit, $prix);

            // Exécuter la requête
            if ($stmt->execute()) {
                // Rediriger vers la page 'publierGeo.php' en passant l'ID
                header("Location: publierGeo.php?id=" . $idproduit);
                exit(); // Assurez-vous d'appeler exit() après header() pour arrêter l'exécution du script
            } else {
                echo "Erreur lors de l'ajout du prix : " . $stmt->error;
            }

            // Fermer la requête
            $stmt->close();
        }
    } else {
        echo "Le prix doit être un nombre valide supérieur à 0.";
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Publier</title>
    
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
            height: 100%; /* Utiliser 100% de la hauteur du viewport */
            overflow: auto; /* Permettre le défilement vertical */
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

        .price-container {
            display: flex;
            align-items: center;
            background: #f1f1f1;
            padding: 10px 15px;
            border-radius: 10px;
        }

        .price-container input {
            border: none;
            background: transparent;
            outline: none;
            padding: 5px;
            font-size: 16px;
        }

        main {
            margin-top: 70px; /* Espace sous la topbar */
            padding: 20px;
            background-color: white;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 80px; /* Espace pour éviter chevauchement avec la navbar */
            overflow-y: auto; /* Permet le défilement vertical */
            height: auto; /* Laisser la hauteur s'ajuster selon le contenu */
            min-height: calc(100vh - 120px); /* Hauteur minimale pour compenser le topbar et autres éléments */
        }

        .dropdown-icon {
            font-size: 24px;
            cursor: pointer;
            color: #fd9b00;
        }

        @media (min-width: 768px) {
            main {
                max-width: 800px;
            }
        }

        .advertisement-banner {
            background-color: #efefef;
            color: black;
            text-align: center;
            padding: 10px;
            padding-top: 10px;
            border-radius: 20px;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
            height: 125px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        p {
            font-size: 16px;
            font-weight: bold;
            color: black;
        }

        /* Style du carrousel */
        .carousel-container {
            margin-top: 20px;
            padding: 10px;
        }

        .carousel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .carousel-wrapper {
            display: flex;
            overflow-x: auto;
            gap: 15px;
            scroll-behavior: smooth;
            padding-bottom: 10px;
        }

        .carousel-item {
            flex: 0 0 auto;
            width: 220px;
            text-align: left;
            background: #fff;
            padding: 10px;
            border-radius: 10px;
            position: relative;
        }

        .carousel-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .carousel-item-details {
            text-align: left;
            padding-top: 10px;
        }

        .carousel-item-details h3 {
            font-size: 16px;
            margin: 5px 0;
        }

        .carousel-item-details p {
            margin: 2px 0;
        }

        .carousel-controls {
            position: absolute;
            top: 50%;
            right: 10px;
            display: flex;
            flex-direction: column;
            z-index: 10;
        }

        .carousel-controls i {
            font-size: 30px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 5px;
            border-radius: 50%;
            cursor: pointer;
        }

        .carousel-navigation {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .carousel-button {
            padding: 8px 16px;
            background-color: #f1f1f1;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            color: #636363;
            display: flex;
            align-items: center;
            width: 150px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .carousel-button i {
            margin-right: 8px;
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
            background-color: orange;
            color: white;
        }

    </style>
</head>
<body>
    <div class="topbar">
        <img width="100px" src="images/logo.png" alt="Logo">
        <i class="fas fa-bars dropdown-icon"></i>
    </div>

    <main>
        <p>Quel est le prix de votre annonce</p> <br>
        <p style="font-size: 12px; color: #636363;">prix (en €)</p> <br>

        <form method="POST">
            <div class="price-container">
                <input type="number" name="prix" required>
            </div><br>
            <p style="font-size: 14px; color: #aaaaaa;">Indiquez le prix de votre produit ou annonce</p>

            <div class="carousel-container">
            <div class="carousel-header">
                <p>Voici les annonces similaires pour avoir <br> 
                    une idée du prix du marché</p>
            </div>
            <div class="carousel-wrapper" id="carouselWrapper">
                <div class="carousel-item">
                    <img src="./images/carrousel/appareil/ecouteur.jpeg" alt="Produit 1">
                    <div class="carousel-item-details">
                        <h3>Ecouteur</h3>
                        <p style="color: #e89f2f; font-weight: bold;">25 €</p>
                        <p style="color: #606060;">Ecouteur sans fil</p>
                        <p style="color: #a7a7a7; font-size: small;">Livraison possible</p>
                    </div>            
                </div>
                <div class="carousel-item">
                    <img src="./images/carrousel/appareil/macbook.jpeg" alt="Produit 2">
                    <div class="carousel-item-details">
                        <h3>MacBook</h3>
                        <p style="color: #e89f2f; font-weight: bold;">650 €</p>
                        <p style="color: #606060;">MacBook Pro - Bretagne</p>
                        <p style="color: #a7a7a7; font-size: small;">Livraison possible</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./images/carrousel/appareil/smartwatch.jpeg" alt="Produit 3">
                    <div class="carousel-item-details">
                        <h3>Smart Watch</h3>
                        <p style="color: #e89f2f; font-weight: bold;">220 €</p>
                        <p style="color: #606060;">Smart Watch multifonctionnel</p>
                        <p style="color: #a7a7a7; font-size: small;">Livraison possible</p>
                    </div>
                </div>
            </div>
        </div> 
        <div class="btn-group">
                <a href="publierEtat.php?id=<?php echo $idproduit; ?>" class="btn btn-return"><i class="fas fa-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-submit">Soumettre</button>
            </div>       
        </form>
    </main>
    <script>
        // Sauvegarder le prix dans le localStorage lorsque l'utilisateur le saisit
        document.getElementById('priceInput').addEventListener('input', function() {
            let prix = this.value;
            // Sauvegarder le prix dans le localStorage
            localStorage.setItem('prix', prix);
        });

        // Lorsque l'utilisateur clique sur le bouton "Suivant"
        document.getElementById('suivant-btn').addEventListener('click', function(event) {
            // Récupérer le prix du localStorage
            let prix = localStorage.getItem('prix');
            
            // Vérifier que le prix est bien renseigné
            if (!prix || prix <= 0) {
                alert('Veuillez entrer un prix valide avant de continuer.');
                event.preventDefault();  // Empêcher la redirection si le prix est invalide
                return;
            }

            // Si le prix est valide, continuer la redirection
            window.location.href = 'publierGeo.php';
        });
    </script>
</body>
</html>
