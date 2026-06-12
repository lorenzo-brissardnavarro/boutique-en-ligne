<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\Caddie;
use App\Models\Order;

class OrderController
{
    private $order;
    private $caddie;

    public function __construct()
    {
        $db = new Database();
        $this->order = new Order($db->getConnection());
        $this->caddie = new Caddie($db->getConnection());
    }

   public function addOrder(){

        if (empty($_SESSION['user_id'])) {
            echo json_encode(["success" => false, "message" => "Connexion requise"]);
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
        }

        $this->caddie->clearCaddie($caddieId);

        echo json_encode(["success" => true, "message" => "Commande validée"]);
    }
}