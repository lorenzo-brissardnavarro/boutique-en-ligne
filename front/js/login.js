// Variables pour les champs du formulaire
const formLogin = document.getElementById('loginForm');
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const passwordDiv = document.getElementById("div-password");


// Afficher et masquer le mot de passe
const btnIcon = document.getElementById("btnIcon");
const icon = document.getElementById("icon");
let isVisible = false;
btnIcon.addEventListener("click", () => {
    if(isVisible) {
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
        isVisible = false;
        passwordInput.type = "password";
    } else {
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
        isVisible = true;
        passwordInput.type = "text";
    }
})


formLogin.addEventListener("submit", async function(e) {
    e.preventDefault();

    // Si les données sont correctes, on peut les stocker
    const data = {email: emailInput.value.trim(), password: passwordInput.value.trim()};

    try {
        // Appel API et envoi des données
        const response = await fetch("../back/router.php?action=login", {
        method: "POST",
        credentials: 'same-origin',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            showNotification("Connexion réussie", "green");
            setTimeout(() => {
                window.location.href = "../back/router.php?action=shop-view";
            }, 2000);
        } else {
            showError(passwordDiv, "Identifiant ou mot de passe incorrect");
        }
    } catch (error) {
        console.error(error);
    }

});