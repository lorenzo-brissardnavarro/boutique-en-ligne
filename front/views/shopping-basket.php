<?php
require_once "layout/header.php";
?>

<section>
    <h1>Mon panier</h1>

    <div>
      <section>
        <article>
          <div>
            <div>
                <img src="" alt="">
            </div>
            <div>
                <p>Bijoux</p>
                <h2>Boucles d’oreilles poisson argent</h2>
                <p>24.99 €</p>
            </div>
          </div>
          <div>
            <div>
                <button aria-label="Diminuer la quantité">
                    <i class="fa-solid fa-minus"></i>
                </button>
                <span>1</span>
                <button aria-label="Augmenter la quantité">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
            <button aria-label="Supprimer l’article">
                <i class="fa-solid fa-trash-can"></i>
            </button>
          </div>
        </article>
      </section>

      <aside>
        <h2>Récapitulatif</h2>
        <div>
            <div>
                <span>Sous-total</span>
                <span >40.98 €</span>
            </div>
            <div>
                <span>Livraison</span>
                <span>3.99 €</span>
            </div>
            <p>Plus que 9.02 € pour la livraison offerte.</p>
        </div>
        <div>
            <div>
                <span>Total</span>
                <span>44.97 €</span>
            </div>

            <div>
                <button>VALIDER LA COMMANDE</button>
                <button>CONTINUER MES ACHATS</button>
            </div>
        </div>
      </aside>
    </div>
</section>

<?php
require_once "layout/footer.php";
?>
