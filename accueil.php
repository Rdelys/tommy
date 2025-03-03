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
    <title>Accueil</title>

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
            height: 100vh; /* Définit la hauteur totale de la page */
            overflow: hidden; /* Empêche le défilement du body */
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

        .search-container {
            display: flex;
            align-items: center;
            background: #f1f1f1;
            padding: 10px 15px;
            border-radius: 20px;
        }

        .search-container input {
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
            height: calc(100vh - 150px); /* Hauteur réduite pour laisser de la place pour la topbar et la navbar */
        }

        .category-cards-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 15px;
        }

        .category-card {
            width: 22%;
            padding: 15px;
            background-color: #efefef;
            border-radius: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .category-card i {
            font-size: 20px;
            margin-bottom: 10px;
            color: #10bacf;
        }

        .category-card span {
            font-size: 12px;
            color: #10bacf;
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

        @media (min-width: 768px) {
            main {
                max-width: 800px;
            }

            .category-card {
                width: 22%;
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
    <?php include('topbar.php'); ?>

    <main>
        <div class="search-container">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Rechercher...">
        </div>
        <div class="category-cards-container">
            <div class="category-card">
                <i class="fas fa-hotel"></i>
                <span>Immobilier</span>
            </div>
            <div class="category-card">
                <i class="fas fa-car"></i>
                <span>Véhicules</span>
            </div>
            <div class="category-card">
                <i class="fas fa-chair"></i>
                <span>Meubles</span>
            </div>
            <div class="category-card">
                <i class="fas fa-ellipsis-h"></i>
                <span>Autres</span>
            </div>            
        </div>
        <div class="advertisement-banner">
            PUBLICITES
        </div>
        <p>D'après vos dernières <br> recherches</p>

        <!-- Carrousel des Meubles -->
        <div class="carousel-container">
            <div class="carousel-header">
                <span style="color: #10bacf;">Meubles</span>
                <i class="fas fa-chevron-right" id="next"></i>
            </div>
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
        <div class="carousel-container">
            <div class="carousel-header">
                <span style="color: #10bacf;">Vehicules</span>
                <i class="fas fa-chevron-right" id="next"></i>
            </div>
            <div class="carousel-wrapper" id="carouselWrapper">
                <div class="carousel-item">
                    <img src="./images/carrousel/vehicules/vehicules1.jpeg" alt="Produit 1">
                        <div class="carousel-item-details">
                            <h3>Vehicules</h3>
                            <p style="color: #e89f2f; font-weight: bold;">5000 €</p>
                            <p style="color: #606060;">Voiture bleu</p>
                            <p style="color: #a7a7a7; font-size:  small;">Livraison possible</p>
                        </div>            
                    <div class="heart-circle"><i class="fas fa-heart"></i></div>
                </div>
                <div class="carousel-item">
                    <img src="./images/carrousel/vehicules/vehicules2.jpeg" alt="Produit 2">
                    <div class="carousel-item-details">
                            <h3>Voiture</h3>
                            <p style="color: #e89f2f; font-weight: bold;">3500 €</p>
                            <p style="color: #606060;">Couleur Orange - Paris</p>
                            <p style="color: #a7a7a7; font-size:  small;">Livraison possible</p>
                        </div>
                    <div class="heart-circle"><i class="fas fa-heart"></i></div>
                </div>
                <div class="carousel-item">
                    <img src="./images/carrousel/vehicules/bicyclette.jpeg" alt="Produit 3">
                    <div class="carousel-item-details">
                        <h3>Canapé</h3>
                        <p style="color: #e89f2f; font-weight: bold;">800 €</p>
                        <p style="color: #606060;">Vélo</p>
                        <p style="color: #a7a7a7; font-size:  small;">Livraison possible</p>
                    </div>
                    <div class="heart-circle"><i class="fas fa-heart"></i></div>
                </div>
            </div>
        </div>
        <div class="carousel-container">
            <div class="carousel-header">
                <span style="color: #10bacf;">Appareils électrique et gadgets</span>
                <i class="fas fa-chevron-right" id="next"></i>
            </div>
            <div class="carousel-wrapper" id="carouselWrapper">
                <div class="carousel-item">
                    <img src="./images/carrousel/appareil/ecouteur.jpeg" alt="Produit 1">
                        <div class="carousel-item-details">
                            <h3>Ecouteur</h3>
                            <p style="color: #e89f2f; font-weight: bold;">25 €</p>
                            <p style="color: #606060;">Ecouteur sans fil</p>
                            <p style="color: #a7a7a7; font-size:  small;">Livraison possible</p>
                        </div>            
                    <div class="heart-circle"><i class="fas fa-heart"></i></div>
                </div>
                <div class="carousel-item">
                    <img src="./images/carrousel/appareil/macbook.jpeg" alt="Produit 2">
                    <div class="carousel-item-details">
                            <h3>MacBook</h3>
                            <p style="color: #e89f2f; font-weight: bold;">650 €</p>
                            <p style="color: #606060;">MacBook Pro - Bretagne</p>
                            <p style="color: #a7a7a7; font-size:  small;">Livraison possible</p>
                        </div>
                    <div class="heart-circle"><i class="fas fa-heart"></i></div>
                </div>
                <div class="carousel-item">
                    <img src="./images/carrousel/appareil/smartwatch.jpeg" alt="Produit 3">
                    <div class="carousel-item-details">
                        <h3>Smart Watch</h3>
                        <p style="color: #e89f2f; font-weight: bold;">220 €</p>
                        <p style="color: #606060;">Smart Watch multifonctionnel</p>
                        <p style="color: #a7a7a7; font-size:  small;">Livraison possible</p>
                    </div>
                    <div class="heart-circle"><i class="fas fa-heart"></i></div>
                </div>
            </div>
        </div>
        <p style="color: #a7a7a7; font-weight: 400;font-size:  10px; text-align:justify;">Gens du Voyage Trouvez tout ce dont vous avez besoin sur Gens du Voyage, le site incontournable de petites annonces en ligne. Explorez une large gamme de catégories : Maison & Jardin pour vos meubles et  électroménagers,  Vêtements & Accessoires pour les dernières tendances mode, Loisirs & Hobbies  pour les passionnés de musique, films et livres, ainsi que Véhicules pour acheter ou vendre des voitures, motos et plus. Découvrez aussi nos sections  Électronique,  Immobilier, Équipements Professionnels, Bébé & Enfant et Animaux & Accessoires. Gens du Voyage est votre 
            destination pour acheter, vendre et échanger facilement partout en France.</p>
        <div  style="padding: 10px;margin-top: 10px; width: 330px; height: 165px; background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); display: flex; flex-direction: column; justify-content: space-between;">
            <p style="font-size: 10px; text-align: left; margin: 0; font-weight: 400;">© 2025 Annonces en France™. Tous droits réservés.</p>

            <div style="display: flex; justify-content: center; margin: 10px 0;">
                <img src="./images/paiement.png" alt="paiement" style="max-width: 100px; height: auto;">
            </div>

            <div style="display: flex; justify-content: space-between;gap: 10px;">
                <p style="font-size: 10px; text-align: left; margin: 0; font-weight: 400;">Payment Method 1
                  <br>À propos <br>
Politique de confidentialité <br> 
Conditions d'utilisation <br>
Politique des cookies <br>
Avertissement <br>
</p>
                <p style="font-size: 10px; text-align: right; margin: 0; font-weight: 400;">Mentions légales <br>
Politique de modération <br>
Politique de remboursement <br>
FAQs <br>
Contact <br></p>
            </div>
        </div>

    </main>

    <?php include('navbar.php'); ?>


    <script>
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
