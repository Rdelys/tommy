<?php
include 'connecte.php';

if (isset($_GET['id'])) {
    $idproduit = intval($_GET['id']);
    echo "ID du produit : " . $idproduit;
} else {
    echo "Aucun produit trouvé";
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['etat']) && isset($_POST['idproduit'])) {
    $idproduit = intval($_POST['idproduit']);
    $etat = $_POST['etat']; // État sélectionné

    // Préparer l'insertion dans la base de données
    $sql = "INSERT INTO etatproduit (idproduit, etat) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $idproduit, $etat);

    if ($stmt->execute()) {
        echo "L'état du produit a été mis à jour avec succès.";
        // Rediriger vers la page suivante après l'ajout
        header("Location: publierAnnonce.php?id=$idproduit");
        exit(); // Arrêter l'exécution après la redirection
    } else {
        echo "Erreur lors de l'ajout de l'état.";
    }
}
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
            height: calc(100vh - 100px);
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
            margin-bottom: 300px;
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

<form method="POST" action="">
    <input type="hidden" name="idproduit" value="<?= $idproduit ?>">

    <label for="etat">État du produit</label>
    <div class="select-container">
        <select id="etat" name="etat" required>
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
        de l'objet avant l'achat. Assurez-vous de choisir l'option qui décrit le mieux
        l'état actuel du produit.
    </p>

    <div class="btn-group">
        <a href="publierPhoto.php" class="btn btn-return"><i class="fas fa-arrow-left"></i> Retour</a>
        <button type="submit" class="btn btn-submit">Suivant</button>
    </div>
</form>
</main>
</body>
</html>

<script>
// Lorsque l'utilisateur choisit un état du produit
document.getElementById('etat').addEventListener('change', function() {
// Sauvegarde de l'état du produit dans localStorage
let etat = this.value;
localStorage.setItem('etat', etat);
});

// Lorsque l'utilisateur clique sur le bouton "Suivant"
document.querySelector('.btn-submit').addEventListener('click', function() {
// Récupération de l'état sauvegardé dans localStorage
let etat = localStorage.getItem('etat');

// Vérification que l'état a bien été sélectionné avant de continuer
if (!etat) {
    alert('Veuillez sélectionner l\'état du produit avant de continuer.');
    return;
}

// Rediriger vers la page suivante
window.location.href = 'publierAnnonce.php?id=' + <?= $idproduit ?>;
});
</script>
