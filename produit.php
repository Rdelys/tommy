<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            max-width: 800px;
            flex-shrink: 0; /* Empêche l'image de rétrécir */
        }  
           
        main {
            flex: 1;
            overflow-y: auto;
            padding-bottom: 20px;
        }

        .main-image {
            width: 100%;
            height: 350px;
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
    </style>
</head>
<body>
    <div class="image-container">
        <img src="/images/carrousel/meubles1.jpeg" alt="Image principale" class="main-image" id="mainImage">
        <a href="accueil.html"><div class="heart-circle top-left"><i class="fas fa-arrow-left"></i></div></a>
        <div class="heart-circle top-right"><i class="fas fa-share-nodes"></i></div>
        <div class="heart-circle bottom-right"><i class="fas fa-search"></i></div>
    </div>
    <div class="carousel-container" id="carousel">
        <img src="/images/carrousel/meubles1.jpeg" onclick="changeImage(this.src)" alt="">
        <img src="/images/carrousel/meubles2.jpeg" onclick="changeImage(this.src)" alt="">
        <img src="/images/carrousel/meubles3.jpg" onclick="changeImage(this.src)" alt="">
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
    </script>
</body>
</html>
