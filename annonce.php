<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mes annonces</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: black;
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
            border-bottom: 1px solid #ddd;
        }
        main {
            margin-top: 70px;
            padding: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        h2 {
            text-align: left;
            margin-bottom: 20px;
        }
        .card {
            display: flex;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            padding: 10px;
            align-items: center;
            position: relative;
        }
        .card img {
            width: 80px;
            height: 80px;
            border-radius: 5px;
            object-fit: cover;
            margin-right: 15px;
        }
        .card-content {
            flex: 1;
            margin-bottom: 10px;
        }
        .card-content h3 {
            font-size: 14px;
            margin: 0;
        }
        .card-content .published {
            color: orange;
            font-size: 12px;
            font-weight: bold;
            margin: 5px 0;
        }
        .card-content .category {
            font-size: 11px;
            color: #555;
            background: #ddd;
            padding: 3px 8px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 5px;
        }
        .card-content .city {
            font-size: 11px;
            color: #42c8dd;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 5px;
            font-weight: bold;
        }
        .card-content .city i {
            color: #42c8dd;
        }
        .card-icons {
            position: absolute;
            bottom: 5px;
            right: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-top: 5px;
        }
        .card-icons i {
            font-size: 14px;
            color: gray;
            cursor: pointer;
        }
        .card-icons i:hover {
            color: black;
        }

                .card-content .details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
        }

    </style>
</head>
<body>
    <?php include('topbar.php'); ?>

    <main>
        <h2>Mes annonces</h2>

        <?php
        include 'connecte.php';
        $sql = "SELECT pd.id, pd.titre, pd.categorie, gp.ville, pp.photo1 
                FROM produitdetail pd 
                JOIN geoproduit gp ON pd.id = gp.idproduit 
                JOIN produitphoto pp ON pd.id = pp.idproduit";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='card'>
                    <img src='uploads/{$row['photo1']}' alt='Image produit'>
                    <div class='card-content'>
                        <h3>{$row['titre']}</h3>
                        <p class='published'>Publié</p>
                        <p class='category'>{$row['categorie']}</p>
                        <p class='city'><i class='fas fa-map-marker-alt'></i>{$row['ville']}</p>
                    </div>
                    <div class='card-icons'>
                        <i class='fas fa-chart-bar'></i>
                        <i class='fas fa-edit'></i>
                        <i class='fas fa-trash delete-btn' data-id='{$row['id']}'></i>
                    </div>
                </div>";
            }
        } else {
            echo "<p>Aucune annonce trouvée.</p>";
        }
        $conn->close();
        ?>
    </main>

    <?php include('navbar.php'); ?>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                let id = this.getAttribute("data-id");
                if (confirm("Voulez-vous vraiment supprimer cette annonce ?")) {
                    fetch("delete_annonce.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: "id=" + id
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data === "success") {
                            this.closest(".card").remove();
                        } else {
                            alert("Erreur lors de la suppression.");
                        }
                    });
                }
            });
        });
    });
</script>

</body>
</html>
