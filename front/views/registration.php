<?php
require_once "layout/header.php";
?>

<section class="auth-page">
    <div class="auth-page__card">

        <div class="auth-page__logo">
            <img src="../images/logo.png" alt="Logo Sakura Moon">
        </div>

        <h1 class="auth-page__title">Créer un compte</h1>
        <p class="auth-page__subtitle">Rejoignez la maison Sakura Moon</p>

        <form action="" method="get">

            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" name="firstname" id="firstname" required />
            </div>

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" required />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required />
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="tel">Numéro de téléphone</label>
                    <input type="tel" name="tel" id="tel" required />
                </div>

                <div class="form-group">
                    <label for="birthday">Date de naissance</label>
                    <input type="date" name="birthday" id="birthday" required />
                </div>

            </div>

            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" name="address" id="address" required />
            </div>

            <div class="form-group input-password">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required />
            </div>

            <div class="form-group input-password">
                <label for="confirm-password">Confirmation du mot de passe</label>
                <input type="password" name="confirm-password" id="confirm-password" required />
            </div>

            <input type="submit" value="CRÉER MON COMPTE" class="input-button" />

        </form>

        <div class="form-link">
            <p>Vous avez déjà un compte ?</p>
            <a href="">Se connecter</a>
        </div>

    </div>
</section>

<script src="../js/functions.js"></script>
<script src="../js/register.js"></script>

<?php
require_once "layout/footer.php";
?>