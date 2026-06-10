const caddieCount = document.getElementById("caddie-count");

shopGrid.addEventListener("click", async (e) => {
    const button = e.target.closest(".product-card__cart");

    if (!button) {
        return;
    }

    e.preventDefault();
    e.stopPropagation();

    const productId = button.dataset.id;

    try {

        const response = await fetch("../back/router.php?action=add-caddie", {
        method: "POST",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ productId, quantity:1 })
        });

        const result = await response.json();

        if (result.success) {
            showNotification("Produit ajouté au panier", "green");
            caddieCount.textContent = result.count;
        } else {
            showNotification(result.message, "red");
        }
    } catch (error) {
        console.error(error);
    }
});