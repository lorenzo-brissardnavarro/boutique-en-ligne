<?php
require_once "layout/header.php";
?>

<section class="container product-detail">

    <a href="../back/router.php?action=shop-view" class="product-detail__back">
        <i class="fa-solid fa-arrow-left-long"></i>
        <span>Retour</span>
    </a>

    <div class="product-detail__inner">
        <div class="product-detail__gallery">
            <div>
                <?php echo '<img src="../public/images/' . $product['image'] . '" alt="' . $product['product_name'] . '" class="product-detail__main-img" id="mainImage"> '?>
            </div>
            <div class="product-detail__thumbs">
                <?php echo '<img src="../public/images/' . $product['image'] . '" alt="' . $product['product_name'] . '" class="product-detail__thumb product-detail__thumb--active">'?>
                <?php
                foreach ($additionalImages as $image) {
                    echo '
                        <img src="../public/images/' . $image['image'] . '" alt="' . $product['product_name'] . '" class="product-detail__thumb">
                    ';
                } 
                ?>
            </div>
        </div>

        <div class="product-detail__content">
            <span class="product-detail__badge"><?php echo $product['category_name'] ?></span>

            <h1 class="product-detail__name"><?php echo $product['product_name'] ?></h1>
            <p class="product-detail__price"><?php echo $product['price'] ?> €</p>
            <p class="product-detail__desc"><?php echo $product['description'] ?></p>

            <div class="product-detail__stock">
                <p>Disponibilité :
                    <?php
                    echo $product['stock'] > 0
                        ? '<span class="product-detail__stock--green">' . $product['stock'] . ' en stock</span>'
                        : '<span class="product-detail__stock--red">Ce produit revient bientôt !</span>';
                    ?>
                </p>
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

<script src="../front/js/product-details.js"></script>

<?php
require_once "layout/footer.php";
?>