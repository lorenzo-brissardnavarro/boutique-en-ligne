const favoriteBtn = document.getElementById("favoriteBtn");
const favoriteIcon = document.getElementById("favoriteIcon");

favoriteBtn.addEventListener("click", async (e) => {
    const productId = favoriteBtn.dataset.id;
    try {
        const response = await fetch("../back/router.php?action=toggle-favorite", {
        method: "POST",
        credentials: 'same-origin',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ productId })
        });

        const result = await response.json();

        if (result.success) {
            if(result.action === "add"){
                favoriteBtn.classList.add("product-detail__wishlist--liked");
                favoriteIcon.classList.remove("fa-regular");
                favoriteIcon.classList.add("fa-solid");
            } else {
                favoriteBtn.classList.remove("product-detail__wishlist--liked");
                favoriteIcon.classList.remove("fa-solid");
                favoriteIcon.classList.add("fa-regular");
            }
        } else {
            showNotification(result.message, "red");
        }

    } catch (error) {
        console.error(error);
    }
    });