<!-- navbar.php -->
 <style>
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

 </style>
<div class="navbar">
    <a class="active" title="Accueil"><i class="fas fa-house-chimney icon"></i><span>Accueil</span></a>
    <a href="accueil.php" title="Recherche"><i class="fas fa-search icon"></i><span>Recherche</span></a>
    <a href="publier.php" title="Publier"><i class="fas fa-plus-circle icon"></i><span>Publier</span></a>
    <a href="#" title="Messages"><i class="fas fa-message icon"></i><span>Messages</span></a>
    <a href="compte.html" title="Compte"><i class="fas fa-user icon"></i><span>Compte</span></a>
</div>
