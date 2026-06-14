// Gestion des clics pour faire apparaitre / disparaitre les modales d'ajout, de modification ou de suppression
const addProductModal = document.getElementById("addProductModal");
const addProductBtn = document.getElementById("addProductBtn");
const closeBtn = document.getElementById("closeBtn");

addProductBtn.addEventListener("click", () => {
    addProductModal.classList.add("visible");
})

closeBtn.addEventListener("click", () => {
    addProductModal.classList.remove("visible");
})

document.getElementById("closeBtnModalInfo").addEventListener("click", () => {
    infoModal.classList.remove("visible");
})

window.addEventListener('click', (event) => {
    if (event.target === addProductModal || event.target === infoModal) {
        addProductModal.classList.remove("visible");
        infoModal.classList.remove("visible");
    }
});


// Preview de l'image
const coverInput = document.getElementById('cover');
const previewImage = document.getElementById('previewImage');
const inputImage = document.querySelector('.inputImage');

coverInput.addEventListener('change', () => {
    const file = coverInput.files[0];

    if (file) {
        previewImage.src = URL.createObjectURL(file);
        previewImage.style.display = 'block';
        inputImage.style.display = 'none';
    }
});

// Formulaire ajout nouveau produit
document.getElementById("addProductForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const name = e.target.name.value.trim();
    const description = e.target.description.value.trim();
    const price = parseFloat(e.target.price.value);
    const stock = parseInt(e.target.stock.value, 10);
    const category_id = e.target.category_id.value;

    const is_active = e.target.is_active.checked ? 1 : 0;

    const cover = e.target.cover.files[0];

    const listFiles = e.target.files.files;


    const formData = new FormData();

    formData.append("name", name);
    formData.append("description", description);
    formData.append("price", price);
    formData.append("stock", stock);
    formData.append("category_id", category_id);
    formData.append("is_active", is_active);

    if (cover) {
        formData.append("cover", cover);
    }

    for (let i = 0; i < listFiles.length; i++) {
        formData.append("files[]", listFiles[i]);
    }

    try {
        const response = await fetch("../back/router.php?action=add-product", {
            method: "POST",
            credentials: "same-origin",
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            showNotification("Produit ajouté à la boutique", "green");

            setTimeout(() => {
                location.reload();
            }, 1000);

        } else {
            showNotification(result.message, "red");
        }

    } catch (error) {
        console.error(error);
    }
});



// Gestion de la modification des infos du produit

const infoModal = document.getElementById("editProductInfoModal");

document.querySelectorAll(".edit-info-btn").forEach(btn => {
    btn.addEventListener("click", () => {
        document.getElementById("product_idInfo").value = btn.dataset.id;
        document.querySelector('[name="nameInfo"]').value = btn.dataset.name;
        document.querySelector('[name="descriptionInfo"]').value = btn.dataset.description;
        document.querySelector('[name="priceInfo"]').value = btn.dataset.price;
        document.querySelector('[name="stockInfo"]').value = btn.dataset.stock;
        document.querySelector('[name="category_idInfo"]').value = btn.dataset.category;
        document.querySelector('[name="is_activeInfo"]').checked = btn.dataset.active == 1;
        infoModal.classList.add("visible");
    });

});

document.getElementById("editProductInfoForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const productId = e.target.product_idInfo.value;
    const name = e.target.nameInfo.value.trim();
    const description = e.target.descriptionInfo.value.trim();
    const price = parseFloat(e.target.priceInfo.value);
    const stock = parseInt(e.target.stockInfo.value, 10);
    const category_id = e.target.category_idInfo.value;
    const is_active = e.target.is_activeInfo.checked ? 1 : 0;

    const data = {productId, name, description, price, stock, category_id, is_active};

    try {
        const response = await fetch("../back/router.php?action=update-product-infos", {
            method: "POST",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            showNotification("Informations mises à jour", "green");

            setTimeout(() => {
                location.reload();
            }, 1000);

        } else {
            showNotification(result.message, "red");
        }

    } catch (error) {
        console.error(error);
    }
});