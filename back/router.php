<?php
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\ProductController;
use App\Controllers\FavoriteController;
use App\Controllers\ProfileController;
use App\Controllers\CaddieController;

$Authcontroller = new AuthController();
$Productcontroller = new ProductController();
$Favoritecontroller = new FavoriteController();
$Profilecontroller = new ProfileController();
$Caddiecontroller = new CaddieController();
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'home':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $Productcontroller->home();
        }
        break;
    case 'register-view':
        $Authcontroller->registerView();
        break;
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Authcontroller->register();
        }
        break;
    case 'login-view':
        $Authcontroller->loginView();
        break;
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Authcontroller->login();
        }
        break;
    case 'logout':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Authcontroller->logout();
        }
        break;
    case 'shop':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $Productcontroller->shop();
        }
        break;
    case 'autocomplete':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $Productcontroller->autocomplete();
        }
        break;
    case 'shop-view':
        $Productcontroller->shopView();
        break;
    case 'product-details':
        $Productcontroller->productDetails();
        break;
    case 'toggle-favorite':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Favoritecontroller->toggleFavorite();
        }
        break;
    case 'profile-view':
        $Profilecontroller->profileView();
        break;
    case 'update-profile':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Authcontroller->updateProfile();
        }
        break;
    case 'delete-account':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Authcontroller->deleteAccount();
        }
        break;
    case 'caddie-view':
        $Caddiecontroller->caddieView();
        break;
    case 'add-caddie':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Caddiecontroller->addToCaddie();
        }
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Action inconnue']);
}