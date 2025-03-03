<?php
session_start(); // Démarre la session PHP pour accéder aux variables de session

// Supprimer toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page de connexion
header('Location: connexion.php'); // Remplacez par votre page de connexion
exit();
?>
