<?php
$pageTitle = 'Page détails';
$pageDescription = 'Découvrez les détails de ce produit Sakura Moon : description, caractéristiques, prix et disponibilité.';
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
                <?php echo '<img src="../public/images/' . $product['image'] . '" alt="' . $product['product_name'] . ' - création artisanale japonaise" class="product-detail__main-img" id="mainImage"> '?>
            </div>
            <div class="product-detail__thumbs">
                <?php echo '<img src="../public/images/' . $product['image'] . '" alt="' . $product['product_name'] . ' - création artisanale japonaise - vue 1" class="product-detail__thumb product-detail__thumb--active">'?>
                <?php
                foreach ($additionalImages as $index => $image) {
                    echo '
                        <img src="../public/images/' . $image['image'] . '" alt="' . $product['product_name'] . ' - création artisanale japonaise - vue ' . ($index + 2) . '" loading="lazy" class="product-detail__thumb">
                    ';
                } 
                ?>
            </div>
        </div>

        <div class="product-detail__content">
            <span class="product-detail__badge"><?php echo $product['category_name'] ?></span>

            <h1 class="product-detail__name"><?php echo $product['product_name'] ?></h1>
            <span class="product-detail__price"><?php echo $product['price'] ?> €</span>
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
                <button aria-label="Diminuer la quantité" id="decrease">
                    <i class="fa-solid fa-minus"></i>
                </button>
                <input type="number" value="1" min="1" max="<?php echo $product['stock']; ?>" aria-label="Quantité" id="qty">

                <button aria-label="Augmenter la quantité" id="add">
                    <i class="fa-solid fa-plus"></i>
                </button>

            </div>

            <div class="product-detail__actions">

                <button class="product-detail__add-to-cart" id="addCaddie" data-id="<?php echo $product['id'] ?>">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Ajouter au panier
                </button>

                <button class="product-detail__wishlist  <?php echo $isFavorite ? 'product-detail__wishlist--liked' : '' ?>" id="favoriteBtn" aria-label="Ajouter aux favoris" data-id="<?php echo $product['id'] ?>">
                    <i id="favoriteIcon" class="<?php echo $isFavorite ? 'fa-solid' : 'fa-regular' ?> fa-heart"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<script src="../front/js/functions.js" defer></script>
<script src="../front/js/product-details.js" defer></script>
<script src="../front/js/caddie-details.js" defer></script>
<script src="../front/js/like.js" defer></script>

<?php
require_once "layout/footer.php";
?>