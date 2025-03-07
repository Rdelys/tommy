<?php
include 'connecte.php';

// Démarre la session pour récupérer l'ID de l'utilisateur
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $titre = $conn->real_escape_string($_POST['titre']);
    $description = $conn->real_escape_string($_POST['description']);
    $categorie = $conn->real_escape_string($_POST['categorie']);
    
    // Vérifier que tous les champs sont remplis
    if (!empty($titre) && !empty($description) && !empty($categorie)) {
        
        // Récupérer l'ID utilisateur depuis la session
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        
        // Si l'ID utilisateur est défini (il doit l'être normalement)
        if ($user_id) {
            // Préparer la requête d'insertion avec l'ID utilisateur
            $sql = "INSERT INTO produitdetail (titre, description, categorie, idusers) 
                    VALUES ('$titre', '$description', '$categorie', '$user_id')";
            
            // Exécuter la requête
            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                header("Location: publierPhoto.php?id=$last_id");
                exit();
            } else {
                echo "Erreur : " . $conn->error;
            }
        } else {
            echo "L'ID utilisateur n'est pas défini dans la session.";
        }
    } else {
        echo "Tous les champs sont obligatoires !";
    }
}
?>
