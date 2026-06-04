<?php
require_once "layout/header.php";
?>

<section class="container product-detail">

    <a href="shop.php" class="product-detail__back">
        <i class="fa-solid fa-arrow-left-long"></i>
        <span>Retour</span>
    </a>

    <div class="product-detail__inner">
        <div class="product-detail__gallery">
            <div>
                <img src="" alt="" class="product-detail__main-img">
            </div>
            <div class="product-detail__thumbs">
                <img src="" alt="" class="product-detail__thumb product-detail__thumb--active">
                <img src="" alt="" class="product-detail__thumb">
            </div>
        </div>

        <div class="product-detail__content">
            <span class="product-detail__badge">Bijoux</span>

            <h1 class="product-detail__name">Boucles d'oreilles poisson argent</h1>
            <p class="product-detail__price">24.99 €</p>
            <p class="product-detail__desc">Élégantes et raffinées, ces boucles d’oreilles en forme de poisson Betta offrent un design délicat aux détails finement sculptés. Leur style poétique et artisanal apporte une touche unique et sophistiquée à toute tenue.</p>

            <div class="product-detail__stock">
                <p>Disponibilité : <span>5 en stock</span></p>
            </div>

            <div class="product-detail__qty">
                <button aria-label="Diminuer la quantité">
                    <i class="fa-solid fa-minus"></i>
                </button>
                <input type="number" value="1" min="1" aria-label="Quantité">

                <button aria-label="Augmenter la quantité">
                    <i class="fa-solid fa-plus"></i>
                </button>

            </div>

            <div class="product-detail__actions">

                <button class="product-detail__add-to-cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Ajouter au panier
                </button>

                <button class="product-detail__wishlist" aria-label="Ajouter aux favoris">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<?php
require_once "layout/footer.php";
?>