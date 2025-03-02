<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    echo "ID du produit : " . $id;
} else {
    echo "Aucun produit trouvé";
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

        .upload-card {
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            margin-bottom: 300px;
        }

        .upload-card i {
            font-size: 26px;
            color: rgb(65, 64, 64);
        }

        .upload-card p {
            margin-top: 10px;
            color: black;
            font-weight: bold;
        }

        span {
            margin-top: 10px;
            color: #837a7a;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
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
        }

        .image-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
        }

        .image-preview img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <img width="100px" src="images/logo.png" alt="Logo">
        <i class="fas fa-bars dropdown-icon"></i>
    </div>

    <main>
        <h4>Ajouter des images</h4>
        
        <div class="upload-card" onclick="document.getElementById('fileInput').click();">
            <i class="fas fa-cloud-upload-alt"></i>
            <p>Ajouter des photos</p>
            <span>jusqu'à 20 images</span>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" id="fileInput" name="photos[]" multiple accept="image/*" style="display: none;">
            <div id="preview" class="image-preview"></div>
            <div class="btn-group">
                <a href="publier.php" class="btn btn-return"><i class="fas fa-arrow-left"></i> Retour</a>
                <button type="submit" class="btn btn-submit" name="suivant">Suivant</button>
            </div>
        </form>
    </main>

    <script>
        document.getElementById('fileInput').addEventListener('change', function(event) {
            let preview = document.getElementById('preview');
            preview.innerHTML = ''; // Vide l'aperçu avant d'ajouter de nouvelles images
    
            if (this.files.length > 20) {
                alert("Vous ne pouvez ajouter que 20 images maximum.");
                this.value = ''; // Réinitialise l'input
                return;
            }
    
            Array.from(this.files).forEach(file => {
                if (!file.type.startsWith('image/')) return;
    
                let img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.onload = () => URL.revokeObjectURL(img.src);
                preview.appendChild(img);
            });
        });

        document.querySelector('.btn-submit').addEventListener('click', function() {

            // Avant de naviguer vers la page suivante, sauvegarder les images
            let images = JSON.parse(localStorage.getItem('images')) || [];
            
            // Envoi des données à la page suivante si nécessaire (par exemple, en les envoyant à un serveur via AJAX)
            // Ce code peut être adapté pour envoyer ces images à la base de données si nécessaire.

            // Si des images sont présentes, tu peux les afficher ou les envoyer à ton serveur, 
            // ici, on les sauvegarde simplement pour les récupérer plus tard.
            if (images.length > 0) {
                console.log("Images stockées :", images);
            }

            // Rediriger vers la page suivante
            window.location.href = 'publierEtat.php';
        });
    </script>
</body>
</html>
<?php
include 'connecte.php';

if (isset($_POST['suivant']) && isset($_GET['id'])) {
    $idproduit = intval($_GET['id']);
    $photos = $_FILES['photos']['name'];
    $tmp_names = $_FILES['photos']['tmp_name'];

    if (empty($photos[0])) {
        echo "Aucune photo sélectionnée.";
        exit();
    }

    foreach ($photos as $index => $photo) {
        $newName = time() . "_" . basename($photo);
        $target = 'uploads/' . $newName;
        move_uploaded_file($tmp_names[$index], $target);
        $photos[$index] = $newName;
    }

    $photos = array_pad($photos, 20, NULL);

    $sql = "INSERT INTO produitphoto (idproduit, photo1, photo2, photo3, photo4, photo5, photo6, photo7, photo8, photo9, photo10,
    photo11, photo12, photo13, photo14, photo15, photo16, photo17, photo18, photo19, photo20) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssssssssssssssss", $idproduit, ...$photos);

    if ($stmt->execute()) {
        // Photos enregistrées avec succès
        echo "Photos enregistrées avec succès.";
        
        // Ici, nous utilisons un script JavaScript pour la redirection
        echo "<script type='text/javascript'>
                window.location.href = 'publierEtat.php?id=$idproduit';
              </script>";
        exit(); // Éviter d'exécuter plus de code après la redirection
    } else {
        echo "Erreur lors de l'enregistrement.";
    }
}
?>


