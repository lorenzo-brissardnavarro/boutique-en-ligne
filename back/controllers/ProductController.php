<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\Product;

class ProductController
{
    private $product;

    public function __construct()
    {
        $db = new Database();
        $this->product = new Product($db->getConnection());
    }

   public function home(){
        $top = $this->product->topProducts();
        $news = $this->product->newProducts();
        require '../front/views/home.php';
    }

    public function productDetails(){
        $id = (int)$_GET['id'] ?? '';
        $product = $this->product->getById($id);
        $additionalImages = $this->product->getAdditionalImages($id);
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
        $categories = $this->product->getAllCategories();
        require '../front/views/shop.php';
    }

    public function autocomplete(){
        $keyword = $_GET['keyword'] ?? '';
        $products = $this->product->autocomplete($keyword);
        echo json_encode(["success" => true, "data" => $products]);
    }
}