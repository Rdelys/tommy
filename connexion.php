<?php
session_start();
include 'connecte.php'; // Fichier de connexion à la base de données

if (isset($_SESSION['user'])) {
    header("Location: accueil.php");
    exit();
}

if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $saved_email = $_COOKIE['email'];
    $saved_password = $_COOKIE['password'];
} else {
    $saved_email = "";
    $saved_password = "";
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification si les champs ne sont pas vides
    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Vérification du mot de passe
            if (password_verify($password, $row['password'])) {
                $_SESSION['user'] = $row['nomEtprenom']; // Stocker le nom dans la session
            
                // Se souvenir de moi
                if (isset($_POST['remember'])) {
                    setcookie('email', $email, time() + (86400 * 30), "/"); // 30 jours
                    setcookie('password', $password, time() + (86400 * 30), "/"); // 30 jours
                } else {
                    setcookie('email', '', time() - 3600, "/"); // Efface le cookie
                    setcookie('password', '', time() - 3600, "/"); // Efface le cookie
                }
            
                // Redirection vers accueil
                header("Location: accueil.php");
                exit();
            } else {
                $message = "Mot de passe incorrect.";
            }
        } else {
            $message = "Email non trouvé.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
    
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
            justify-content: space-between; /* Équilibre les éléments */
            padding: 0 20px;
            z-index: 100;
        }

        .topbar img {
            width: 150px;
            height: auto;
            position: absolute;
            left: 50%;
            transform: translateX(-50%); /* Centre parfaitement */
            margin-top: 10px;
        }

        .heart-circle {
            width: 30px;
            height: 30px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .heart-circle i {
            font-size: 18px;
            color: #f99a04;
        }

        a {
            text-decoration: none;
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
            height: calc(100vh - 150px);
        }

        .card {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card h4 {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card p {
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #f0f0f0;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .form-options label {
            font-size: 15px;
        }

        .form-options a {
            color: orange;
            text-decoration: none;
            font-size: 15px;
            font-weight: bold;
        }

        .btn-submit {
            width: 100%;
            background-color: orange;
            color: white;
            border: none;
            padding: 5px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            margin-bottom: 15px;
        }

        .register-text {
            text-align: center;
            margin-top: 10px;
            font-size: 15px;
        }

        .register-text a {
            color: orange;
            text-decoration: none;
            font-weight: bold;
        }

        .alert {
            display: none; /* Caché par défaut */
            justify-content: center;
            align-items: center;
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            text-align: justify;
            width: 100%;
            height: 45px;
            font-weight: bold;
        }


    </style>
</head>
<body>
    <div class="topbar">
        <a href="index.php">
            <div class="heart-circle top-left"><i class="fas fa-arrow-left"></i></div>
        </a>
        <img width="100px" src="images/logo.png" alt="Logo">
    </div>

    <main>
        <div class="card">
            <?php if (isset($message)) : ?>
                <div class="alert" style="display:block;">
                    <i class="fas fa-info-circle"></i> <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <h4>Connectez vous avec votre compte</h2>
            <form id="login-form" method="POST">
                <div class="form-group">
                    <label for="email">Votre email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($saved_email); ?>" required>
                    </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($saved_password); ?>" required>
                </div>
                <div class="form-options">
                    <label>
                        <input type="checkbox" name="remember" <?php if (!empty($saved_email)) echo 'checked'; ?>> Se souvenir de moi
                    </label>
                    <a href="#">Mot de passe oublié?</a>
                </div>
                <button type="submit" class="btn-submit">Se connecter</button>
            </form>
            <p class="register-text">Vous n'avez pas encore de compte? <a href="index.php">Inscrivez-vous</a></p>
        </div>
    </main>
    <script>
    </script>
    
</body>
</html>
