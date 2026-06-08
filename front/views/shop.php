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
            <input type="search" name="search" placeholder="Rechercher un produit..." id="myKeyword">
            <div class="shop-page__autocomplete" id="autocomplete"></div>
        </div>

        <select name="sort" id="sort-select" class="shop-page__sort">
            <option value="all">Trier</option>
            <option value="name_asc">Nom A-Z</option>
            <option value="name_desc">Nom Z-A</option>
            <option value="price_asc">Prix croissant</option>
            <option value="price_desc">Prix décroissant</option>
        </select>
    </form>

    <div class="shop-page__layout">

        <aside class="filters">
            <div class="filters__section">
                <p class="filters__title">Catégories</p>
                <div class="filters__tags" id="categories">
                    <button class="filters__tag filters__tag--active" data-status="all">
                        Toutes les catégories
                    </button>

                    <?php
                    foreach ($categories as $category) {
                        echo '
                        <button class="filters__tag" data-status="' . htmlspecialchars($category['category_name']) . '">' . htmlspecialchars($category['category_name']) . '</button>
                        ';
                    }
                    ?>
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
                    <input type="checkbox" name="disponibilite" id="availability">En stock uniquement</label>
            </div>
        </aside>

        <div class="shop-grid" id="shop-grid">
            
        </div>
    </div>
</section>

<script src="../front/js/shop.js"></script>
<script src="../front/js/functions.js"></script>
<script src="../front/js/caddie-shop.js"></script>

<?php
require_once "layout/footer.php";
?>