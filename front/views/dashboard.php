<?php
require_once "layout/header.php";
?>

<section class="container admin-page">
    <h1 class="shop-page__title">Dashboard admin</h1>

    <section class="admin-page__section">

        <div class="admin-page__section-header">
            <h2 class="admin-page__section-title">Gestion des produits</h2>
            <button class="admin-btn" id="addProductBtn">AJOUTER UN PRODUIT</button>
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

    <div class="modal" id="addProductModal">
        <div class="modal__content modal__content--product">
            <i class="fa-solid fa-xmark" id="closeBtn"></i>

            <form action="" method="post" enctype="multipart/form-data" id="addProductForm">
                <h3>Image de couverture</h3>
                <label for="cover" class="cover-upload">
                    <img id="previewImage" alt="Image prévisualisée">
                    <div class="inputImage">
                        <i class="fa-solid fa-image"></i>
                        <span>Choisir une image (5 Mo max)</span>
                    </div>
                </label>

                <input type="file" id="cover" name="cover" accept="image/*" required>

                <label for="files">Images supplémentaires</label>
                <input type="file" id="files" name="files[]" accept="image/*" multiple>

                <input type="text" name="name" placeholder="Nom du produit" maxlength="100" required>
                <textarea name="description" placeholder="Description du produit" rows="3" required></textarea>
                <div>
                    <input type="number" name="price" placeholder="Prix" min="0" step="0.01" required>
                    <input type="number" name="stock" placeholder="Stock disponible" min="0" step="1" required>
                </div>
                
                <label for="category">Catégorie</label>
                <select name="category_id" id="category" required>
                    <option value="">-- Sélectionner une catégorie --</option>
                    <?php 
                    foreach ($categories as $category){
                        echo '
                        <option value="' . $category['id'] . '">' . htmlspecialchars($category['category_name']) . '</option>
                        ';
                    }
                    ?>  
                </select>

                <label class="checkbox-container">
                    <input type="checkbox" name="is_active" value="1">Afficher le produit immédiatement
                </label>

                <input type="submit" value="Enregistrer le produit" class="input-button">
            </form>

        </div>
    </div>

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

<script src="../front/js/functions.js"></script>
<script src="../front/js/admin.js"></script>

<?php
require_once "layout/footer.php";
?>