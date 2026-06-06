<?php
namespace App\Models;

use PDO;

class User
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /////////////////////////////////////////////////////// Inscription ////////////////////////////////////////////////////////

    // Enregistrement des données d'inscription de l'utilisateur dans la BDD
    public function create($firstname, $surname, $email, $phone, $birthday, $address, $password, $role){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (firstname, surname, email, phone, birthday, address, password, role_id) VALUES (:firstname, :surname, :email, :phone, :birthday, :address, :password, :role_id)";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':firstname' => $firstname, ':surname' => $surname, ':email' => $email, ':phone' => $phone, ':birthday' => $birthday, ':address' => $address, ':password' => $hash, ':role_id' => $role]);
    }

    // Vérification si email existe déjà dans la BDD
    public function emailExists($email){
        $sql = "SELECT id FROM user WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute([':email' => $email]);
        return $query->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // Récupérer l'id d'un role
    public function getRoleIdByName($roleName){
        $sql = "SELECT id FROM role WHERE role_name = :role_name";
        $query = $this->pdo->prepare($sql);
        $query->execute([':role_name' => $roleName]);
        $role = $query->fetch(PDO::FETCH_ASSOC);
        return $role['id'];
    }


    ///////////////////////////////////////////////////////// Connexion /////////////////////////////////////////////////////////////////

    // Récupération des informations d'un utilisateur
    public function findByEmail($email){
        $sql = "SELECT * FROM user WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute([':email' => $email]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Récupération des informations d'un utilisateur
    public function getById($id){
        $sql = "SELECT * FROM user WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}