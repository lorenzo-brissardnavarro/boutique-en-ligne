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
                    <article class="admin-product-card" data-id="' . $product['id'] . '">
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
                                <button class="admin-product-card__icon-btn admin-product-card__icon-btn--edit edit-info-btn" aria-label="Modifier le produit" data-id="' . $product['id'] .'" data-name="' . htmlspecialchars($product['product_name']) . '" data-description="' . htmlspecialchars($product['description']) . '" data-price="' . $product['price'] . '" data-stock="' . $product['stock'] . '" data-category="' . $product['category_id'] . '" data-active="' . $product['is_active'] . '">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <button class="admin-product-card__icon-btn admin-product-card__icon-btn--edit edit-images-btn" aria-label="Modifier les images du produit" data-id="' . $product['id'] . '" data-cover="' . $product['image'] . '" data-images="' . htmlspecialchars(json_encode($product["images"])) . '" data-name="' . htmlspecialchars($product['product_name']) . '">
                                    <i class="fa-solid fa-file-image"></i>
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
                <div id="existingImages"></div>
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

    <div class="modal" id="editProductInfoModal">
        <div class="modal__content modal__content--product">
            <i class="fa-solid fa-xmark" id="closeBtnModalInfo"></i>

            <form action="" method="post" id="editProductInfoForm">
                <input type="hidden" name="product_idInfo" id="product_idInfo">
                <h3>Modifier les informations</h3>

                <input type="text" name="nameInfo" placeholder="Nom du produit" required>
                <textarea name="descriptionInfo" placeholder="Description du produit" rows="3" required></textarea>
                <div>
                    <input type="number" name="priceInfo" placeholder="Prix" min="0" step="0.01" required>
                    <input type="number" name="stockInfo" placeholder="Stock disponible" min="0" step="1" required>
                </div>
                
                <label for="category">Catégorie</label>
                <select name="category_idInfo" id="category" required>
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
                    <input type="checkbox" name="is_activeInfo" value="1">Afficher le produit immédiatement
                </label>

                <input type="submit" value="Modifier les informations" class="input-button">
            </form>

        </div>
    </div>

    <div class="modal" id="editProductImagesModal">
        <div class="modal__content modal__content--product">
            <i class="fa-solid fa-xmark" id="closeBtnModalImages"></i>

            <h3>Gestion des images</h3>

            <input type="hidden" id="images_product_id">
            <input type="hidden" id="images_product_name">
            <h4>Image de couverture</h4>
            <img id="previewCover">
            <input type="file" id="coverInput" name="cover" accept="image/*">

            <h4>Images supplémentaires</h4>
            <div id="galleryContainer"></div>
            <input type="file" id="galleryInput" name="files[]" multiple accept="image/*">

            <button id="saveImagesBtn" class="input-button">Enregistrer les images</button>

        </div>
    </div>

    <section class="admin-page__section">

        <div class="admin-page__section-header">
            <h2 class="admin-page__section-title">Gestion des catégories</h2>
            <button class="admin-btn" id="addCategoryBtn">AJOUTER UNE CATÉGORIE</button>
        </div>

        <div class="admin-categories">
            <?php
            if(!empty($categories)) {
                foreach ($categories as $category) {
                    echo '
                        <article class="admin-category-tag" data-id="' . $category['id'] .'">
                            <h3>' . $category['category_name'] . '</h3>
                            <div>
                                <button class="admin-product-card__icon-btn admin-product-card__icon-btn--edit edit-category-btn" aria-label="Modifier la catégorie" data-id="' . $category['id'] .'" data-name="' . htmlspecialchars($category['category_name']) . '">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <button class="admin-product-card__icon-btn admin-product-card__icon-btn--delete delete-category-btn" aria-label="Supprimer la catégorie" data-id="' . $category['id'] .'">
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

    <div class="modal" id="deleteCategoryModal">
        <div class="modal__content">
            <h3>Supprimer la catégorie</h3>
            <p>Cette action est irréversible.</p>
            <div class="modal__actions">
                <button id="cancelDelete" class="settings-card__actions--edit">Annuler</button>
                <button id="confirmDelete" class="settings-card__danger--delete">Oui, supprimer la catégorie</button>
            </div>

        </div>
    </div>

    <div class="modal" id="AddCategoryModal">
        <div class="modal__content modal__content--product">
            <i class="fa-solid fa-xmark" id="closeBtnModalAddCategory"></i>

            <form action="" method="post" id="addCategoryForm">

                <h3>Ajout d'une nouvelle catégorie</h3>

                <input type="text" name="categoryName" placeholder="Nom de la catégorie" required>

                <input type="submit" value="Ajouter la catégorie" class="input-button">
            </form>

        </div>
    </div>

    <div class="modal" id="updateCategoryModal">
        <div class="modal__content modal__content--product">
            <i class="fa-solid fa-xmark" id="closeBtnModalUpdateCategory"></i>

            <form action="" method="post" id="updateCategoryForm">
                <input type="hidden" id="category_id">
                <h3>Modification de la catégorie</h3>
                <input type="text" name="updateCategoryName" placeholder="Nom de la catégorie" required>
                <input type="submit" value="Modifier la catégorie" class="input-button">
            </form>

        </div>
    </div>
</section>

<script src="../front/js/functions.js"></script>
<script src="../front/js/admin.js"></script>

<?php
require_once "layout/footer.php";
?>