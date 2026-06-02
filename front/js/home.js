const GridTopProducts = document.getElementById("GridTopProducts");
const GridNewsProducts = document.getElementById("GridNewsProducts");

async function loadHome() {
    try {
        const response = await fetch("../../back/router.php?action=home");
        const result = await response.json();
        console.log(result);

        if (result.success) {

            GridTopProducts.innerHTML = "";

            result.data.top.forEach(product => {

                const link = document.createElement("a");
                link.href = `product-details.php?id=${product.id}`;
                link.classList.add("product-card");

                link.innerHTML = `
                    <div class="product-card__badge">${product.category_name}</div>

                    <div class="product-card__image">
                        <img src="../../public/images/${product.image}" alt="${product.name}">
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
                `;

                GridTopProducts.appendChild(link);
            });

            GridNewsProducts.innerHTML = "";

            result.data.news.forEach(product => {

                const link = document.createElement("a");
                link.href = `product-details.php?id=${product.id}`;
                link.classList.add("product-card");

                link.innerHTML = `
                    <div class="product-card__badge">${product.category_name}</div>

                    <div class="product-card__image">
                        <img src="../../public/images/${product.image}" alt="${product.name}">
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
                `;

                GridNewsProducts.appendChild(link);
            });
        }

    } catch (error) {
        console.error(error);
    }
}

loadHome();