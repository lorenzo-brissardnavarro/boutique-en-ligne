const filters = {keyword: "", sort: "all", category: "all", min: "all", max: "all", availability: 0};

const shopGrid = document.getElementById("shop-grid");
const btnCategories = document.getElementById("categories");

async function loadShop() {
    try {
        const query = new URLSearchParams(filters).toString();
        const response = await fetch(`../back/router.php?action=shop&${query}`);
        const result = await response.json();
        console.log(result);

        if (result.data.length === 0) {
            shopGrid.innerHTML = "<p>Aucun produit trouvé</p>";
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
                            <p class="product-card__price">${product.price} €</p>
                            <button class="product-card__cart" type="button">
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
    filters.keyword = e.target.value;
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