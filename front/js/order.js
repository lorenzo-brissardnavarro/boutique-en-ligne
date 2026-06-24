const OrderBtn = document.querySelector(".cart-summary__checkout");

if(OrderBtn){
    OrderBtn.addEventListener("click", async (e) => {
        try {
            const response = await fetch("../back/router.php?action=add-order", {
                method: "POST",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": getCsrfToken()
                },
            });

            const result = await response.json();

            if (result.success) {
                showNotification("Commande validée", "green");
                setTimeout(() => window.location.href = "../back/router.php?action=profile-view", 2000);
            } else {
                showNotification(result.message, "red");
            }
        } catch (error) {
            console.error(error);
        }
    })
}
