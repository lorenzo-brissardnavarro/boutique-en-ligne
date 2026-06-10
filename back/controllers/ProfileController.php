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
        $caddieCount = (new CaddieController())->getCaddieCount();
        require '../front/views/user-profile.php';
    }

    // Modification informations utilisateur
    public function updateProfile(){
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Non connecté']);
            return;
        }

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Données invalides']);
            return;
        }

        if (empty($data["firstname"]) || empty($data["surname"]) || empty($data["email"]) || empty($data["phone"]) || empty($data["birthday"]) || empty($data["address"])) {
            echo json_encode(['success' => false, 'message' => 'Champs requis manquants']);
            return;
        }

        if (strlen($data['firstname']) < 2) {
            echo json_encode(['success' => false, 'message' => 'Le prénom doit contenir au moins 2 caractères.']);
            return;
        }

        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => "L'adresse mail n'est pas au bon format."]);
            return;
        }

        if (!preg_match('/^0[6-7]\d{8}$/', $data["phone"])) {
            echo json_encode(['success' => false, 'message' => "Le numéro de téléphone n'est pas au bon format."]);
            return;
        }

        $birthday = strtotime($data["birthday"]);
        $minDate = strtotime("1900-01-01");
        $maxDate = time();

        if ($birthday < $minDate || $birthday > $maxDate) {
            echo json_encode(['success' => false, 'message' => "La date de naissance n'est pas valide."]);
            return;
        }

        if (!preg_match('/^\d+\s+[A-Za-zÀ-ÿ\s\'-]{3,}$/', $data["address"])) {
            echo json_encode(['success' => false, 'message' => "L'adresse postale n'est pas valide."]);
            return;
        }

        if ($this->user->emailExistsOtherUser($_SESSION['user_id'], $data["email"])) {
            echo json_encode(['success' => false, 'message' => "Email déjà utilisé"]);
            return;
        }

        $this->user->update($_SESSION['user_id'], $data["firstname"], $data["surname"], $data["email"], $data["phone"], $data["birthday"], $data["address"]);

        echo json_encode(['success' => true]);
    }

    // Suppression du compte utilisateur
    public function deleteAccount() {
        if (empty($_SESSION['user_id'])) {
            header("Location: router.php?action=login-view");
            exit;
        }

        $id = $_SESSION['user_id'];
        $success = $this->user->delete($id);
        if($success) {
            $_SESSION = [];
            session_destroy();
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression']);
        }

    }

    
}