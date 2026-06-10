const cartItems = document.querySelectorAll(".cart-item");
const caddieCount = document.getElementById("caddie-count");

// Gestion des clics sur le - ou le + pour gérer la quantité de produit
cartItems.forEach(item => {
    const qtyInput = item.querySelector(".qty");
    const plusBtn = item.querySelector(".add");
    const minusBtn = item.querySelector(".decrease");

    const min = 1;
    const max = parseInt(qtyInput.max);

    plusBtn.addEventListener("click", () => {
        let value = parseInt(qtyInput.value);
        if (value < max) {
            qtyInput.value = value + 1;
            updateItem(item.dataset.id, qtyInput.value);
        }
    });

    minusBtn.addEventListener("click", () => {
        let value = parseInt(qtyInput.value);
        if (value > min) {
            qtyInput.value = value - 1;
            updateItem(item.dataset.id, qtyInput.value);
        }
    });

    qtyInput.addEventListener("change", () => {
        let value = parseInt(qtyInput.value);
        if (value < min) value = min;
        if (value > max) value = max;

        qtyInput.value = value;
        updateItem(item.dataset.id, value);
    });

});

// Appel API pour modifier dans la BDD la quantité du panier
async function updateItem(productId, quantity) {
    try {
        const response = await fetch("../back/router.php?action=update-caddie", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ productId, quantity })
        });

        const result = await response.json();

        if(result.success) {
            updatePrice(result);
            caddieCount.textContent = result.count;
        } else {
            showNotification(result.message, "red");
        }
    } catch(error) {
        console.error(error);

    }

}

// Gestion du total du panier et de la livraison en direct
function updatePrice(data) {
    document.getElementById("total").textContent = `${data.total} €`;
    document.getElementById("delivery").textContent = data.delivery === 0 ? "Offerte" :  `${data.delivery} €`;
    document.getElementById("finalTotal").textContent =  `${data.finalTotal} €`;

    if (data.total >= 50) {
        document.getElementById("comment").textContent = "";
    } else {
        document.getElementById("comment").textContent = `Plus que ${data.deliveryMissing} € pour la livraison offerte.`;
    }
}

document.querySelectorAll(".cart-item__delete").forEach(button => {
    button.addEventListener("click", async () => {
        const productId = button.dataset.id;

        const response = await fetch("../back/router.php?action=delete-caddie", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ productId })
        });

        const result = await response.json();

        if (result.success) {
            const cartItem = document.querySelector(`.cart-item[data-id="${productId}"]`);
            if (cartItem) {
                cartItem.remove();
            }
            updatePrice(result);
            caddieCount.textContent = result.count;
            if (document.querySelectorAll(".cart-item").length === 0) {
                document.querySelector(".cart-page").innerHTML = `
                    <h1 class="shop-page__title">Mon panier</h1>
                    <section class="container page-404">
                        <p class="page-404__label">Votre panier est vide.</p>
                        <a href="../back/router.php?action=shop-view" class="page-404__cta">Aller à la boutique</a>
                    </section>';
                `;
            }
            showNotification("Produit supprimé du panier", "green");
        } else {
            showNotification(result.message, "red");
        }

    });

});