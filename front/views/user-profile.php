<?php
require_once "layout/header.php";
?>

<section>
    <h1>Mon compte</h1>
    <section>
      <aside>
        <div>
          <div>
            <i class="fa-solid fa-user"></i>
          </div>
          <h2>Marie Dupont</h2>
          <p>marie@example.com</p>
        </div>

        <nav>
          <ul>
            <li>
                <button>
                    <i class="fa-solid fa-box-open"></i>
                    Mes commandes
                </button>
            </li>
            <li>
                <button>
                    <i class="fa-regular fa-heart"></i>
                    Mes favoris
                </button>
            </li>
            <li>
                <button>
                    <i class="fa-solid fa-gear"></i>
                    Paramètres
                </button>
            </li>
          </ul>
        </nav>

      </aside>

      <section>
        <h2>Mes commandes</h2>
        <article>
            <div>
                <h3>Commande N° CDM-001</h3>
                <div>
                    <span>2 articles</span>
                    <span>44.97 €</span>
                </div>
            </div>

            <div>
                <div>
                    <p>Boucles d’oreilles poisson argent ×1</p>
                    <span>24.99 €</span>
                </div>
                <div>
                    <p>Trousse M Verte ×1</p>
                    <span>15.99 €</span>
                </div>
                <div>
                    <p>Livraison</p>
                    <span>3.99 €</span>
                </div>
            </div>
        </article>
      </section>
</section>

<?php
require_once "layout/footer.php";
?>