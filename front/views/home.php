<?php
require_once "layout/header.php";
?>

<section class="hero">
    <div class="container hero__content">

        <div class="hero__text">
            <div class="hero__subtitle">
                <div></div>
                <p>MAISON ARTISANALE</p>
            </div>

            <h1>Des créations artisanales <span>inspirées de l’Asie</span></h1>
            <p>Pochettes brodées, sacs sashiko, foulards en soie, accessoires cheveux : chaque pièce est imaginée et cousue à la main dans notre atelier, avec des tissus choisis pour leur beauté et leur tenue dans le temps.</p>

            <a href="../back/router.php?action=shop-categories" class="hero__btn">
                <div>
                    <p>DÉCOUVRIR LA BOUTIQUE</p>
                    <i class="fa-solid fa-arrow-right-long"></i>
                </div>
            </a>
        </div>

        <div class="hero__image">
            <img src="../front/images/hero.png" alt="Image illustrant l'univers et les produits proposés par l'entreprise">
        </div>

    </div>
</section>


<section class="services">
    <div class="container services__grid">

        <article class="services__item">
            <div class="icon">
                <i class="fa-regular fa-heart"></i>
            </div>

            <h3>Fait Main</h3>
            <p>Chaque pièce est unique</p>
        </article>

        <article class="services__item">
            <div class="icon">
                <i class="fa-solid fa-shield"></i>
            </div>

            <h3>Qualité premium</h3>
            <p>Matériaux sélectionnés</p>
        </article>

        <article class="services__item">
            <div class="icon">
                <i class="fa-solid fa-truck"></i>
            </div>

            <h3>Livraison soignée</h3>
            <p>Emballage élégant</p>
        </article>

        <article class="services__item">
            <div class="icon">
                <i class="fa-regular fa-star"></i>
            </div>

            <h3>Satisfaction garantie</h3>
            <p>Service client dédié</p>
        </article>

    </div>
</section>


<section class="products">
    <div class="container">

        <div class="section-title">
            <h2>Produits phares</h2>
            <p>Découvrez nos créations les plus appréciées par notre communauté</p>
        </div>

        <div class="products__grid" id="GridTopProducts">
            <?php
            foreach ($top as $product) {
                echo '
                <a href="../back/router.php?action=product-details&id=' . $product['id'] . '" class="product-card">
                    <article>
                        <div class="product-card__badge">' . $product['category_name'] . '</div>

                            <div class="product-card__image">
                                <img src="../public/images/' . $product['image'] . '" alt="' . $product['product_name'] . '">
                            </div>

                            <div class="product-card__content product-card__content--beige">

                                <h3>' . $product['product_name'] . '</h3>

                                <div class="product-card__bottom">
                                    <p class="product-card__price">' . $product['price'] . ' €</p>

                                    <button class="product-card__cart" type="button">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </button>
                                </div>

                            </div>
                    </article>
                </a>
                ';
            }
            ?>
        </div>

        <div class="products__button">
            <a href="../back/router.php?action=shop-categories">Voir toute la boutique</a>
        </div>

    </div>
</section>


<section class="news">
    <div class="container">

        <div class="section-title">
            <h2>Nouveautés</h2>
            <p>Les dernières créations ajoutées à notre collection</p>
        </div>

        <div class="products__grid" id="GridNewsProducts">
            <?php
            foreach ($news as $product) {
                echo '
                <a href="../back/router.php?action=product-details&id=' . $product['id'] . '" class="product-card">
                    <article>
                        <div class="product-card__badge">' . $product['category_name'] . '</div>

                            <div class="product-card__image">
                                <img src="../public/images/' . $product['image'] . '" alt="' . $product['product_name'] . '">
                            </div>

                            <div class="product-card__content product-card__content--beige">

                                <h3>' . $product['product_name'] . '</h3>

                                <div class="product-card__bottom">
                                    <p class="product-card__price">' . $product['price'] . ' €</p>

                                    <button class="product-card__cart" type="button">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </button>
                                </div>

                            </div>
                    </article>
                </a>
                ';
            }
            ?>
        </div>

    </div>
</section>


<section class="brand">
    <div class="container brand__content">

        <div class="brand__left">
            <span class="brand__left--content">LA MAISON SAKURA MOON</span>

            <h2>L'art de la lenteur, <span class="brand__left--title">cousu à la main.</span></h2>
        </div>

        <div class="brand__right">
            <p>Sakura Moon Créations est née d'une passion pour l'art asiatique traditionnel et le travail minutieux de la couture. Chaque pièce est conçue avec soin, tout en y apportant une touche moderne.</p>

            <p>Notre mission est de partager la beauté et l'élégance de la culture asiatique à travers des créations uniques et durables, faites avec amour.</p>
        </div>

    </div>
</section>


<section class="reviews">
    <div class="container">

        <div class="section-title">
            <h2>Avis clients</h2>
            <p>Ce que nos clients disent de nos créations</p>
        </div>

        <div class="reviews__grid">

            <article class="review-card">

                <div class="review-card__stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>

                <p>« La pochette est encore plus belle en vrai. Le travail de broderie est incroyable, on sent l'amour mis dans chaque détail. »</p>

                <strong>Marie L</strong>

            </article>

            <article class="review-card">

                <div class="review-card__stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>

                <p>« L'attention aux détails est impressionnante. Chaque pièce est unique et soigneusement confectionnée. »</p>

                <strong>Sophie D</strong>

            </article>

            <article class="review-card">

                <div class="review-card__stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>

                <p>« Un vrai coup de cœur pour cette boutique ! Les produits sont authentiques et le service impeccable. »</p>

                <strong>Amélie R</strong>

            </article>

        </div>

    </div>
</section>

<section class="newsletter">
    <div class="container">

        <h2>Recevez nos nouveautés en avant-première</h2>

        <p>Inscrivez-vous à notre newsletter pour recevoir en avant-première nos nouvelles créations et offres exclusives</p>

        <form action="" method="get">
            <input type="email" name="email" id="email" placeholder="Votre adresse mail"/>
            <button type="submit">S'inscrire</button>
        </form>

    </div>
</section>

<?php
require_once "layout/footer.php";
?>