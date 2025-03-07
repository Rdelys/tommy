<?php
session_start(); // Démarre la session PHP pour accéder aux variables de session

// Vérifiez si l'utilisateur est connecté
if (!isset( $_SESSION['user_id'])) {
    // Redirigez l'utilisateur vers la page de connexion si ce n'est pas le cas
    header('Location: connexion.php');
    exit(); // Arrête l'exécution du script
}

// Connexion à la base de données
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "leboncoin";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer l'ID de l'utilisateur connecté
$userId = $_SESSION['user_id']; // Assurez-vous que l'ID de l'utilisateur est stocké dans la session

// Préparer la requête pour obtenir les informations de l'utilisateur
$sql = "SELECT nomEtprenom, email, DATE_FORMAT(dateAjoute, '%d/%m/%Y') AS date_creation, solde FROM utilisateur WHERE id = ?";
$stmt = $conn->prepare($sql);

// Lier les paramètres
$stmt->bind_param("i", $userId); // "i" pour integer (ID de l'utilisateur)

// Exécuter la requête
$stmt->execute();

// Récupérer les résultats
$result = $stmt->get_result();

// Vérifier si l'utilisateur existe
if ($result->num_rows > 0) {
    // L'utilisateur existe, récupérer ses données
    $user = $result->fetch_assoc();
} else {
    // Si l'utilisateur n'existe pas, afficher un message d'erreur
    die("Utilisateur non trouvé.");
}

$stmt->close(); // Fermer le statement
$conn->close(); // Fermer la connexion à la base de données
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <title>Produit</title>
    
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
        }

        @media (min-width: 768px) {
            body {
                max-width: 800px;
            }
        }

        .image-container {
            position: relative;
            width: 100%;
            max-width: 700px;
            flex-shrink: 0; /* Empêche l'image de rétrécir */
        }  
           
        main {
            flex: 1;
            overflow-y: auto;
            padding-bottom: 20px;
        }

        .main-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .heart-circle {
            position: absolute;
            width: 30px;
            height: 30px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .heart-circle i {
            font-size: 18px;
            color: #f99a04;
        }

        .top-left { top: 15px; left: 15px; }
        .top-right { top: 15px; right: 15px; }
        .bottom-right { bottom: 15px; right: 15px; }

        .carousel-container {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            padding: 10px;
            justify-content: center;
            scroll-behavior: smooth;
        }

        .carousel-container img {
            width: 400px;
            height: 120px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .carousel-container img:hover {
            transform: scale(1.1);
        }
        .advertisement-banner {
            background-color: #efefef;
            color: black;
            text-align: center;
            padding: 10px;
            padding-top: 10px;
            border-radius: 20px;
            margin: 20px 10px 10px 10px;
            font-size: 18px;
            font-weight: bold;
            height: 125px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .icon {
    width: 40px;
    height: 40px;
    background-color: #4a7aff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    margin-right: 15px;
}

.point-actif {
    width: 10px;
    height: 10px;
    background-color: green;
    border-radius: 50%;
    margin-right: 5px;
}

.text p {
    display: flex;
    align-items: center;
}


        .map-container {
            position: relative;
            width: 400px;
            height: 250px;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
        }
        #map {
            width: 100%;
            height: 100%;
        }
        .location-header {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 16px;
            font-weight: bold;
            background-color: white;
            padding: 5px;
            border-bottom: 1px solid #ccc;
        }
        .location-header i {
            color: black;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 20px;
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

        .card .text {
            display: flex;
            flex-direction: column;
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
            margin-bottom: 15px; /* Ajout d'espace entre l'en-tête et le carrousel */
        }

        .carousel-wrapper {
            display: flex;
            overflow-x: auto;
            gap: 15px; /* Ajout d'un espace entre les éléments du carrousel */
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
            position: relative; /* Permet de positionner le cœur correctement */
        }

        .carousel-item img {
            width: 100%;
            height: 150px; /* Hauteur fixe pour uniformiser la taille */
            object-fit: cover; /* Assure que l'image garde son ratio et couvre l'espace */
            border-radius: 10px;
        }



        .carousel-item-details {
            text-align: left;
            padding-top: 10px; /* Ajout d'espace entre l'image et les détails */
        }

        .carousel-item-details h3 {
            font-size: 16px;
            margin: 5px 0;
        }

        .carousel-item-details p {
            margin: 2px 0;
        }


        .heart-circle {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 30px;
        height: 30px;
        background-color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .heart-circle i {
        font-size: 18px;
        color: #f99a04;
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
    </style>
</head>
<body>
    <div class="image-container">
        <img src="./images/carrousel/meubles/meubles1.jpeg" alt="Image principale" class="main-image" id="mainImage">
        <a href="accueil.php"><div class="heart-circle top-left"><i class="fas fa-arrow-left"></i></div></a>
        <div class="heart-circle top-right"><i class="fas fa-share-nodes"></i></div>
        <div class="heart-circle bottom-right"><i class="fas fa-search"></i></div>
    </div>
    <div class="carousel-container" id="carousel">
        <img src="./images/carrousel/meubles/meubles1.jpeg" onclick="changeImage(this.src)" alt="">
        <img src="./images/carrousel/meubles/meubles2.jpeg" onclick="changeImage(this.src)" alt="">
        <img src="./images/carrousel/meubles/meubles3.jpeg" onclick="changeImage(this.src)" alt="">
     </div><br>
    <main>
        <div>
            <p style="font-weight: bold; font-size: 30px; padding-left: 10px; margin-bottom: 5px;">Titre</p>
            <p style="font-weight: bold; font-size: 25px; padding-left: 10px; color: #ef9e2b; margin-bottom: 5px">Prix €</p>
            <p style="background-color: #d9d9d9; margin-left: 10px; width: 40%; height: 30px;text-align: center; font-size: 18px; padding-left: 10px; padding-top: 5px; padding-right: 10px; margin-bottom: 10px">Annonce N°1</p>
            <p style="font-size: 16px; padding-left: 10px; color: #8b8b8b; margin-bottom: 10px;">publié de .....</p>
            <p style="font-size: 18px; padding-left: 10px; color: red;">Signaler cette annonce</p>
        </div>
        <div class="advertisement-banner">
            <h3>PUBLICITES</h3>
        </div>
        <h3 style="padding-left: 10px;">Description</h4>
        <p style="padding-left: 10px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi laboriosam ipsum error nihil quo quisquam animi molestiae nisi vitae? Nesciunt vitae quod omnis quis cum. Beatae labore nihil qui minima.</p>
        <div class="location-header">
        <i class="fas fa-map-marker-alt"></i> Lille (59000)
            </div>
            
            <div class="map-container">
                <div id="map"></div>
            </div>

            <div class="card">
                <div class="icon" style="background-color: #4a7aff; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; margin-right: 15px;">
                    <!-- Affiche la première lettre du nom de l'utilisateur -->
                    <?php echo strtoupper(substr($user['nomEtprenom'], 0, 1)); ?>
                </div>
                <div class="text">
                    <p style="font-weight: bold;"><?php echo htmlspecialchars($user['nomEtprenom']); ?></p><br>
                    
                    <!-- Afficher "Actif" avec un point vert -->
                    <p style="color: #898989; font-size: 15px; display: flex; align-items: center;">
                        <span style="width: 10px; height: 10px; background-color: green; border-radius: 50%; margin-right: 5px;"></span>
                        Actif
                    </p>
                    
                    <p style="color: #898989; font-size: 14px;">Membre depuis <?php echo $user['date_creation']; ?></p>
                </div>
            </div>

            <!-- Ajout du bouton "Appeler" en bas du card utilisateur avec largeur 100% et marges -->
            <div style="text-align: center; margin-top: 20px;">
                    <button style="background-color: #ff7f00; color: white; border: none; padding: 15px; font-size: 16px; border-radius: 5px; width: 100%; margin-left: 3px; margin-right: 3px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                        <i class="fas fa-phone-alt" style="margin-right: 8px"></i>
                        Appeler
                    </button>
            </div>
            <p style="font-size: 20px; font-weight: bold; margin-top: 30px; margin-left: 20px;color: #000000;">Produits similaires</p>
            <div class="carousel-container">
                <div class="carousel-wrapper" id="carouselWrapper">
                    <div class="carousel-item">
                        <img src="./images/carrousel/meubles/meubles1.jpeg" alt="Produit 1">
                            <div class="carousel-item-details">
                                <h3>Etagère et lavabo</h3>
                                <p style="color: #e89f2f; font-weight: bold;">500 €</p>
                                <p style="color: #606060;">Matières en bois - Bretagne</p>
                                <p style="color: #a7a7a7; font-size:  small;">Livraison possible</p>
                            </div>            
                        <div class="heart-circle"><i class="fas fa-heart"></i></div>
                    </div>
                    <div class="carousel-item">
                        <img src="./images/carrousel/meubles/meubles2.jpeg" alt="Produit 2">
                        <div class="carousel-item-details">
                                <h3>Canapé</h3>
                                <p style="color: #e89f2f; font-weight: bold;">100 €</p>
                                <p style="color: #606060;">Canapé une place - Paris</p>
                                <p style="color: #a7a7a7; font-size:  small;">Livraison possible</p>
                            </div>
                        <div class="heart-circle"><i class="fas fa-heart"></i></div>
                    </div>
                    <div class="carousel-item">
                        <img src="./images/carrousel/meubles/meubles3.jpeg" alt="Produit 3">
                        <div class="carousel-item-details">
                            <h3>Table TV</h3>
                            <p style="color: #e89f2f; font-weight: bold;">100 €</p>
                            <p style="color: #606060;">Table TV</p>
                            <p style="color: #a7a7a7; font-size:  small;">Livraison possible</p>
                        </div>
                        <div class="heart-circle"><i class="fas fa-heart"></i></div>
                    </div>
                </div>
            </div>
            <div style="padding: 10px; margin-top: 10px; width: 380px; height: 165px; background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); display: flex; flex-direction: column; justify-content: space-between; align-items: center; text-align: center;">
    <p style="font-size: 10px; margin: 0; font-weight: 400;">© 2025 Annonces en France™. Tous droits réservés.</p>

    <div style="display: flex; justify-content: center; margin: 10px 0;">
        <img src="./images/paiement.png" alt="paiement" style="max-width: 100px; height: auto;">
    </div>

    <div style="display: flex; justify-content: space-between; width: 100%; gap: 10px; text-align: left;">
        <p style="font-size: 10px; margin: 0; font-weight: 400;">Payment Method 1
            <br>À propos <br>
            Politique de confidentialité <br>
            Conditions d'utilisation <br>
            Politique des cookies <br>
            Avertissement <br>
        </p>
        <p style="font-size: 10px; margin: 0; font-weight: 400; text-align: right;">Mentions légales <br>
            Politique de modération <br>
            Politique de remboursement <br>
            FAQs <br>
            Contact <br>
        </p>
    </div>
</div>


    </main>
    <script>
        function changeImage(src) {
            document.getElementById('mainImage').src = src;
        }

        function autoScrollCarousel() {
            let carousel = document.getElementById('carousel');
            setInterval(() => {
                carousel.scrollLeft += 110;
                if (carousel.scrollLeft >= carousel.scrollWidth - carousel.clientWidth) {
                    carousel.scrollLeft = 0;
                }
            }, 2000);
        }

        window.onload = autoScrollCarousel;

        var map = L.map('map').setView([50.62925, 3.057256], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([50.62925, 3.057256]).addTo(map)
            .bindPopup("Lille, France")
            .openPopup();


            const carouselWrapper = document.getElementById("carouselWrapper");
const nextButton = document.getElementById("next");

// Fonction pour faire défiler les éléments du carrousel
function moveToNextItem() {
    const firstItem = carouselWrapper.firstElementChild;
    carouselWrapper.appendChild(firstItem); // Déplace le premier élément à la fin
}

// Défilement automatique toutes les 3 secondes
setInterval(moveToNextItem, 5000); // 3000 ms = 3 secondes

// Bouton suivant pour faire défiler manuellement
nextButton.addEventListener("click", moveToNextItem);

// Fonction pour permettre le défilement tactile
let isDragging = false;
let startX, scrollLeft;

carouselWrapper.addEventListener("mousedown", (e) => {
    isDragging = true;
    startX = e.pageX - carouselWrapper.offsetLeft;
    scrollLeft = carouselWrapper.scrollLeft;
});

carouselWrapper.addEventListener("mouseleave", () => {
    isDragging = false;
});

carouselWrapper.addEventListener("mouseup", () => {
    isDragging = false;
});

carouselWrapper.addEventListener("mousemove", (e) => {
    if (!isDragging) return;
    e.preventDefault();
    const x = e.pageX - carouselWrapper.offsetLeft;
    const scroll = (x - startX) * 2; // Multiplie la vitesse de défilement par 2
    carouselWrapper.scrollLeft = scrollLeft - scroll;
});

// Fonction pour permettre le défilement tactile (sur mobile)
carouselWrapper.addEventListener("touchstart", (e) => {
    isDragging = true;
    startX = e.touches[0].pageX - carouselWrapper.offsetLeft;
    scrollLeft = carouselWrapper.scrollLeft;
});

carouselWrapper.addEventListener("touchend", () => {
    isDragging = false;
});

carouselWrapper.addEventListener("touchmove", (e) => {
    if (!isDragging) return;
    e.preventDefault();
    const x = e.touches[0].pageX - carouselWrapper.offsetLeft;
    const scroll = (x - startX) * 2;
    carouselWrapper.scrollLeft = scrollLeft - scroll;
});
    </script>
</body>
</html>
