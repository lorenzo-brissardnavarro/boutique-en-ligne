<?php
namespace App\Models;

use PDO;

class Order {
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Modifier le numéro de commande
    public function updateNumberOrder($orderId, $number){
        $sql = "UPDATE `order` SET number = :number WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':number' => $number, ':id' => $orderId]);
    }

    // Ajout d'une commande pour l'utilisateur
    public function createOrder($number, $price, $userId){
        $sql = "INSERT INTO `order` (number, total_price, user_id) VALUES (:number, :total_price, :user_id)";
        $query = $this->pdo->prepare($sql);
        $query->execute([':number' => $number, ':total_price' => $price, ':user_id' => $userId]);
        return $this->pdo->lastInsertId();
    }

    // Ajout d'un article du panier dans la commande
    public function addItemToOrder($orderId, $productId, $qty, $unitPrice){
        $sql = "INSERT INTO order_content (order_id, product_id, quantity, unit_price) VALUES (:order_id, :product_id, :quantity, :unit_price)";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':order_id' => $orderId, ':product_id' => $productId, ':quantity' => $qty, ':unit_price' => $unitPrice]);
    }

    // Récupérer l'ensemble des commandes passées par un utilisateur
    public function getOrderByUser($userId){
        $sql = "SELECT order.id AS order_id, order.number, order.total_price, order.user_id, order_content.quantity, order_content.unit_price, product.id AS product_id, product.product_name FROM `order` INNER JOIN order_content ON order_content.order_id = order.id INNER JOIN product ON order_content.product_id = product.id WHERE order.user_id = :user_id ORDER BY order.id DESC";
        $query = $this->pdo->prepare($sql);
        $query->execute([':user_id' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Compter le nombre d'articles présents dans la commande
    public function countItemsInOrder($orderId) {
        $sql = "SELECT COUNT(*) AS count_item FROM order_content WHERE order_id = :order_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':order_id' => $orderId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return (int)$result['count_item'];
    }

}