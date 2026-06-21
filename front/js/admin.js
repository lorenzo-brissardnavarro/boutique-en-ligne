// Gestion des clics pour faire apparaitre / disparaitre les modales d'ajout, de modification ou de suppression
const addProductModal = document.getElementById("addProductModal");
const addProductBtn = document.getElementById("addProductBtn");
const deleteProductModal = document.getElementById("deleteProductModal"); 
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

document.getElementById("closeBtnModalImages").addEventListener("click", () => {
    imagesModal.classList.remove("visible");
})

window.addEventListener('click', (event) => {
    if (event.target === addProductModal || event.target === infoModal || event.target === imagesModal || event.target === deleteProductModal || event.target === AddCategoryModal || event.target === updateCategoryModal || event.target === deleteCategoryModal) {
        addProductModal.classList.remove("visible");
        infoModal.classList.remove("visible");
        imagesModal.classList.remove("visible");
        AddCategoryModal.classList.remove("visible");
        updateCategoryModal.classList.remove("visible");
        deleteCategoryModal.classList.remove("visible");
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




// Gestion de la modification / suppression ou ajout d'images pour un produit

const imagesModal = document.getElementById("editProductImagesModal");

document.querySelectorAll(".edit-images-btn").forEach(btn => {
    btn.addEventListener("click", () => {

        document.getElementById("images_product_id").value = btn.dataset.id;
        document.getElementById("images_product_name").value = btn.dataset.name;
        document.getElementById("previewCover").src = "../public/images/" + btn.dataset.cover;
        document.getElementById("previewCover").alt = "Image de couverture pour le produit";

        const container = document.getElementById("galleryContainer");
        container.innerHTML = "";
        const images = JSON.parse(btn.dataset.images);
        images.forEach(img => {
            container.innerHTML += `
                <div class="gallery-item" data-id="${img.id}">
                    <img src="../public/images/${img.image}" alt="Image additionnelle n°${img.id}">
                    <button class="delete-image" data-id="${img.id}" aria-label="Bouton pour supprimer une image liée au produit">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            `;
        });

        // suppression image
        document.querySelectorAll(".delete-image").forEach(btn => {
            btn.addEventListener("click", async (e) => {
                const imageId = e.currentTarget.dataset.id;
                try {
                    const response = await fetch("../back/router.php?action=delete-image", {
                    method: "POST",
                    credentials: "same-origin",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ image_id: imageId })
                    });

                    const result = await response.json();

                    if (result.success) {
                        const imageItem = document.querySelector(`.gallery-item[data-id="${imageId}"]`);
                        if (imageItem) {
                            imageItem.remove();
                        }
                    } else {
                        showNotification(result.message, "red");
                    }

                } catch (error) {
                    console.error(error);
                }
            });

        });

        imagesModal.classList.add("visible");
    });

});


// ajout images additionnelles ou maj image cover
document.getElementById("saveImagesBtn").addEventListener("click", async () => {

    const productId = document.getElementById("images_product_id").value;
    const name = document.getElementById("images_product_name").value;

    const formData = new FormData();
    formData.append("product_id", productId);
    formData.append("name", name);

    const cover = document.getElementById("coverInput").files[0];
    if (cover) {
        formData.append("cover", cover);
    }

    const files = document.getElementById("galleryInput").files;
    for (let i = 0; i < files.length; i++) {
        formData.append("files[]", files[i]);
    }

    try {
        const response = await fetch("../back/router.php?action=update-product-images", {
            method: "POST",
            credentials: "same-origin",
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            showNotification("Images mises à jour", "green");

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


// Ajout d'une catégorie

const addCategoryBtn = document.getElementById("addCategoryBtn");
const AddCategoryModal = document.getElementById("AddCategoryModal");
const closeBtnModalAddCategory = document.getElementById("closeBtnModalAddCategory");

addCategoryBtn.addEventListener("click", () => {
    AddCategoryModal.classList.add("visible");
})

closeBtnModalAddCategory.addEventListener("click", () => {
    AddCategoryModal.classList.remove("visible");
})


document.getElementById("addCategoryForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const name = e.target.categoryName.value.trim();

    try {
        const response = await fetch("../back/router.php?action=add-category", {
            method: "POST",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ name: name })
        });

        const result = await response.json();

        if (result.success) {
            showNotification("Catégorie ajoutée", "green");

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


// Modification d'une catégorie existante
const updateCategoryModal = document.getElementById("updateCategoryModal");
const closeBtnModalUpdateCategory = document.getElementById("closeBtnModalUpdateCategory");

closeBtnModalUpdateCategory.addEventListener("click", () => {
    updateCategoryModal.classList.remove("visible");
})

document.querySelectorAll(".edit-category-btn").forEach(btn => {
    btn.addEventListener("click", () => {
        document.getElementById("category_id").value = btn.dataset.id;
        document.querySelector('[name="updateCategoryName"]').value = btn.dataset.name;
        updateCategoryModal.classList.add("visible");
    });

});

document.getElementById("updateCategoryForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const id = e.target.category_id.value;
    const name = e.target.updateCategoryName.value.trim();

    const data = {id, name};

    try {
        const response = await fetch("../back/router.php?action=update-category", {
            method: "POST",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            showNotification("Catégorie mises à jour", "green");

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


// Suppression d'une catégorie

const cancelDelete = document.getElementById("cancelDelete");
const confirmDelete = document.getElementById("confirmDelete");
const deleteCategoryModal = document.getElementById("deleteCategoryModal"); 

cancelDelete.addEventListener("click", () => {
    deleteCategoryModal.classList.remove("visible");
})

let categoryIdDelete = null;

document.querySelectorAll('.admin-product-card__icon-btn--delete').forEach(button => {
    button.addEventListener('click', () => {
        categoryIdDelete = button.dataset.id;
        deleteCategoryModal.classList.add("visible");
    });
});

confirmDelete.addEventListener("click", async () => {
    try {
        const response = await fetch("../back/router.php?action=delete-category", {
            method: "POST",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id: categoryIdDelete })
        });

        const result = await response.json();

        if (result.success) {
            const categoryItem = document.querySelector(`.admin-category-tag[data-id="${categoryIdDelete}"]`);

            if (categoryItem) {
                categoryItem.remove();
            }

            deleteCategoryModal.classList.remove("visible");
            categoryIdDelete = null;

        } else {
            showNotification(result.message, "red");
        }

    } catch (error) {
        console.error(error);
    }
});