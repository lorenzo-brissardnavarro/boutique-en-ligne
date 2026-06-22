<?php
$pageTitle = 'Panier';
$pageDescription = 'Consultez votre panier Sakura Moon, vérifiez vos articles sélectionnés et finalisez votre commande en toute simplicité.';
require_once "layout/header.php";
?>

<section class="container cart-page">
    <h1 class="shop-page__title">Mon panier</h1>
        <?php

        if (!empty($data)) {

            echo '<div class="cart-page__inner">';
                echo '<section class="cart-items">';

                foreach ($data as $product) {
                    echo '
                    <article class="cart-item" data-id="' . $product['id'] . '">
                        <div class="cart-item__info">
                            <img src="../public/images/' . $product['image'] . '" alt="' . $product['product_name'] . ' - création artisanale japonaise" class="cart-item__img">
                            <div>
                                <p class="cart-item__badge">' . $product['category_name'] . '</p>
                                <h2 class="cart-item__name">' . $product['product_name'] . '</h2>
                                <span class="cart-item__price">' . $product['price'] . ' €</span>
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

                echo '</section>';

                echo '
                <aside class="cart-summary">
                    <h2 class="cart-summary__title">Récapitulatif</h2>

                    <div class="cart-summary__line">
                        <span>Sous-total</span>
                        <span id="total">' . $total . ' €</span>
                    </div>

                    <div class="cart-summary__line">
                        <span>Livraison</span>
                        <span id="delivery">' . ($delivery === 0 ? 'Offerte' : $delivery . ' €') . '</span>
                    </div>

                    <p class="cart-summary__note" id="comment">' .
                        ($delivery === 0 ? '' : "Plus que $deliveryMissing € pour la livraison offerte.") .
                    '</p>

                    <div class="cart-summary__line cart-summary__line--total">
                        <span>Total</span>
                        <span id="finalTotal">' . $finalTotal . ' €</span>
                    </div>

                    <div class="cart-summary__checkout">
                        <button>VALIDER LA COMMANDE</button>
                    </div>

                    <a href="../back/router.php?action=shop-view" class="cart-summary__continue"><p>CONTINUER MES ACHATS</p></a>
                </aside>';

                echo '</div>';

            } else {

                echo '
                <section class="container page-404">
                    <p class="page-404__label">Votre panier est vide.</p>
                    <a href="../back/router.php?action=shop-view" class="page-404__cta">Aller à la boutique</a>
                </section>';
            }

            ?>

    </div>

</section>

<script src="../front/js/functions.js" defer></script>
<script src="../front/js/shopping-basket.js" defer></script>
<script src="../front/js/order.js" defer></script>

<?php
require_once "layout/footer.php";
?>
