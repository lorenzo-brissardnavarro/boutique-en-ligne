// Action pour permettre à l'utilisateur de naviguer entre commandes / favoris / paramètres
const buttons = document.querySelectorAll(".profile-sidebar__nav button");
const sections = document.querySelectorAll(".profile-content");

buttons.forEach(button => {
    button.addEventListener("click", () => {
        const tab = button.dataset.tab;
        buttons.forEach(btn => btn.classList.remove("active"));
        button.classList.add("active");

        sections.forEach(section => {
            section.classList.remove("visible");
        });

        document.getElementById(tab).classList.add("visible");
    });
});


// Gestion des clics pour faire apparaitre / disparaitre les modales de modification des informations ou de suppression du compte
const editProfileModal = document.getElementById("editProfileModal");
const deleteAccountModal = document.getElementById("deleteAccountModal");
const editBtn = document.getElementById("editProfileBtn");
const deleteBtn = document.getElementById("deleteAccountBtn");
const closeBtn = document.getElementById("closeBtn");
const cancelDelete = document.getElementById("cancelDelete");
const confirmDelete = document.getElementById("confirmDelete");

editBtn.addEventListener("click", () => {
    editProfileModal.classList.add("visible");
})

deleteBtn.addEventListener("click", () => {
    deleteAccountModal.classList.add("visible");
})

closeBtn.addEventListener("click", () => {
    editProfileModal.classList.remove("visible");
})

window.addEventListener('click', (event) => {
    if (event.target === editProfileModal || event.target === deleteAccountModal) {
        editProfileModal.classList.remove("visible");
        deleteAccountModal.classList.remove("visible");
    }
});


// Gestion des réponses sur la modale de modification des informations du compte

// Expressions régulières
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const telRegex = /^0[6-7]\d{8}$/;
const addressRegex = /^\d+\s+[A-Za-zÀ-ÿ\s'-]{3,}$/;
const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,16}$/;

const form = document.getElementById("editProfileForm");
form.addEventListener("submit", async function (e) {
    e.preventDefault();

    const firstname = e.target.firstname.value.trim();
    const surname = e.target.name.value.trim();
    const email = e.target.email.value.trim();
    const phone = e.target.tel.value.trim();
    const birthday = e.target.birthday.value;
    const address = e.target.address.value.trim();

    if (firstname.length < 2) {
        showError(form.firstname, "Le prénom doit contenir au moins 2 caractères.");
        return;
    }

    if (!email.match(emailRegex)) {
        showError(form.email, "Email invalide.");
        return;
    }

    if (!phone.match(telRegex)) {
        showError(form.tel, "Téléphone invalide.");
        return;
    }

    const birthDate = new Date(birthday);
    const minDate = new Date("1900-01-01");
    const maxDate = new Date();

    if (birthDate < minDate || birthDate > maxDate) {
        showError(form.birthday, "Date de naissance invalide.");
        return;
    }

    if (!address.match(addressRegex)) {
        showError(form.address, "Adresse invalide.");
        return;
    }

    const data = {firstname, surname, email, phone, birthday, address};

    try {
        const response = await fetch("../back/router.php?action=update-profile", {
            method: "POST",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            showNotification("Profil mis à jour", "green");

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


// Gestion des réponses sur la modale de suppression du compte
cancelDelete.addEventListener("click", () => {
    deleteAccountModal.classList.remove("visible");
})

// Suppression confirmée + redirection après suppression dans BDD
confirmDelete.addEventListener("click", async (e) => {
    try {
        const response = await fetch("../back/router.php?action=delete-account", {
            method: "POST",
            credentials: "same-origin"
        });

        const result = await response.json();

        if (result.success) {
            window.location.href = "../back/router.php?action=home";
        }
    } catch (error) {
        console.error(error);
    }
})