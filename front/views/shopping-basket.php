<?php
require_once "layout/header.php";
?>

<section class="container cart-page">
    <h1 class="shop-page__title">Mon panier</h1>
    <div class="cart-page__inner">

        <section class="cart-items">
            <?php
            foreach ($data as $product) {
                echo '
                <article class="cart-item" data-id="' . $product['id'] . '">
                    <div class="cart-item__info">
                        <img src="../public/images/' . $product['image'] . '" alt="' . $product['product_name'] . '" class="cart-item__img">
                        <div>
                            <p class="cart-item__badge">' . $product['category_name'] . '</p>
                            <h2 class="cart-item__name">' . $product['product_name'] . '</h2>
                            <p class="cart-item__price">' . $product['price'] . ' €</p>
                        </div>
                    </div>
                    <div class="cart-item__controls">
                        <div class="product-detail__qty m0">
                            <button aria-label="Diminuer la quantité" class="decrease">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <input type="number" value="' . $product['quantity'] . '" min="1" max="' . $product['stock'] . '" aria-label="Quantité" class="qty">
                            <button aria-label="Augmenter la quantité" class="add">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>

                        <button class="cart-item__delete" aria-label="Supprimer l’article" data-id="' . $product['id'] . '">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                </article>
                ';
            }
            ?>
        </section>

        <aside class="cart-summary">
            <h2 class="cart-summary__title">Récapitulatif</h2>
            <div class="cart-summary__line">
                <span>Sous-total</span>
                <span id="total"><?php echo $total ?> €</span>
            </div>

            <div class="cart-summary__line">
                <span>Livraison</span>
                <span id="delivery"><?php echo $delivery === 0 ? 'Offerte' : $delivery ?></span>
            </div>

            <p class="cart-summary__note" id="comment"><?php echo $delivery === 0 ? '' : "Plus que $deliveryMissing € pour la livraison offerte" ?></p>

            <div class="cart-summary__line cart-summary__line--total">
                <span>Total</span>
                <span id="finalTotal"><?php echo $finalTotal ?> €</span>
            </div>

            <div class="cart-summary__checkout">
                <button>VALIDER LA COMMANDE</button>
            </div>

            <a href="../back/router.php?action=shop-view" class="cart-summary__continue"><p>CONTINUER MES ACHATS</p></a>

        </aside>

    </div>

</section>

<script src="../front/js/functions.js"></script>
<script src="../front/js/shopping-basket.js"></script>

<?php
require_once "layout/footer.php";
?>
