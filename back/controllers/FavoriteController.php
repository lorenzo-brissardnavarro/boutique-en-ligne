<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\Favorite;

class FavoriteController
{
    private $favorite;

    public function __construct()
    {
        $db = new Database();
        $this->favorite = new Favorite($db->getConnection());
    }

    public function toggleFavorite(){
        $headersToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        if (!$headersToken || $headersToken !== $_SESSION['csrf_token']) {
            echo json_encode(['success' => false, 'message' => 'Erreur token']);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Données invalides']);
            return;
        }

        if (empty($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Connexion requise']);
            return;
        }

        $userId = $_SESSION['user_id'];
        $productId = (int)$data['productId'];

        if ($this->favorite->exists($userId, $productId)) {
            $this->favorite->remove($userId, $productId);
            echo json_encode(['success' => true, 'message' => 'Suppression du favori', 'action' => 'remove']);
        } else {
            $this->favorite->add($userId, $productId);
            echo json_encode(['success' => true, 'message' => 'Ajout du favori', 'action' => 'add']);
        }
    }

   
}