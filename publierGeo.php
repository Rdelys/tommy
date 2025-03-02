<?php
include 'connecte.php';

if (isset($_GET['id'])) {
    $idproduit = intval($_GET['id']);
} else {
    echo "Aucun produit trouvé";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer la ville depuis le formulaire
    $ville = $_POST['ville'];

    // Vérifier que la ville n'est pas vide
    if (!empty($ville)) {
        // Préparer la requête SQL pour insérer la ville et l'ID du produit dans la table geoproduit
        $sql = "INSERT INTO geoproduit (idproduit, ville) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Lier les paramètres
            $stmt->bind_param("is", $idproduit, $ville);

            // Exécuter la requête
            if ($stmt->execute()) {
                // Rediriger vers la page 'recap.php' après l'insertion
                header("Location: recap.php?id=" . $idproduit);
                exit(); // Assurez-vous d'appeler exit() après header() pour arrêter l'exécution du script
            } else {
                echo "Erreur lors de l'ajout de la ville : " . $stmt->error;
            }

            // Fermer la requête
            $stmt->close();
        }
    } else {
        echo "Veuillez saisir une ville.";
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
            flex: 1;
        }

        .price-container .gps-icon {
            font-size: 20px;
            color: orange;  /* Couleur orange pour l'icône */
            cursor: not-allowed;  /* L'icône ne sera pas cliquable */
            margin-left: 10px;
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
            height: calc(100vh - 50px);
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
        <p>Où se situe votre produit</p><br>
        <p style="font-size: 12px; color: #636363;">Cherchez une ville</p><br>

        <form method="POST">
            <div class="price-container">
                <input type="text" id="cityInput" name="ville" placeholder="Commencez à taper une ville..." oninput="updateCity()" required>
                <i class="fas fa-map-marker-alt gps-icon"></i>
            </div><br>
    <br>
            <p style="font-size: 14px; color: #aaaaaa;">Vous avez choisi: <span id="selectedCity">Aucune ville sélectionnée</span></p>
<br><br><br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>

            <div class="btn-group">
                <a href="publierAnnonce.php" class="btn btn-return"><i class="fas fa-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-submit" id="suivant-btn">Suivant</button>
            </div>
        </form>
    </main>

    <script>
        // Met à jour la ville affichée
        function updateCity() {
            const cityInput = document.getElementById('cityInput').value;
            document.getElementById('selectedCity').textContent = cityInput ? cityInput : 'Aucune ville sélectionnée';
            
            // Sauvegarde la ville dans le localStorage
            localStorage.setItem('ville', cityInput);
        }

        // Vérifie la ville avant de passer à la page suivante
        document.getElementById('suivant-btn').addEventListener('click', function(event) {
            let city = localStorage.getItem('ville');

            // Si aucune ville n'est sélectionnée, afficher un message d'alerte
            if (!city) {
                alert('Veuillez sélectionner une ville avant de continuer.');
                event.preventDefault();  // Annule la redirection
                return;
            }

            // La ville est validée et sera disponible sur la page suivante
            console.log("Ville sélectionnée : " + city);  // Utilisation de la ville
        });
    </script>
</body>
</html>
