<?php
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require '../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\ProductController;

$Authcontroller = new AuthController();
$Productcontroller = new ProductController();
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'home':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $Productcontroller->home();
        }
        break;
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Authcontroller->register();
        }
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
    default:
        echo json_encode(['success' => false, 'message' => 'Action inconnue']);
}