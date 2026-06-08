const caddieCount = document.getElementById("caddie-count");
const addBtn = document.getElementById("addCaddie");
const qtyInput = document.getElementById("qty");

const minusBtn = document.getElementById("decrease");
const plusBtn = document.getElementById("add");

const min = 1;
let maxStock = parseInt(qtyInput.max);

function getValue() {
    return parseInt(qtyInput.value);
}

function setValue(val) {
    qtyInput.value = val;
}

plusBtn.addEventListener("click", () => {
    let value = getValue();

    if (value < maxStock) {
        setValue(value + 1);
    }
});

minusBtn.addEventListener("click", () => {
    let value = getValue();

    if (value > min) {
        setValue(value - 1);
    }
});

addBtn.addEventListener("click", async () => {

    const productId = addBtn.dataset.id;
    const quantity = getValue();

    try {
        const response = await fetch("../back/router.php?action=add-caddie", {
        method: "POST",
        headers: { 
            "Content-Type": "application/json" 
        },
        body: JSON.stringify({ productId, quantity })
        });

        const result = await response.json();

        if (result.success) {
            showNotification("Ajouté au panier", "green");
            caddieCount.textContent = result.count;
        } else {
            showNotification(result.message, "red");
        }

    } catch (error) {
        console.error(error);
    }
});