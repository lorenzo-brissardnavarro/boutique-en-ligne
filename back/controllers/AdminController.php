<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\Product;

class AdminController
{
    private $product;

    public function __construct()
    {
        $db = new Database();
        $this->product = new Product($db->getConnection());
    }

   public function adminView(){

        if (empty($_SESSION['user_id'])) {
            header("Location: router.php?action=login-view");
            exit;
        }

        if ($_SESSION['role_name'] !== "admin") {
            header("Location: router.php?action=shop-view");
            exit;
        }

        $products = $this->product->getAllProducts();
        $categories = $this->product->getAllCategories();

        require '../front/views/dashboard.php';
    }

    
}