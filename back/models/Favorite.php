<?php
namespace App\Models;

use PDO;

class Favorite
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Vérification si le produit est déjà un favori de l'utilisateur
    public function exists($userId, $productId){
        $sql = "SELECT id FROM favorite WHERE user_id = :user_id AND product_id = :product_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':user_id' => $userId, ':product_id' => $productId]);
        return $query->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // Ajouter un produit en tant que favori
    public function add($userId, $productId){
        $sql = "INSERT INTO favorite(user_id, product_id) VALUES(:user_id, :product_id)";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':user_id' => $userId, ':product_id' => $productId]);
    }

    // Supprimer un produit des favoris
    public function remove($userId, $productId){
        $sql = "DELETE FROM favorite WHERE user_id = :user_id AND product_id = :product_id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':user_id' => $userId, ':product_id' => $productId]);
    }

    // Récupération de produits favoris d'un utilistaeur
    public function getUserFavorites($userId) {
        $sql = "SELECT product.*, category.category_name FROM favorite INNER JOIN product ON favorite.product_id = product.id INNER JOIN category on product.category_id = category.id WHERE favorite.user_id = :user_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':user_id' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
}