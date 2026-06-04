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

    // Récupération des informations d'un produit à partir de son id
    public function getById($id){
        $sql = "SELECT product.*, category.category_name FROM product INNER JOIN category on product.category_id = category.id INNER JOIN additional_image on product.id = additional_image.product_id WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Récupération de l'ensemble des produits
    public function getAllProducts() {
        $sql = "SELECT product.*, category.category_name FROM product INNER JOIN category on product.category_id = category.id";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Gestion des filtres, du tri et de la barre de recherche
    public function searchAdvanced($keyword, $sort, $category, $min, $max, $availability){
        $sql = "SELECT product.*, category.category_name FROM product INNER JOIN category ON product.category_id = category.id WHERE product.is_active = 1";

        $params = [];

        if ($keyword !== "") {
            $sql .= " AND product.product_name LIKE :keyword";
            $params[':keyword'] = "%{$keyword}%";
        }

        if ($category !== "all") {
            $sql .= " AND category.category_name = :category";
            $params[':category'] = $category;
        }

        if ($min !== "all" && $min !== "") {
            $sql .= " AND product.price >= :min";
            $params[':min'] = (float)$min;
        }

        if ($max !== "all" && $max !== "") {
            $sql .= " AND product.price <= :max";
            $params[':max'] = (float)$max;
        }

        if ($availability === 1) {
            $sql .= " AND product.stock > 0";
        }

        switch ($sort) {
            case 'price_asc':
                $sql .= " ORDER BY product.price ASC";
                break;

            case 'price_desc':
                $sql .= " ORDER BY product.price DESC";
                break;

            case 'name_asc':
                $sql .= " ORDER BY product.product_name ASC";
                break;

            case 'name_desc':
                $sql .= " ORDER BY product.product_name DESC";
                break;
        }

        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupération de l'ensemble des catégories
    public function getAllCategories(){
        $sql = "SELECT * FROM category";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
}