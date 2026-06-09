const cartItems = document.querySelectorAll(".cart-item");

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
        } else {
            showNotification(result.message, "red");
        }
    } catch(error) {
        console.error(error);

    }

}

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