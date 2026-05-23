<?php
require_once "layout/header.php";
?>

<section class="container cart-page">
    <h1 class="shop-page__title">Mon panier</h1>
    <div class="cart-page__inner">

        <section class="cart-items">
            <article class="cart-item">
                <div class="cart-item__info">
                    <img src="../images/hero.png" alt="Boucles d’oreilles poisson argent" class="cart-item__img">
                    <div>
                        <p class="cart-item__badge">Bijoux</p>
                        <h2 class="cart-item__name">Boucles d’oreilles poisson argent</h2>
                        <p class="cart-item__price">24.99 €</p>
                    </div>
                </div>
                <div class="cart-item__controls">
                    <div class="product-detail__qty m0">
                        <button aria-label="Diminuer la quantité">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <input type="number" value="1" min="1" aria-label="Quantité">
                        <button aria-label="Augmenter la quantité">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>

                    <button class="cart-item__delete" aria-label="Supprimer l’article">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </article>
        </section>

        <aside class="cart-summary">
            <h2 class="cart-summary__title">Récapitulatif</h2>
            <div class="cart-summary__line">
                <span>Sous-total</span>
                <span>40.98 €</span>
            </div>

            <div class="cart-summary__line">
                <span>Livraison</span>
                <span>3.99 €</span>
            </div>

            <p class="cart-summary__note">Plus que 9.02 € pour la livraison offerte.</p>

            <div class="cart-summary__line cart-summary__line--total">
                <span>Total</span>
                <span>44.97 €</span>
            </div>

            <div class="cart-summary__checkout">
                <button>VALIDER LA COMMANDE</button>
            </div>

            <button class="cart-summary__continue">CONTINUER MES ACHATS</button>

        </aside>

    </div>

</section>

<?php
require_once "layout/footer.php";
?>
