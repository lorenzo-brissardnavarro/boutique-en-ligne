<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\Caddie;

class CaddieController
{
    private $caddie;

    public function __construct()
    {
        $db = new Database();
        $this->caddie = new Caddie($db->getConnection());
    }

   public function caddieView(){

         if (empty($_SESSION['user_id'])) {
            header("Location: router.php?action=login-view");
            exit;
        }

        if ($_SESSION['role_name'] === "admin") {
            header("Location: router.php?action=admin-view");
            exit;
        }

        $userId = $_SESSION['user_id'];
        $caddie = $this->caddie->getByUser($userId);

        if (!$caddie) {
            $this->caddie->createCaddie($userId);
            $caddie = $this->caddie->getByUser($userId);
        }

        $data = $this->caddie->getCaddieByUser($userId, $caddie['id']);
        $total = (float) $this->caddie->totalAmount($caddie['id']);
        if($total > 50){
            $delivery = 0;
        } else {
            $delivery = 3.99;
        }

        $deliveryMissing = round(50 - $total, 2);
        $finalTotal = round($total + $delivery, 2);

        $caddieId = $caddie['id'];
        $caddieCount = $this->caddie->countItems($caddieId);

        require '../front/views/shopping-basket.php';
    }

    public function addToCaddie(){

        if (empty($_SESSION['user_id'])) {
            echo json_encode(["success" => false, "message" => "Connexion requise"]);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || empty($data['productId'])) {
            echo json_encode(["success" => false, "message" => "Produit invalide"]);
            return;
        }

        $userId = $_SESSION['user_id'];
        $productId = (int)$data['productId'];
        $qty = isset($data['quantity']) ? (int)$data['quantity'] : 1;

        $caddie = $this->caddie->getByUser($userId);

        if (!$caddie) {
            $this->caddie->createCaddie($userId);
            $caddie = $this->caddie->getByUser($userId);
        }

        $caddieId = $caddie['id'];

        $stock = $this->caddie->getStock($productId);
        $currentQty = $this->caddie->getItemQuantity($productId, $caddieId);

        if ($currentQty + $qty > $stock) {
            echo json_encode(["success" => false, "message" => "Stock insuffisant"]);
            return;
        }

        if ($this->caddie->itemExists($productId, $caddieId)) {
            $this->caddie->addQuantityItem($productId, $caddieId, $qty);
        } else {
            $this->caddie->addItem($productId, $caddieId, $qty);
        }

        echo json_encode(["success" => true, "message" => "Produit ajouté au panier", "count" => $this->caddie->countItems($caddieId)]);
    }

    public function updateCaddie() {
        if (empty($_SESSION['user_id'])) {
            echo json_encode(["success" => false, "message" => "Connexion requise"]);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || empty($data['productId'])) {
            echo json_encode(["success" => false, "message" => "Produit invalide"]);
            return;
        }

        $userId = $_SESSION['user_id'];
        $productId = (int)$data["productId"];
        $quantity = (int)$data["quantity"];

        $stock = $this->caddie->getStock($productId);

        if($stock < $quantity) {
            echo json_encode(["success" => false, "message" => "Stock insuffisant"]);
            return;
        }

        $caddie = $this->caddie->getByUser($userId);
        $caddieId = $caddie['id'];
        $this->caddie->updateQuantityItem($productId, $caddieId, $quantity);

        $total = (float) $this->caddie->totalAmount($caddie['id']);
        if($total >= 50){
            $delivery = 0;
        } else {
            $delivery = 3.99;
        }

        $deliveryMissing = round(50 - $total, 2);
        $finalTotal = round($total + $delivery, 2);

        echo json_encode(["success" => true, "total" => round($total, 2), "delivery" => $delivery, "deliveryMissing" => $deliveryMissing, "finalTotal" => $finalTotal, "count" => $this->caddie->countItems($caddieId)]);
    }

    public function deleteCaddie() {
        if (empty($_SESSION['user_id'])) {
            echo json_encode(["success" => false, "message" => "Connexion requise"]);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || empty($data['productId'])) {
            echo json_encode(["success" => false, "message" => "Produit invalide"]);
            return;
        }

        $userId = $_SESSION['user_id'];
        $productId = (int)$data["productId"];
        $caddie = $this->caddie->getByUser($userId);
        $caddieId = $caddie['id'];

        $this->caddie->deleteItem($productId, $caddieId);
        $total = (float) $this->caddie->totalAmount($caddie['id']);
        if($total >= 50){
            $delivery = 0;
        } else {
            $delivery = 3.99;
        }

        $deliveryMissing = round(50 - $total, 2);
        $finalTotal = round($total + $delivery, 2);

        echo json_encode(["success" => true, "message" => "Produit supprimé", "total" => round($total, 2), "delivery" => $delivery, "deliveryMissing" => $deliveryMissing, "finalTotal" => $finalTotal, "count" => $this->caddie->countItems($caddieId)]);
    }

    public function getCaddieCount(){
        if (empty($_SESSION['user_id'])) {
            return 0;
        }

        $caddie = $this->caddie->getByUser($_SESSION['user_id']);

        if (!$caddie) {
            return 0;
        }

        return $this->caddie->countItems($caddie['id']);
    }

    
}