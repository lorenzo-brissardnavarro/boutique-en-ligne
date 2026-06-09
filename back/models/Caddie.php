<?php
namespace App\Models;

use PDO;

class Caddie
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer l'id du panier de l'utilisateur
    public function getByUser($userId){
        $sql = "SELECT * FROM caddie WHERE user_id = :user_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':user_id' => $userId]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Ajout d'un article dans le panier
    public function createCaddie($userId){
        $sql = "INSERT INTO caddie (user_id) VALUES (:user_id)";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':user_id' => $userId]);
    }

    // Ajout d'un article dans le panier
    public function addItem($productId, $caddieId, $qty){
        $sql = "INSERT INTO caddie_content (product_id, quantity, caddie_id) VALUES (:product_id, :quantity, :caddie_id)";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':product_id' => $productId, ':quantity' => $qty, ':caddie_id' => $caddieId]);
    }

    // Ajout d'une quantité en plus pour un article du panier
    public function addQuantityItem($productId, $caddieId, $qty){
        $sql = "UPDATE caddie_content SET quantity = quantity + :qty WHERE product_id = :product_id AND caddie_id = :caddie_id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':qty' => $qty, ':product_id' => $productId, ':caddie_id' => $caddieId]);
    }

    // Modification de la quantité d'un produit du panier
    public function updateQuantityItem($productId, $caddieId, $qty){
        $sql = "UPDATE caddie_content SET quantity = :quantity WHERE product_id = :product_id AND caddie_id = :caddie_id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':quantity' => $qty, ':product_id' => $productId, ':caddie_id' => $caddieId]);
    }

    // Ajout d'une quantité en moins pour un article du panier
    public function decreaseQuantityItem($productId, $caddieId){
        $sql = "UPDATE caddie_content SET quantity = quantity - 1 WHERE product_id = :product_id AND caddie_id = :caddie_id AND quantity > 1";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':product_id' => $productId, ':caddie_id' => $caddieId]);
    }

    // Suppression d'un article du panier
    public function deleteItem($productId, $caddieId) {
        $sql = "DELETE FROM caddie_content WHERE product_id = :product_id AND caddie_id = :caddie_id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':product_id' => $productId, ':caddie_id' => $caddieId]);
    }

    // Vérification pour savoir si le produit est déjà présent dans le panier
    public function itemExists($productId, $caddieId){
        $sql = "SELECT id FROM caddie_content WHERE product_id = :product_id AND caddie_id = :caddie_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':product_id' => $productId, ':caddie_id' => $caddieId]);
        return $query->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // Compter le nombre d'articles différents dans le panier
    public function countItems($caddieId) {
        $sql = "SELECT COUNT(*) AS count_item FROM caddie_content WHERE caddie_id = :caddie_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':caddie_id' => $caddieId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return (int)$result['count_item'];
    }

    // Montant total du panier
    public function totalAmount($caddieId){
        $sql = "SELECT SUM(product.price * caddie_content.quantity) AS total FROM caddie_content INNER JOIN product ON caddie_content.product_id = product.id  WHERE caddie_content.caddie_id = :caddie_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':caddie_id' => $caddieId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return (float)$result['total'];
    }

    // Récupérer l'ensemble des articles présents dans le panier d'un utilisateur
    public function getCaddieByUser($userId, $caddieId){
        $sql = "SELECT caddie_content.quantity, product.*, category.category_name FROM caddie_content INNER JOIN caddie ON caddie_content.caddie_id = caddie.id INNER JOIN product ON caddie_content.product_id = product.id INNER JOIN category ON product.category_id = category.id WHERE caddie.id = :caddie_id AND caddie.user_id = :user_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':caddie_id' => $caddieId, ':user_id' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer le stock d'un produit
    public function getStock($productId){
        $sql = "SELECT stock FROM product WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':id' => $productId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return (int)$result['stock'];
    }

    // Récupérer la quantité
    public function getItemQuantity($productId, $caddieId){
        $sql = "SELECT quantity FROM caddie_content WHERE product_id = :product_id AND caddie_id = :caddie_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':product_id' => $productId, ':caddie_id' => $caddieId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return (int)$result['quantity'];
    }

}