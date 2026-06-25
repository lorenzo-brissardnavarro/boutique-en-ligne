<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?> - Sakura Moon Créations</title>
    <meta name="description" content=<?php echo $pageDescription ?>>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="all" />
    <?php
    if(!empty($_SESSION['user_id'])){
        echo '<meta name="csrf-token" content="' . $_SESSION['csrf_token'] . '">';
    }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../front/style/css/style.css">
    <link rel="icon" type="image/webp" href="../front/images/favicon.webp">
    <script src="../front/js/menu.js" defer></script>
    <script src="../front/js/logout.js" defer></script>
</head>

<body id="body">
   <header class="header">
        <nav class="header__bar">

            <a href="../index.php" class="menu__logo">
                <img src="../front/images/logo.webp" alt="Logo de Sakura Moon">
            </a>

            <i class="fa-solid fa-bars" id="toggler"></i>

            <ul class="menu__listing menu__listing--none">
                <?php 
                if(!empty($_SESSION['user_id'])) {
                    if ($_SESSION['role_name'] === 'admin') {
                        echo '
                        <li>
                            <a href="../back/router.php?action=admin-view" aria-label="Dashboard Admin">
                                <i class="fa-solid fa-users-gear"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="logout" aria-label="Déconnexion">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </a>
                        </li>
                        ';

                    } else {
                        echo '
                        <li>
                            <a href="../back/router.php?action=shop-view" aria-label="Boutique">
                                <i class="fa-solid fa-shop"></i>
                            </a>
                        </li>
                        <li>
                            <a href="../back/router.php?action=profile-view" aria-label="Profil utilisateur">
                                <i class="fa-solid fa-user"></i>
                            </a>
                        </li>
                        <li>
                            <a href="../back/router.php?action=caddie-view" aria-label="Panier">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span id="caddie-count">' . $caddieCount . '</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="logout" aria-label="Déconnexion">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </a>
                        </li>
                        ';

                    }
                } else {
                    echo '
                    <li>
                        <a href="../back/router.php?action=home">Accueil</a>
                    </li>
                    <li>
                        <a href="../back/router.php?action=shop-view">Boutique</a>
                    </li>
                    <li>
                        <a href="../back/router.php?action=register-view">S\'inscrire</a>
                    </li>
                    <li>
                        <a href="../back/router.php?action=login-view">Se connecter</a>
                    </li>
                    ';
                }
                ?>
            </ul>
        </nav>

        <div class="menu" id="menu">
            <ul class="menu__listing menu__listing--burger">
                <?php
                if(!empty($_SESSION['user_id'])) {
                    if ($_SESSION['role_name'] === 'admin') {
                        echo '
                        <li>
                            <a href="../back/router.php?action=admin-view" aria-label="Dashboard Admin">
                                <i class="fa-solid fa-users-gear"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="logout" aria-label="Déconnexion">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </a>
                        </li>
                        ';

                    } else {
                        echo '
                        <li>
                            <a href="../back/router.php?action=shop-view" aria-label="Boutique">
                                <i class="fa-solid fa-shop"></i>
                            </a>
                        </li>
                        <li>
                            <a href="../back/router.php?action=profile-view" aria-label="Profil utilisateur">
                                <i class="fa-solid fa-user"></i>
                            </a>
                        </li>
                        <li>
                            <a href="../back/router.php?action=caddie-view" aria-label="Panier">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span id="caddie-count">' . $caddieCount . '</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="logout" aria-label="Déconnexion">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </a>
                        </li>
                        ';

                    }
                } else {
                    echo '
                    <li>
                        <a href="../back/router.php?action=home.php">Accueil</a>
                    </li>
                    <li>
                        <a href="../back/router.php?action=shop-view">Boutique</a>
                    </li>
                    <li>
                        <a href="../back/router.php?action=register-view">S\'inscrire</a>
                    </li>
                    <li>
                        <a href="../back/router.php?action=login-view">Se connecter</a>
                    </li>
                    ';
                }
                ?>
            </ul>
        </div>

    </header>

<main>