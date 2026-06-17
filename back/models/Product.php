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
        $sql = "SELECT product.*, category.category_name FROM product INNER JOIN category on product.category_id = category.id WHERE product.is_active = 1 LIMIT 4";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupération des nouveaux produits
    public function newProducts() {
        $sql = "SELECT product.*, category.category_name FROM product INNER JOIN category on product.category_id = category.id WHERE product.is_active = 1 ORDER BY id DESC LIMIT 4";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupération des informations générales d'un produit à partir de son id
    public function getById($id){
        $sql = "SELECT product.*, category.category_name FROM product INNER JOIN category on product.category_id = category.id WHERE product.id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Récupération des images suppplémentaires accociées à chaque produit
    public function getAdditionalImages($productId){
        $sql = "SELECT id, image FROM additional_image WHERE product_id = :product_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':product_id' => $productId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
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

    // Récupération de maximum 3 suggestions selon le texte écrit dans la barre de recherche
    public function autocomplete($keyword){
        $sql = "SELECT product_name FROM product WHERE product_name LIKE :keyword LIMIT 3";
        $query = $this->pdo->prepare($sql);
        $query->execute(["keyword" => "%$keyword%"]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Modification de la quantité de stock restant pour un produit après commande
    public function updateStockItem($productId, $quantity){
        $sql = "UPDATE product SET stock = stock - :quantity WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':quantity' => $quantity, ':id' => $productId]);
    }

    // Enregistrement des données de nouveau produit dans la BDD
    public function addNewProduct($name, $description, $price, $stock, $image, $is_active, $category_id){
        $sql = "INSERT INTO product (product_name, description, price, stock, image, is_active, category_id) VALUES (:product_name, :description, :price, :stock, :image, :is_active, :category_id)";
        $query = $this->pdo->prepare($sql);
        $query->execute([':product_name' => $name, ':description' => $description, ':price' => $price, ':stock' => $stock, ':image' => $image, ':is_active' => $is_active, ':category_id' => $category_id]);
        return $this->pdo->lastInsertId();
    }

    // Ajout d'une image additionnelle pour un produit
    public function addProductImage($productId, $image){
        $sql = "INSERT INTO additional_image (image, product_id) VALUES (:image, :product_id)";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':image' => $image, ':product_id' => $productId]);
    }

    // Modification des informations d'un produit
    public function updateProductInfos($productId, $name, $description, $price, $stock, $category_id, $is_active) {
        $sql = "UPDATE product SET product_name = :name, description = :description, price = :price, stock = :stock, category_id = :category_id, is_active = :is_active WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':id' => $productId, ':name' => $name, ':description' => $description, ':price' => $price, ':stock' => $stock, ':category_id' => $category_id, ':is_active' => $is_active]);
    }

    // Récupération de l'image d'un produit
    public function getCoverById($productId){
        $sql = "SELECT image FROM product WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([":id" => $productId]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getImageById($id){
        $sql = "SELECT * FROM additional_image WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Modification de l'image d'un produit
    public function updateCover($productId, $newCover){
        $sql = "UPDATE product SET image = :image WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':image' => $newCover, ':id' => $productId]);
    }

    // Calcul du numéro à mettre pour le nom de l'image
    public function getNextImageIndex($productId){
        $sql = "SELECT COUNT(*) AS count_index FROM additional_image WHERE product_id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':id' => $productId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return (int)$result['count_index'] + 2;
    }

    // Suppression d'une image additionnelle
    public function deleteImage($id){
        $sql = "DELETE FROM additional_image WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':id' => $id]);
    }

    // Récupération des images additonnelles d'un produit
    public function getAllAdditionalImage($productId){
        $sql = "SELECT image FROM additional_image WHERE product_id = :product_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':product_id' => $productId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajout d'une catégorie
    public function addCategory($name){
        $sql = "INSERT INTO category (category_name) VALUES (:category_name)";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':category_name' => $name]);
    }

    // Modification d'une catégorie
    public function updateCategory($id, $name){
        $sql = "UPDATE category SET category_name = :category_name WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':category_name' => $name, ':id' => $id]);
    }
    
    // Compter le nombre de produits qui appartiennent à une catégorie
    public function getProductByCategory($id){
        $sql = "SELECT COUNT(*) AS count_products FROM product WHERE category_id = :category_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':category_id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return (int)$result['count_products'];
    }

    // Suppression d'une catégorie en particulier
    public function deleteCategory($id){
        $sql = "DELETE FROM category WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':id' => $id]);
    }
}