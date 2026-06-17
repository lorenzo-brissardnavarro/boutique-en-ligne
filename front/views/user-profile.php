<?php
require_once "layout/header.php";
?>

<section class="container profile-page">
    <h1 class="shop-page__title">Mon compte</h1>
    <div class="profile-page__inner">

        <aside class="profile-sidebar">
            <div class="profile-sidebar__avatar">
                <i class="fa-solid fa-user"></i>
            </div>

            <h2 class="profile-sidebar__name"><?php echo $user['firstname'] . ' ' . $user['surname'] ?></h2>
            <p class="profile-sidebar__email"><?php echo $user['email'] ?></p>

            <nav class="profile-sidebar__nav">
                <button class="active" data-tab="orders">
                    <i class="fa-solid fa-box-open"></i>
                    Mes commandes
                </button>
                <button data-tab="favorites">
                    <i class="fa-regular fa-heart"></i>
                    Mes favoris
                </button>
                <button data-tab="settings">
                    <i class="fa-solid fa-gear"></i>
                    Paramètres
                </button>
            </nav>
        </aside>

        <section class="orders profile-content visible" id="orders">
            <h2 class="orders__title">Mes commandes</h2>
            <?php
            if(!empty($orders)){
                foreach ($orders as $order) {
                    echo '
                    <article class="order-item">
                        <div class="order-item__header">
                            <h3 class="order-item__num">Commande N° ' . $order['number'] . '</h3>
                            <div>
                                <span class="order-item__count">' . $order['count'] . ' article' . ($order['count'] > 1 ? 's' : '') . '</span>
                                <span class="order-item__total">' . $order['total_price'] . ' €</span>
                            </div>
                            
                        </div>

                        <div class="order-item__lines">';
                            foreach ($order['products'] as $product) {
                                echo '
                                <div class="order-item__line">
                                    <p>' . $product['product_name'] . ' ×' . $product['quantity'] . '</p>
                                    <span>' . $product['quantity'] * $product['unit_price'] . ' €</span>
                                </div>
                                ';
                            }
                            if($order['total_price'] < 50){
                                echo '
                                <div class="order-item__line">
                                    <p>Livraison</p>
                                    <span>3.99 €</span>
                                </div>
                                ';
                            }
                        echo '
                        </div>
                    </article>
                    ';
                }
            } else {
                echo '<p>Aucune commande pour le moment</p>';
            }
            ?>
        </section>

        <section class="profile-content" id="favorites">
            <h2 class="orders__title">Mes favoris</h2>
            <div class="shop-grid">
            <?php
            if(!empty($favorites)) {
                foreach ($favorites as $favorite) {
                    echo '
                    <a href="../back/router.php?action=product-details&id=' . $favorite['id'] . '" class="product-card">
                        <article>
                            <div class="product-card__badge">' . $favorite['category_name'] . '</div>

                                <div class="product-card__image">
                                    <img src="../public/images/' . $favorite['image'] . '" alt="' . $favorite['product_name'] . '">
                                </div>

                                <div class="product-card__content product-card__content--beige">

                                    <h3>' . $favorite['product_name'] . '</h3>

                                    <div class="product-card__bottom">
                                        <span class="product-card__price">' . $favorite['price'] . ' €</span>

                                        <button class="product-card__cart" type="button" aria-label="Bouton pour ajouter le produit au panier">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </button>
                                    </div>

                                </div>
                        </article>
                    </a>
                    ';
                }
            } else {
                echo '<p>Aucun favori pour le moment</p>';
            }
            ?>
            </div>
        </section>

        <section class="profile-content" id="settings">
            <h2 class="orders__title">Paramètres</h2>
            <div class="settings-card">

                <div class="settings-card__section">
                    <h3>Informations personnelles</h3>

                    <div class="settings-card__row">
                        <span class="settings-card__label">Prénom :</span>
                        <span class="settings-card__value">
                            <?php echo htmlspecialchars($user['firstname']) ?>
                        </span>
                    </div>

                    <div class="settings-card__row">
                        <span class="settings-card__label">Nom :</span>
                        <span class="settings-card__value">
                            <?php echo htmlspecialchars($user['surname']) ?>
                        </span>
                    </div>

                    <div class="settings-card__row">
                        <span class="settings-card__label">Email :</span>
                        <span class="settings-card__value">
                            <?php echo htmlspecialchars($user['email']) ?>
                        </span>
                    </div>

                    <div class="settings-card__row">
                        <span class="settings-card__label">Téléphone :</span>
                        <span class="settings-card__value">
                            <?php echo htmlspecialchars($user['phone']) ?>
                        </span>
                    </div>

                    <div class="settings-card__row">
                        <span class="settings-card__label">Date d'anniversaire :</span>
                        <span class="settings-card__value">
                            <?php echo date('d/m/Y', strtotime($user['birthday'])) ?>
                        </span>
                    </div>

                    <div class="settings-card__row">
                        <span class="settings-card__label">Adresse postale :</span>
                        <span class="settings-card__value">
                            <?php echo htmlspecialchars($user['address']) ?>
                        </span>
                    </div>
                </div>

                <div class="settings-card__actions">
                    <button id="editProfileBtn" class="settings-card__actions--edit">
                        <i class="fa-solid fa-pen"></i>
                        Modifier mes informations
                    </button>
                </div>

                <div class="modal" id="editProfileModal">
                    <div class="modal__content">
                        <i class="fa-solid fa-xmark" id="closeBtn"></i>
                        <h3>Modifier mes informations</h3>

                        <form id="editProfileForm">
                            <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['firstname']) ?>" required aria-label="Champ pour modifier le prénom"/>
                            <input type="text" name="name" value="<?php echo htmlspecialchars($user['surname']) ?>" required aria-label="Champ pour modifier le nom"/>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']) ?>" required aria-label="Champ pour modifier l'email"/>
                            <input type="tel" name="tel" value="<?php echo htmlspecialchars($user['phone']) ?>" required aria-label="Champ pour modifier le numéro de téléphone"/>
                            <input type="date" name="birthday" value="<?php echo htmlspecialchars($user['birthday']) ?>" required aria-label="Champ pour modifier la date de naissance"/>
                            <input type="text" name="address" value="<?php echo htmlspecialchars($user['address']) ?>" required aria-label="Champ pour modifier l'adresse"/>
                            <input type="submit" value="Enregistrer" class="input-button" />
                        </form>

                    </div>
                </div>

                <div class="settings-card__danger">
                    <button id="deleteAccountBtn" class="settings-card__danger--delete">
                        <i class="fa-solid fa-trash-can"></i>
                        Supprimer mon compte
                    </button>
                </div>

                <div class="modal" id="deleteAccountModal">
                    <div class="modal__content">
                        <h3>Supprimer mon compte</h3>
                        <p>Cette action est irréversible. Toutes vos données seront supprimées.</p>
                        <div class="modal__actions">
                            <button id="cancelDelete" class="settings-card__actions--edit">Annuler</button>
                            <button id="confirmDelete" class="settings-card__danger--delete">Oui, supprimer mon compte</button>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </div>
</section>

<script src="../front/js/functions.js"></script>
<script src="../front/js/user-profile.js"></script>

<?php
require_once "layout/footer.php";
?>