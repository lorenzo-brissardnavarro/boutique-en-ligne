<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sakura Moon Créations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../front/style/css/style.css">
    <link rel="icon" type="image/png" href="">
    <script src="../front/js/menu.js" defer></script>
    <script src="../front/js/logout.js" defer></script>
</head>

<body id="body">
   <header class="header">
        <nav class="header__bar">

            <a href="../index.php" class="menu__logo">
                <img src="../front/images/logo.png" alt="Logo de Sakura Moon">
            </a>

            <i class="fa-solid fa-bars" id="toggler"></i>

            <ul class="menu__listing menu__listing--none">
                <?php 
                if(!empty($_SESSION['user_id'])) {
                    echo '
                    <li>
                        <a href="../back/router.php?action=shop-view">
                            <i class="fa-solid fa-shop"></i>
                        </a>
                    </li>
                    <li>
                        <a href="../back/router.php?action=profile-view">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="../back/router.php?action=caddie-view">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span id="caddie-count">' . $caddieCount . '</span>
                        </a>
                    </li>
                    <li>
                        <a href="" id="logout">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </a>
                    </li>
                    ';
                } else {
                    echo '
                    <li>
                        <a href="../index.php">Accueil</a>
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
                    echo '
                    <li>
                        <a href="../back/router.php?action=shop-view">
                            <i class="fa-solid fa-shop"></i>
                        </a>
                    </li>
                    <li>
                        <a href="../back/router.php?action=profile-view">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="../back/router.php?action=caddie-view">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span id="caddie-count">' . $caddieCount . '</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="logout">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </a>
                    </li>
                    ';
                } else {
                    echo '
                    <li>
                        <a href="../index.php">Accueil</a>
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