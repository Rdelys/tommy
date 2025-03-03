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
