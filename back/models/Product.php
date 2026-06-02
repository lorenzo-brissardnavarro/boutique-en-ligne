<?php
namespace App\Models;

use PDO;

class Product
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupération des produits phares
    public function topProducts() {
        $sql = "SELECT product.*, category.category_name FROM product INNER JOIN category on product.category_id = category.id LIMIT 4";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupération des nouveaux produits
    public function newProducts() {
        $sql = "SELECT product.*, category.category_name FROM product INNER JOIN category on product.category_id = category.id ORDER BY id DESC LIMIT 4";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
}