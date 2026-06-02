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
        header('Content-Type: application/json');
        $top = $this->product->topProducts();
        $news = $this->product->newProducts();
        echo json_encode(["success" => true, "data" => ["top" => $top, "news" => $news]]);
    }
}