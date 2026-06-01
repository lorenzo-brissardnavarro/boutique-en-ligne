const logoutBtn = document.getElementById("logout");

if(logoutBtn) {
    logoutBtn.addEventListener("click", async (e) => {
        e.preventDefault();

        try {
            const response = await fetch("../../back/router.php?action=logout", {
                method: "POST",
                credentials: "same-origin"
            });

            const result = await response.json();

            if (result.success) {
                window.location.href = "home.php";
            }
        } catch (error) {
            console.error(error);
        }
    });
}
