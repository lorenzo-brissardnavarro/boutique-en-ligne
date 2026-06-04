<?php
require_once "layout/header.php";
?>

<section class="auth-page">
    <div class="auth-page__card">

        <div class="auth-page__logo">
            <img src="../front/images/logo.png" alt="Logo Sakura Moon">
        </div>

        <h1 class="auth-page__title">Créer un compte</h1>
        <p class="auth-page__subtitle">Rejoignez la maison Sakura Moon</p>

        <form action="" method="get" autocomplete="on" id="registerForm">

            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" name="firstname" id="firstname" placeholder="ex : Jean" autocomplete="new-firstname" required />
            </div>

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" placeholder="ex : Dupont" autocomplete="new-name" required />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="ex : jeandupont@gmail.com" autocomplete="new-email" required />
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="tel">Numéro de téléphone</label>
                    <input type="tel" name="tel" id="tel" placeholder="ex : 0601020304" autocomplete="new-tel" required />
                </div>

                <div class="form-group">
                    <label for="birthday">Date de naissance</label>
                    <input type="date" name="birthday" id="birthday" autocomplete="new-birthday" min="1900-01-01" max="<?php echo date("Y-m-d") ?>"required />
                </div>

            </div>

            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" name="address" id="address" placeholder="ex : 133 Rue Victor Hugo" autocomplete="new-address" required />
            </div>

            <div class="form-group input-password">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" autocomplete="new-password" required />
            </div>

            <div class="form-group input-password">
                <label for="confirm-password">Confirmation du mot de passe</label>
                <input type="password" name="confirm-password" id="confirm-password" autocomplete="new-confirm-password" required />
            </div>

            <input type="submit" value="CRÉER MON COMPTE" class="input-button" />

        </form>

        <div class="form-link">
            <p>Vous avez déjà un compte ?</p>
            <a href="../back/router.php?action=login-view">Se connecter</a>
        </div>

    </div>
</section>

<script src="../front/js/functions.js"></script>
<script src="../front/js/register.js"></script>

<?php
require_once "layout/footer.php";
?>