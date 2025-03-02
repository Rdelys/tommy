<?php
include 'connecte.php';

// Récupérer les catégories et sous-catégories
$sql = "SELECT c.id AS categorie_id, c.categorie, s.id AS souscategorie_id, s.nom AS souscategorie
        FROM categorie c
        LEFT JOIN souscategorie s ON c.id = s.idcategorie
        ORDER BY c.categorie, s.nom";
$result = $conn->query($sql);

// Structurer les données pour affichage
$categories = [];
while ($row = $result->fetch_assoc()) {
    $categorie_id = $row['categorie_id'];
    $categorie_nom = $row['categorie'];
    $souscategorie_id = $row['souscategorie_id'];
    $souscategorie_nom = $row['souscategorie'];

    if (!isset($categories[$categorie_id])) {
        $categories[$categorie_id] = [
            'nom' => $categorie_nom,
            'souscategories' => []
        ];
    }

    if ($souscategorie_id) {
        $categories[$categorie_id]['souscategories'][] = [
            'id' => $souscategorie_id,
            'nom' => $souscategorie_nom
        ];
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
            font-size: 11px;
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

        .select-container {
    position: relative;
    width: 100%;
}

select {
    width: 100%;
    padding: 10px;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    color: #333;
    appearance: none;
    cursor: pointer;
}

/* Icône dropdown */
.select-container::after {
    content: '\f078';
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: #fd9b00;
}

/* Style des options */
option {
    padding: 8px;
    font-size: 14px;
}

/* Mettre en gras les catégories principales */
option[style="font-weight:bold;"] {
    font-weight: bold;
    background-color: #e0e0e0;
}

/* Mettre en retrait les sous-catégories */
option:not([style="font-weight:bold;"]) {
    padding-left: 20px;
}

#categorie optgroup option {
    color: orange;
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
        
        <form action="traitement.php" method="post">
    <label for="titre">Titre de l'annonce</label>
    <div class="input-container">
        <input type="text" id="titre" name="titre" placeholder="">
    </div>
    <p class="info-text">Le titre de l'annonce doit être concis et informatif. <br>
    par exemple "vente d'un Iphone 15 neuf</p>
    <br>
    <label for="description">Description de l'annonce</label>
    <div class="input-container">
        <textarea id="description" name="description" placeholder="Décrivez votre annonce"></textarea>
    </div>
    <p class="info-text">La description doit fournir toutes les informations <br>
    pertinentes sur l'objet ou le service que vous annoncez</p>
    <br>
    <label for="categorie">Choisir une catégorie</label>
    <div class="select-container">
        <select id="categorie" name="categorie">
            <option value="">Sélectionner une catégorie</option>
            <?php foreach ($categories as $id => $cat) : ?>
                <option value="<?= $cat['nom'] ?>" style="font-weight:bold;">
                    <?= htmlspecialchars($cat['nom']) ?>
                </option>
                <?php foreach ($cat['souscategories'] as $souscat) : ?>
                    <option value="<?= $souscat['nom'] ?>">
                        <?= htmlspecialchars($cat['nom']) ?> > <?= htmlspecialchars($souscat['nom']) ?>
                    </option>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </select>
    </div>
    <br>
    <p class="info-text">Caravanes, camping-car, Mobil-homes, Accessoires de caravaning</p>
    <button type="submit" class="submit-btn">Suivant</button>
</form>

    </main>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var options = document.querySelectorAll("#categorie option[data-type='souscategorie']");

        options.forEach(option => {
            option.style.color = "orange";
        });
    });
</script>

</body>
</html>

