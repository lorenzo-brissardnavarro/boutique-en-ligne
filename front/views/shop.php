<?php
require_once "layout/header.php";
?>

<section class=" container shop-page">

    <div class="shop-page__header">
        <h1 class="shop-page__title">Notre boutique</h1>
        <p class="shop-page__desc">
            Découvrez toutes nos créations artisanales
        </p>
    </div>

    <form action="" method="get" class="shop-page__toolbar">

        <div class="shop-page__search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" name="search" placeholder="Rechercher un produit...">
        </div>

        <select name="platform" id="platform-select" class="shop-page__sort">
            <option value="all">Trier</option>
            <option value="az">Ordre alphabétique A-Z</option>
            <option value="za">Ordre alphabétique Z-A</option>
            <option value="croissant">Prix croissant</option>
            <option value="decroissant">Prix décroissant</option>
        </select>
    </form>

    <div class="shop-page__layout">

        <aside class="filters">
            <div class="filters__section">
                <p class="filters__title">Catégories</p>
                <div class="filters__tags">
                    <button class="filters__tag filters__tag--active" data-status="all">Toutes les catégories</button>
                </div>
            </div>

            <div class="filters__section">
                <p class="filters__title">Prix</p>
                <form action="" method="get" class="filters__price">
                    <input type="number" name="min" id="min" placeholder="Min">
                    <span>—</span>
                    <input type="number" name="max" id="max" placeholder="Max">
                </form>
            </div>

            <div class="filters__section">
                <p class="filters__title">Disponibilité</p>
                <label for="disponibilite" class="filters__checkbox">
                    <input type="checkbox" name="disponibilite" id="disponibilite">En stock uniquement</label>
            </div>
        </aside>

        <div class="shop-grid">
            <article class="product-card">
                <div class="product-card__badge">Bijoux</div>
                <div class="product-card__image">
                    <img src="" alt="">
                </div>
                <div class="product-card__content">
                    <h3>Boucles d'oreilles poisson argent</h3>
                    <div class="product-card__bottom">
                        <p class="product-card__price">24.99 €</p>
                        <button class="product-card__cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </div>
                </div>
            </article>

        </div>
    </div>
</section>

<?php
require_once "layout/footer.php";
?>