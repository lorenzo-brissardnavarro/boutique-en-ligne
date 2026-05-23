<?php
require_once "layout/header.php";
?>

<section class="auth-page">
    <div class="auth-page__card">

        <div class="auth-page__logo">
            <img src="../images/logo.png" alt="Logo Sakura Moon">
        </div>

        <h1 class="auth-page__title">Bon retour !</h1>
        <p class="auth-page__subtitle">Connectez-vous à votre compte</p>

        <form action="" method="get">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required />
            </div>

            <div class="form-group input-password">
                <label for="password">Mot de passe</label>

                <input type="password" name="password" id="password" required />

                <button type="button" class="input-password__toggle">
                    <i class="fa-solid fa-eye-slash"></i>
                </button>
            </div>

            <input type="submit" value="SE CONNECTER" class="input-button"/>

        </form>

        <div class="form-link">
            <p>Vous n'avez pas de compte ?</p>
            <a href="">S'inscrire</a>
        </div>

    </div>
</section>

<?php
require_once "layout/footer.php";
?>