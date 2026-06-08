<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\User;

class AuthController
{
    private $user;

    public function __construct()
    {
        $db = new Database();
        $this->user = new User($db->getConnection());
    }

    // View de la page d'inscription
    public function registerView(){
        require '../front/views/registration.php';
    }

    // Inscription de l'utilisateur
    public function register(){
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Données invalides']);
            return;
        }

        if (empty($data["firstname"]) || empty($data["surname"]) || empty($data["email"]) || empty($data["phone"]) || empty($data["birthday"]) || empty($data["address"]) || empty($data["password"]) || empty($data["confirm"])) {
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

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,16}$/', $data["password"])) {
            echo json_encode(['success' => false, 'message' => "Le mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule, un chiffre et un caractère spécial"]);
            return;
        }

        if ($data["password"] !== $data["confirm"]) {
            echo json_encode(['success' => false, 'message' => "Les mots de passe doivent être identiques."]);
            return;
        }

        if($this->user->emailExists($data["email"])) {
            echo json_encode(['success' => false, 'message' => "Ce mail est déjà utilisé."]);
            return;
        }

        if($data["firstname"] === "root" && $data["surname"] === "root") {
            $role = $this->user->getRoleIdByName("admin");
        } else {
            $role = $this->user->getRoleIdByName("client");
        }
        
        $this->user->create($data["firstname"], $data["surname"], $data["email"], $data["phone"], $data["birthday"], $data["address"], $data["password"], $role);
        echo json_encode(['success' => true, 'message' => 'Compte créé avec succès']);
    }


    // View de la page de connexion
    public function loginView(){
        require '../front/views/login.php';
    }

    // Connexion de l'utilisateur
    public function login() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Données invalides']);
            return;
        }

        if (empty($data["email"]) || empty($data["password"])) {
            echo json_encode(['success' => false, 'message' => 'Champs requis manquants']);
            return;
        }

        $user = $this->user->findByEmail($data["email"]);

        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'Identifiant ou mot de passe incorrect']);
            return;
        }

        if (password_verify($data["password"], $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            echo json_encode(['success' => true, 'user' => $user['id']]);

        } else {
            echo json_encode(['success' => false, 'message' => 'Identifiant ou mot de passe incorrect']);
        }
    }

    // Déconnexion de l'utilisateur
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();
        echo json_encode(['success' => true]);
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