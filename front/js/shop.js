const filters = {keyword: "", sort: "all", category: "all", min: "all", max: "all", availability: 0};

const shopGrid = document.getElementById("shop-grid");
const btnCategories = document.getElementById("categories");

async function loadShop() {
    try {
        const query = new URLSearchParams(filters).toString();
        const response = await fetch(`../back/router.php?action=shop&${query}`);
        const result = await response.json();

        if (result.data.length === 0) {
            shopGrid.innerHTML = "<p class='shop-grid__empty'>Aucun produit trouvé</p>";
            return;
        }

        shopGrid.innerHTML = "";

        result.data.forEach(product => {

            const link = document.createElement("a");
            link.href = `../back/router.php?action=product-details&id=${product.id}`;
            link.classList.add("product-card");
            link.innerHTML = `
                <article>
                    <div class="product-card__badge">${product.category_name}</div>

                    <div class="product-card__image">
                        <img src="../public/images/${product.image}" alt="${product.product_name}">
                    </div>

                    <div class="product-card__content product-card__content--beige">
                        <h3>${product.product_name}</h3>
                        <div class="product-card__bottom">
                            <span class="product-card__price">${product.price} €</span>
                            <button class="product-card__cart" data-id="${product.id}" aria-label="Bouton pour ajouter le produit au panier">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </button>
                        </div>
                    </div>
                </article>
            `;

            shopGrid.appendChild(link);
        });

    } catch (error) {
        console.error(error);
    }
}

loadShop();

document.getElementById("myKeyword").addEventListener("input", e => {
    filters.keyword = e.target.value.trim();
    console.log(filters);
    loadShop();
});


document.getElementById("sort-select").addEventListener("change", e => {
    filters.sort = e.target.value;
    console.log(filters);
    loadShop();
});


document.getElementById("min").addEventListener("change", e => {
    filters.min = e.target.value;
    console.log(filters);
    loadShop();
});


document.getElementById("max").addEventListener("change", e => {
    filters.max = e.target.value;
    console.log(filters);
    loadShop();
});


document.getElementById("availability").addEventListener("change", e => {
    const value = e.target.checked;
    if(value === true){
        filters.availability = 1;
    } else {
        filters.availability = 0;
    }
    
    console.log(filters);
    loadShop();
});


const btns = document.querySelectorAll(".filters__tag");
btns.forEach(btn => {
    btn.addEventListener("click", () => {

        btns.forEach(b => b.classList.remove("filters__tag--active"));

        btn.classList.add("filters__tag--active");
        const status = btn.dataset.status;
        filters.category = status;

        loadShop();
    });
});




const autocomplete = document.getElementById("autocomplete");

// document.getElementById("myKeyword").addEventListener("input", async (e) => {
//     const keyword = e.target.value.trim();

//     if (keyword.length < 2) {
//         autocomplete.innerHTML = "";
//         return;
//     }

//     const response = await fetch(`../back/router.php?action=autocomplete&keyword=${keyword}`);
//     const result = await response.json();

//     autocomplete.innerHTML = "";

//     result.data.forEach(product => {
//         const div = document.createElement("div");
//         div.textContent = product.product_name;

//         div.addEventListener("click", () => {
//             document.getElementById("myKeyword").value = product.product_name;
//             filters.keyword = product.product_name;
//             autocomplete.innerHTML = "";
//             loadShop();
//         });
//         autocomplete.appendChild(div);
//     });
// });

document.getElementById("myKeyword").addEventListener("input", async (e) => {
    const keyword = e.target.value.trim();

    if (keyword.length < 2) {
        autocomplete.innerHTML = "";
        items = [];
        index = -1;
        return;
    }

    const response = await fetch(`../back/router.php?action=autocomplete&keyword=${keyword}`);
    const result = await response.json();

    autocomplete.innerHTML = "";
    items = result.data;
    index = -1;

    result.data.forEach(product => {
        const li = document.createElement("li");
        li.textContent = product.product_name;

        li.addEventListener("click", () => {
            document.getElementById("myKeyword").value = product.product_name;
            filters.keyword = product.product_name;
            autocomplete.innerHTML = "";
            index = -1;
            loadShop();
        });

        autocomplete.appendChild(li);
    });
});

document.getElementById("myKeyword").addEventListener("keydown", (e) => {
    const lis = autocomplete.querySelectorAll("li");
    if (!lis.length) return;

    if (e.key === "ArrowDown") {
        e.preventDefault();
        index = index + 1;
        if (index > lis.length - 1) {
            index = lis.length - 1;
        }
        update(lis);
    }

    if (e.key === "ArrowUp") {
        e.preventDefault();
        index = index - 1;
        if (index < 0) {
            index = 0;
        }
        update(lis);
    }

    if (e.key === "Enter" && index >= 0) {
        e.preventDefault();
        lis[index].click();
    }

    if (e.key === "Escape") {
        autocomplete.innerHTML = "";
        index = -1;
    }
});

function update(lis) {
    lis.forEach((el, i) => {
        el.classList.toggle("active", i === index);
    });
}