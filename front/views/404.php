<?php
$pageTitle = 'Erreur 404';
$pageDescription = 'Page introuvable. La page que vous recherchez n’existe pas ou a été déplacée. Retournez à l’accueil de Sakura Moon.';
require_once "layout/header.php";
?>

<section class="container page-404">
    <p class="page-404__label">Erreur 404</p>
    <h1 class="page-404__title">Oups... cette page s'est envolée <em>sous les fleurs de sakura.</em></h1>
    <h2 class="page-404__desc">La page que vous cherchez n'existe plus, ou n'a peut-être jamais existé. Revenez à la boutique pour découvrir nos nouvelles créations.</h2>
    <a href="../back/router.php?action=shop-view" class="page-404__cta">RETOUR À LA BOUTIQUE</a>
</section>

<?php
require_once "layout/footer.php";
?>