<?php
include 'connecte.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $conn->real_escape_string($_POST['titre']);
    $description = $conn->real_escape_string($_POST['description']);
    $categorie = $conn->real_escape_string($_POST['categorie']);

    if (!empty($titre) && !empty($description) && !empty($categorie)) {
        $sql = "INSERT INTO produitdetail (titre, description, categorie) 
                VALUES ('$titre', '$description', '$categorie')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            header("Location: publierPhoto.php?id=$last_id");
            exit();
        } else {
            echo "Erreur : " . $conn->error;
        }
    } else {
        echo "Tous les champs sont obligatoires !";
    }
}
?>
