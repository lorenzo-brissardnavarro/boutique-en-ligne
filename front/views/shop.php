<?php
require_once "layout/header.php";
?>

<section>
    <h1>Notre boutique</h1>
    <p>Découvrez toutes nos créations artisanales</p>
    <div>
        <form action="" method="get">
            <div class="search-bar">
                <i class="fa-brands fa-sistrix"></i>
                <input type="search" name="search" placeholder="Rechercher un produit..." >
            </div>
            <select name="platform" id="platform-select">
                <option value="all">Trier</option>
                <option value="az">Ordre alphabétique A-Z</option>
                <option value="za">Ordre alphabétique Z-A</option>
                <option value="croissant">Prix croissant</option>
                <option value="decroissant">Prix décroissant</option>
            </select>
        </form>
    </div>
    <div>
        <div>
            <div>
                <p>Catégories</p>
                <button data-status="all">Toutes les catégories</button>
            </div>
            <div>
                <p>Prix</p>
                <form action="" method="get">
                    <input type="number" name="min" id="min">
                    <div></div>
                    <input type="number" name="max" id="max">
                </form>
            </div>
             <div>
                <p>Disponibilité</p>
                <form action="" method="get">
                    <input type="checkbox" name="disponibilite" id="disponibilite">
                    <label for="disponibilite">En stock uniquement</label>
                </form>
            </div>
        </div>
        <div>
            <article>
                <div>
                    <img src="" alt="">
                    <p>Accessoires</p>
                </div>
                <div>
                    <p>Trousse M Verte</p>
                    <div>
                        <p>15.99 €</p>
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<?php
require_once "layout/footer.php";
?>