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
    <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'accueil.php') ? 'active' : ''; ?>" href="accueil.php" title="Accueil">
        <i class="fas fa-house-chimney icon"></i><span>Accueil</span>
    </a>
    <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'search.php') ? 'active' : ''; ?>" href="search.php" title="Recherche">
        <i class="fas fa-search icon"></i><span>Recherche</span>
    </a>
    <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'publier.php') ? 'active' : ''; ?>" href="publier.php" title="Publier">
        <i class="fas fa-plus-circle icon"></i><span>Publier</span>
    </a>
    <a class="<?php echo (basename($_SERVER['PHP_SELF']) == '#') ? 'active' : ''; ?>" href="#" title="Messages">
        <i class="fas fa-heart icon"></i><span>Favoris</span>
    </a>
    <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'compte.html') ? 'active' : ''; ?>" href="compte.html" title="Compte">
        <i class="fas fa-user icon"></i><span>Compte</span>
    </a>
</div>
