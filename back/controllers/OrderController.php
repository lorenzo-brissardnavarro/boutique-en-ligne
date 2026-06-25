<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\Caddie;
use App\Models\Order;
use App\Models\Product;

class OrderController
{
    private $order;
    private $caddie;
    private $product;

    public function __construct()
    {
        $db = new Database();
        $this->order = new Order($db->getConnection());
        $this->caddie = new Caddie($db->getConnection());
        $this->product = new Product($db->getConnection());
    }

   public function addOrder(){

        if (empty($_SESSION['user_id'])) {
            echo json_encode(["success" => false, "message" => "Connexion requise"]);
            return;
        }

        $headersToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        if (!$headersToken || $headersToken !== $_SESSION['csrf_token']) {
            echo json_encode(['success' => false, 'message' => 'Erreur token']);
            return;
        }

        $userId = $_SESSION['user_id'];

        $caddie = $this->caddie->getByUser($userId);
        $caddieId = $caddie['id'];

        $total = (float) $this->caddie->totalAmount($caddieId);
        $products = $this->caddie->getCaddieByUser($userId, $caddieId);

        if (empty($products)) {
            echo json_encode(["success" => false, "message" => "Le panier est vide"]);
            return;
        }

        $orderId = $this->order->createOrder('', $total, $userId);

        $orderNumber = 'CMD-' . date('Ymd') . '-' . str_pad($orderId, 6, '0', STR_PAD_LEFT);
        $this->order->updateNumberOrder($orderId, $orderNumber);

        foreach ($products as $product) {
            $this->order->addItemToOrder($orderId, $product['id'], $product['quantity'], $product['price']);
            $this->product->updateStockItem($product['id'], $product['quantity']);
        }

        $this->caddie->clearCaddie($caddieId);

        echo json_encode(["success" => true, "message" => "Commande validée"]);
    }
}