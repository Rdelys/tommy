<?php
include 'connecte.php';

if (isset($_GET['id'])) {
    $idproduit = intval($_GET['id']);
} else {
    echo "Aucun produit trouvé";
    exit();
}

// Récupérer les détails du produit
$sqlProduit = "SELECT titre, description, categorie FROM produitdetail WHERE id = ?";
$stmtProduit = $conn->prepare($sqlProduit);
$stmtProduit->bind_param("i", $idproduit);
$stmtProduit->execute();
$resultProduit = $stmtProduit->get_result();
$produit = $resultProduit->fetch_assoc();

// Récupérer les images du produit
$sqlImages = "SELECT photo1, photo2, photo3, photo4, photo5 FROM produitphoto WHERE idproduit = ?";
$stmtImages = $conn->prepare($sqlImages);
$stmtImages->bind_param("i", $idproduit);
$stmtImages->execute();
$resultImages = $stmtImages->get_result();
$images = $resultImages->fetch_assoc();

// Récupérer le prix du produit
$sqlPrix = "SELECT prix FROM prixproduit WHERE idproduit = ?";
$stmtPrix = $conn->prepare($sqlPrix);
$stmtPrix->bind_param("i", $idproduit);
$stmtPrix->execute();
$resultPrix = $stmtPrix->get_result();
$prix = $resultPrix->fetch_assoc();

// Récupérer l'état du produit
$sqlEtat = "SELECT etat FROM etatproduit WHERE idproduit = ?";
$stmtEtat = $conn->prepare($sqlEtat);
$stmtEtat->bind_param("i", $idproduit);
$stmtEtat->execute();
$resultEtat = $stmtEtat->get_result();
$etat = $resultEtat->fetch_assoc();

// Récupérer la ville du produit
$sqlVille = "SELECT ville FROM geoproduit WHERE idproduit = ?";
$stmtVille = $conn->prepare($sqlVille);
$stmtVille->bind_param("i", $idproduit);
$stmtVille->execute();
$resultVille = $stmtVille->get_result();
$ville = $resultVille->fetch_assoc();

// Fermer les connexions de base de données
$stmtProduit->close();
$stmtImages->close();
$stmtPrix->close();
$stmtEtat->close();
$stmtVille->close();
?>
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
            height: calc(100vh - 50px);
        }
        .image-container img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
        .details {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
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

    <main >
        <p style="font-size:14px;"><strong>Confirmez les détails de votre annonce</strong></p>
<br>
        <p style="font-size:14px;">Résumé de l'annonce :</p>
        <br>
        <p style="font-size:14px;"><strong>Images:</strong></p>
        <div class="image-container">
            <?php
            $photos = [$images['photo1'], $images['photo2'], $images['photo3'], $images['photo4'], $images['photo5']];
            foreach ($photos as $photo) {
                if ($photo) {
                    echo "<img src='uploads/$photo' alt='Image produit'>";
                }
            }
            ?>
        </div>
        <br>
        <p style="font-size:14px;"><strong>Catégorie:</strong><br> <?= $produit['categorie']; ?></p>
        <br>
        <p style="font-size:14px;"><strong>Titre:</strong> <?= $produit['titre']; ?></p>
        <br>
        <p style="font-size:14px;"><strong>Description:</strong> <br><?= $produit['description']; ?></p>
        <br>
        <p style="font-size:14px;"><strong>Description:</strong> <?= $produit['description']; ?></p>

        <div class="details">
            <p style="font-size:14px;"><strong>Prix:</strong> <br><?= $prix['prix']; ?> €</p>
            <p style="font-size:14px;"><strong>Ville:</strong> <br><?= $ville['ville']; ?></p>
            <p style="font-size:14px;"><strong>État du produit:</strong> <br><?= $etat['etat']; ?></p>
        </div>
<br>
        <p style="font-size:12px;font-weight: small;">Vérifiez toutes les informations ci-dessus avant de publier votre annonce.</p>

        <div class="btn-group">
            <a href="publierAnnonce.php" class="btn btn-return"><i class="fas fa-arrow-left"></i> Retour</a>
            <a href="merci.php" class="btn btn-submit">Publier</a>
        </div>
    </main>

</body>
</html>
