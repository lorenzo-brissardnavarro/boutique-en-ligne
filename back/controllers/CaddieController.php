<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\Caddie;
use App\Models\User;

class CaddieController
{
    private $product;
    private $favorite;

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

        $userId = $_SESSION['user_id'];

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

    
}