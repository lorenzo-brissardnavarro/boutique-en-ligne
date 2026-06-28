const formNewsletter = document.getElementById("newsletterForm");
const emailInput = document.getElementById("email");

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

formNewsletter.addEventListener("submit", async (e) => {
    e.preventDefault();

    if(!emailInput.value.trim().match(emailRegex)){
        showNotification("Adresse mail invalide", "red");
        return;
    }

    const data = {email: emailInput.value.trim()};

    try {
        const response = await fetch("../back/router.php?action=newsletter", {
            method: "POST",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            showNotification("Inscription réussie", "green");
        } else {
            showNotification(result.message, "red");
        }

    } catch (error) {
        console.error(error);
    }
});