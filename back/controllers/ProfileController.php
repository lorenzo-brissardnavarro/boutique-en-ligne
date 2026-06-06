<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\User;
use App\Models\Favorite;

class ProfileController
{
    private $product;
    private $favorite;

    public function __construct()
    {
        $db = new Database();
        $this->user = new User($db->getConnection());
        $this->favorite = new Favorite($db->getConnection());
    }

   public function profileView(){

         if (empty($_SESSION['user_id'])) {
            header("Location: router.php?action=login-view");
            exit;
        }

        $userId = $_SESSION['user_id'];

        $user = $this->user->getById($userId);
        $favorites = $this->favorite->getUserFavorites($userId);
        require '../front/views/user-profile.php';
    }

    
}