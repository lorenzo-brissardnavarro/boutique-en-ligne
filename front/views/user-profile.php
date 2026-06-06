<?php
require_once "layout/header.php";
?>

<section class="container profile-page">
    <h1 class="shop-page__title">Mon compte</h1>
    <div class="profile-page__inner">

        <aside class="profile-sidebar">
            <div class="profile-sidebar__avatar">
                <i class="fa-solid fa-user"></i>
            </div>

            <h2 class="profile-sidebar__name"><?php echo $user['firstname'] . ' ' . $user['surname'] ?></h2>
            <p class="profile-sidebar__email"><?php echo $user['email'] ?></p>

            <nav class="profile-sidebar__nav">
                <button class="active" data-tab="orders">
                    <i class="fa-solid fa-box-open"></i>
                    Mes commandes
                </button>
                <button data-tab="favorites">
                    <i class="fa-regular fa-heart"></i>
                    Mes favoris
                </button>
                <button data-tab="settings">
                    <i class="fa-solid fa-gear"></i>
                    Paramètres
                </button>
            </nav>
        </aside>

        <section class="orders profile-content visible" id="orders">
            <h2 class="orders__title">Mes commandes</h2>

            <article class="order-item">
                <div class="order-item__header">
                    <h3 class="order-item__num">Commande N° CDM-001</h3>
                    <div>
                        <span class="order-item__count">2 articles</span>
                        <span class="order-item__total">44.97 €</span>
                    </div>
                    
                </div>

                <div class="order-item__lines">
                    <div class="order-item__line">
                        <p>Boucles d’oreilles poisson argent ×1</p>
                        <span>24.99 €</span>
                    </div>

                    <div class="order-item__line">
                        <p>Trousse M Verte ×1</p>
                        <span>15.99 €</span>
                    </div>

                    <div class="order-item__line">
                        <p>Livraison</p>
                        <span>3.99 €</span>
                    </div>
                </div>
            </article>
        </section>

        <section class="profile-content" id="favorites">
            <h2 class="orders__title">Mes favoris</h2>
            <div class="shop-grid">
            <?php
            foreach ($favorites as $favorite) {
                echo '
                <a href="../back/router.php?action=product-details&id=' . $favorite['id'] . '" class="product-card">
                    <article>
                        <div class="product-card__badge">' . $favorite['category_name'] . '</div>

                            <div class="product-card__image">
                                <img src="../public/images/' . $favorite['image'] . '" alt="' . $favorite['product_name'] . '">
                            </div>

                            <div class="product-card__content product-card__content--beige">

                                <h3>' . $favorite['product_name'] . '</h3>

                                <div class="product-card__bottom">
                                    <p class="product-card__price">' . $favorite['price'] . ' €</p>

                                    <button class="product-card__cart" type="button">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </button>
                                </div>

                            </div>
                    </article>
                </a>
                ';
            }
            ?>
            </div>
        </section>

        <section class="profile-content" id="settings">
            <h2 class="orders__title">Paramètres</h2>
            <!-- contenu settings -->
        </section>
    </div>
</section>

<script src="../front/js/user-profile.js"></script>

<?php
require_once "layout/footer.php";
?>