<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\Product;
use App\Models\Favorite;

class ProductController
{
    private $product;
    private $favorite;

    public function __construct()
    {
        $db = new Database();
        $this->product = new Product($db->getConnection());
        $this->favorite = new Favorite($db->getConnection());
    }

   public function home(){
        if (!empty($_SESSION['user_id']) && $_SESSION['role_name'] === "admin") {
            header("Location: router.php?action=admin-view");
            exit;
        }

        $top = $this->product->topProducts();
        $news = $this->product->newProducts();
        $caddieCount = (new CaddieController())->getCaddieCount();
        require '../front/views/home.php';
    }

    public function productDetails(){
        if (!empty($_SESSION['user_id']) && $_SESSION['role_name'] === "admin") {
            header("Location: router.php?action=admin-view");
            exit;
        }

        $id = (int)$_GET['id'] ?? '';
        $product = $this->product->getById($id);
        $additionalImages = $this->product->getAdditionalImages($id);

        $isFavorite = false;
        if (!empty($_SESSION['user_id'])) {
            $isFavorite = $this->favorite->exists($_SESSION['user_id'], $id);
        }
        $caddieCount = (new CaddieController())->getCaddieCount();
        require '../front/views/product-details.php';
    }

    public function shop(){
        $keyword = $_GET['keyword'] ?? '';
        $sort = $_GET['sort'] ?? 'all';
        $category = $_GET['category'] ?? 'all';
        $min = $_GET['min'] ?? 'all';
        $max = $_GET['max'] ?? 'all';
        $availability = (int)($_GET['availability'] ?? 0);

        $products = $this->product->searchAdvanced($keyword, $sort, $category, $min, $max, $availability);
        echo json_encode(["success" => true, "data" => $products]);
    }

    public function shopView(){
        if (!empty($_SESSION['user_id']) && $_SESSION['role_name'] === "admin") {
            header("Location: router.php?action=admin-view");
            exit;
        }

        $categories = $this->product->getAllCategories();
        $caddieCount = (new CaddieController())->getCaddieCount();
        require '../front/views/shop.php';
    }

    public function autocomplete(){
        $keyword = $_GET['keyword'] ?? '';
        $products = $this->product->autocomplete($keyword);
        echo json_encode(["success" => true, "data" => $products]);
    }
}