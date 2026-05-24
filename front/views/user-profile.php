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

            <h2 class="profile-sidebar__name">Marie Dupont</h2>
            <p class="profile-sidebar__email">marie@example.com</p>

            <nav class="profile-sidebar__nav">
                <button class="active">
                    <i class="fa-solid fa-box-open"></i>
                    Mes commandes
                </button>
                <button>
                    <i class="fa-regular fa-heart"></i>
                    Mes favoris
                </button>
                <button>
                    <i class="fa-solid fa-gear"></i>
                    Paramètres
                </button>
            </nav>
        </aside>

        <section class="orders">
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
    </div>
</section>

<?php
require_once "layout/footer.php";
?>