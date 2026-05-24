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
            <article class="admin-product-card">
                <img src="../images/hero.png" alt="Boucles d’oreilles poisson argent" class="admin-product-card__img">

                <div class="admin-product-card__info">
                    <h3 class="admin-product-card__name">Boucles d’oreilles poisson argent</h3>
                    <p class="admin-product-card__meta">Bijoux - <span>24.99 €</span></p>
                    <p class="admin-product-card__stock">5 en stock</p>
                    <p class="admin-product-card__desc">Élégantes et raffinées, ces boucles d’oreilles en forme de poisson Betta offrent un design délicat aux détails finement sculptés.</p>

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
        </div>
    </section>

    <section class="admin-page__section">

        <div class="admin-page__section-header">
            <h2 class="admin-page__section-title">Gestion des catégories</h2>
            <button class="admin-btn">AJOUTER UNE CATÉGORIE</button>
        </div>

        <div class="admin-categories">

            <article class="admin-category-tag">
                <h3>BIJOUX</h3>
                <div>
                    <button class="admin-product-card__icon-btn admin-product-card__icon-btn--edit" aria-label="Modifier la catégorie">
                        <i class="fa-solid fa-pen"></i>
                    </button>

                    <button class="admin-product-card__icon-btn admin-product-card__icon-btn--delete" aria-label="Supprimer la catégorie">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </article>

            <article class="admin-category-tag">
                <h3>ACCESSOIRES</h3>
                <div>
                    <button class="admin-product-card__icon-btn admin-product-card__icon-btn--edit" aria-label="Modifier la catégorie">
                        <i class="fa-solid fa-pen"></i>
                    </button>

                    <button class="admin-product-card__icon-btn admin-product-card__icon-btn--delete" aria-label="Supprimer la catégorie">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </article>
        </div>
    </section>
</section>

<?php
require_once "layout/footer.php";
?>