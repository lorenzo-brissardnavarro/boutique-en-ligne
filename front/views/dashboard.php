<?php
require_once "layout/header.php";
?>

<section class="container admin-page">
    <h1 class="shop-page__title">Dashboard admin</h1>

    <section class="admin-page__section">

        <div class="admin-page__section-header">
            <h2 class="admin-page__section-title">Gestion des produits</h2>
            <button class="admin-btn">AJOUTER UN PRODUIT</button>
        </div>

        <div class="admin-products">
            <?php
            if(!empty($products)){
                foreach ($products as $product) {
                    echo '
                    <article class="admin-product-card">
                        <img src="../public/images/' . $product['image'] . '" alt="' . $product['product_name'] . '" class="admin-product-card__img">

                        <div class="admin-product-card__info">
                            <h3 class="admin-product-card__name">' . $product['product_name'] . '</h3>
                            <p class="admin-product-card__meta">' . $product['category_name'] . ' - <span>' . $product['price'] . ' €</span></p>';
                            echo $product['stock'] > 0
                                ? '<span class="admin-product-card__stock admin-product-card__stock--green">' . $product['stock'] . ' en stock</span>'
                                : '<span class="admin-product-card__stock admin-product-card__stock--red">Rupture de stock</span>';

                            echo '
                            <p class="admin-product-card__desc">' . $product['description'] . '</p>

                            <div class="admin-product-card__actions">
                                <button class="admin-product-card__icon-btn admin-product-card__icon-btn--edit" aria-label="Modifier le produit">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <button class="admin-product-card__icon-btn admin-product-card__icon-btn--delete" aria-label="Supprimer le produit">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>

                            </div>
                        </div>
                    </article>
                    ';
                }
            } else {
                echo '<p>Aucun produit mis en vente pour le moment</p>';
            }
            ?>
        </div>
    </section>

    <section class="admin-page__section">

        <div class="admin-page__section-header">
            <h2 class="admin-page__section-title">Gestion des catégories</h2>
            <button class="admin-btn">AJOUTER UNE CATÉGORIE</button>
        </div>

        <div class="admin-categories">
            <?php
            if(!empty($categories)) {
                foreach ($categories as $category) {
                    echo '
                        <article class="admin-category-tag">
                            <h3>' . $category['category_name'] . '</h3>
                            <div>
                                <button class="admin-product-card__icon-btn admin-product-card__icon-btn--edit" aria-label="Modifier la catégorie">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <button class="admin-product-card__icon-btn admin-product-card__icon-btn--delete" aria-label="Supprimer la catégorie">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </article>
                    ';
                }
            } else {
                echo '<p>Aucune catégorie disponible pour le moment</p>';
            }
            ?>
        </div>
    </section>
</section>

<?php
require_once "layout/footer.php";
?>