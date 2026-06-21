<?php
$pageTitle = 'Connexion';
$pageDescription = 'Connectez-vous à votre compte Sakura Moon pour accéder à votre espace personnel, vos commandes et votre panier.';
require_once "layout/header.php";
?>

<section class="auth-page">
    <div class="auth-page__card">

        <div class="auth-page__logo">
            <img src="../front/images/logo.png" alt="Logo Sakura Moon">
        </div>

        <h1 class="auth-page__title">Bon retour !</h1>
        <h2 class="auth-page__subtitle">Connectez-vous à votre compte</h2>

        <form action="" method="get" autocomplete="on" id="loginForm">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required />
            </div>

            <div class="form-group input-password" id="div-password">
                <label for="password">Mot de passe</label>

                <input type="password" name="password" id="password" required />

                <button type="button" class="input-password__toggle" id="btnIcon" aria-label="Bouton pour afficher ou masquer le mot de passe">
                    <i class="fa-solid fa-eye-slash" id="icon"></i>
                </button>
            </div>

            <input type="submit" value="SE CONNECTER" class="input-button"/>

        </form>

        <div class="form-link">
            <p>Vous n'avez pas de compte ?</p>
            <a href="../back/router.php?action=register-view">S'inscrire</a>
        </div>

    </div>
</section>

<script src="../front/js/functions.js"></script>
<script src="../front/js/login.js"></script>

<?php
require_once "layout/footer.php";
?>