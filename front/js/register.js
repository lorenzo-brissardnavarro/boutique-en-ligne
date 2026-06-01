// Variables pour les champs du formulaire
const formRegister = document.getElementById('registerForm');
const firstnameInput = document.getElementById('firstname');
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const telInput = document.getElementById('tel');
const birthdayInput = document.getElementById('birthday');
const addressInput = document.getElementById('address');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirm-password');

// Expressions régulières
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const telRegex = /^0[6-7]\d{8}$/;
const addressRegex = /^\d+\s+[A-Za-zÀ-ÿ\s'-]{3,}$/;
const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,16}$/;

firstnameInput.addEventListener('input', function() {
    if (this.value.trim().length >= 2) {
        hideError(this);
    } else {
        showError(this, "Le prénom doit contenir au moins 2 caractères.");
    }
});

emailInput.addEventListener('input', function() {
    if(!this.value.match(emailRegex)){
        showError(this, "L'adresse mail n'est pas au bon format.");
    } else {
        hideError(this);
    }
});

telInput.addEventListener("input", function() {
    if(!this.value.match(telRegex)){
        showError(this, "Le numéro de téléphone n'est pas au bon format.");
    } else {
        hideError(this);
    }
});

birthdayInput.addEventListener("input", function() {
    const birthday = new Date(this.value);
    const minDate = new Date("1900-01-01");
    const maxDate = new Date();

    if (birthday < minDate || birthday > maxDate) {
        showError(this, "La date de naissance n'est pas valide.");
    } else {
        hideError(this);
    }
});

addressInput.addEventListener("input", function() {
    if(!this.value.match(addressRegex)){
        showError(this, "L'adresse postale n'est pas valide.");
    } else {
        hideError(this);
    }
});

passwordInput.addEventListener("input", function() {
    if(!this.value.match(passwordRegex)){
        showError(this, "Le mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule, un chiffre et un caractère spécial");
    } else {
        hideError(this);
    }
});

confirmPasswordInput.addEventListener("input", function() {
    if(this.value !== passwordInput.value){
        showError(this, "Les mots de passe doivent être identiques");
    } else {
        hideError(this);
    }
});

formRegister.addEventListener("submit", async function(e) {
    e.preventDefault();

    if (firstnameInput.value.trim().length < 2) {
        showError(firstnameInput, "Le prénom doit contenir au moins 2 caractères.");
        return;
    }

    if(!emailInput.value.trim().match(emailRegex)){
        showError(emailInput, "L'adresse mail n'est pas au bon format.");
        return;
    }

    if(!telInput.value.trim().match(telRegex)){
        showError(telInput, "Le numéro de téléphone n'est pas au bon format.");
        return;
    }

    const birthday = new Date(birthdayInput.value);
    const minDate = new Date("1900-01-01");
    const maxDate = new Date();

    if (birthday < minDate || birthday > maxDate) {
        showError(birthdayInput, "La date de naissance n'est pas valide.");
        return;
    }

    if(!addressInput.value.trim().match(addressRegex)){
        showError(addressInput, "L'adresse postale n'est pas valide.");
        return;
    }

    if(!passwordInput.value.trim().match(passwordRegex)){
        showError(passwordInput, "Le mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule, un chiffre et un caractère spécial");
        return;
    }

    if(confirmPasswordInput.value.trim() !== passwordInput.value.trim()){
        showError(confirmPasswordInput, "Les mots de passe doivent être identiques");
        return;
    }

    // Si les données sont correctes, on peut les stocker
    const data = {firstname: firstnameInput.value.trim(), surname: nameInput.value.trim(), email: emailInput.value.trim(), phone: telInput.value.trim(), birthday: birthdayInput.value.trim(), address: addressInput.value.trim(), password: passwordInput.value.trim(), confirm: confirmPasswordInput.value.trim()};

    try {
        // Appel API et envoi des données
        const response = await fetch("../../back/router.php?action=register", {
        method: "POST",
        credentials: 'same-origin',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            showNotification("Inscription réussie", "green");
            setTimeout(() => {
                window.location.href = "login.php";
            }, 2000);
        } else {
            showNotification("Erreur", "red");
        }
    } catch (error) {
        console.error(error);
    }

});