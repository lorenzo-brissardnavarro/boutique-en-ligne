const firstnameInput = document.getElementById('firstname');

firstnameInput.addEventListener('input', function() {
    if (this.value.trim().length >= 3) {
        hideError(this);
    } else {
        showError(this, "Le prénom doit contenir au moins 3 caractères.");
    }
});
