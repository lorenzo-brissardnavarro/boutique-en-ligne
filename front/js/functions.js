// Afficher une erreur dans le formulaire
function showError(element, message){
    hideError(element);
    element.insertAdjacentHTML("afterend", `<div class="error"><p>${message}</p></div>`);
}

// Masquer l'erreur d'un formulaire si elle a été corrigée
function hideError(element){
    const error = element.nextElementSibling;
    if (error) {
        error.remove();
    }
}

// Bandeau de notification pour indiquer à l'utilisateur la réussite ou l'échec de l'action
const body = document.getElementById("body");
function showNotification(message, classe) {
    const notif = document.createElement("div");
    notif.textContent = message;
    notif.classList.add("notification");
    notif.classList.add(classe);
    body.appendChild(notif);
    setTimeout(() => notif.remove(), 2000);
}