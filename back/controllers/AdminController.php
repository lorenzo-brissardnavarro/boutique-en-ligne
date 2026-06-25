<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\Product;

class AdminController
{
    private $product;

    public function __construct()
    {
        $db = new Database();
        $this->product = new Product($db->getConnection());
    }

   public function adminView(){

        if (empty($_SESSION['user_id'])) {
            header("Location: router.php?action=login-view");
            exit;
        }

        if ($_SESSION['role_name'] !== "admin") {
            header("Location: router.php?action=shop-view");
            exit;
        }

        $products = $this->product->getAllProducts();
        $categories = $this->product->getAllCategories();

        $productsWithImages = [];
        foreach ($products as $product) {
            $product['images'] =  $this->product->getAdditionalImages($product['id']);
            $productsWithImages[] = $product;
        }

        $products = $productsWithImages;

        require '../front/views/dashboard.php';
    }

    public function addProduct(){

        if (empty($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Non connecté']);
            return;
        }

        if ($_SESSION['role_name'] !== "admin") {
            echo json_encode(['success' => false, 'message' => 'Autorisation refusée']);
            return;
        }

        $headersToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        if (!$headersToken || $headersToken !== $_SESSION['csrf_token']) {
            echo json_encode(['success' => false, 'message' => 'Erreur token']);
            return;
        }

        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $category_id = $_POST['category_id'];
        $is_active = $_POST['is_active'];

        if (!$name || !$description || !$price || !$stock || !$category_id || !isset($_FILES["cover"])) {
            echo json_encode(['success' => false, 'message' => 'Champs requis manquants']);
            return;
        }

        $cover = $this->imageProcessing($_FILES["cover"], $name, 1);

        if (!$cover) {
            echo json_encode(['success' => false, 'message' => 'Erreur image de couverture']);
            return;
        }

        $productId = $this->product->addNewProduct($name, $description, $price, $stock, $cover, $is_active, $category_id);

        if (isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
            for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
                $file = ["name" => $_FILES['files']["name"][$i], "type" => $_FILES['files']["type"][$i], "tmp_name" => $_FILES['files']["tmp_name"][$i], "error" => $_FILES['files']["error"][$i], "size" => $_FILES['files']["size"][$i]];
                $imageName = $this->imageProcessing($file, $name, $i + 2);
                if ($imageName) {
                    $this->product->addProductImage($productId, $imageName);
                }
            }
        }

        echo json_encode(['success' => true, 'message' => 'Produit ajouté']);
    }

    public function imageProcessing($file, $name, $i){
        if ($file["error"] !== 0) {
            return null;
        }

        // Vérification taille image
        if ($file["size"] > 5 * 1024 * 1024) {
            return null;
        }

        // Vérification extension image
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        $file_extension = pathinfo($file["name"], PATHINFO_EXTENSION);
        if (!in_array($file_extension, $allowedExtensions)) {
            return null;
        }

        // Vérification du MIME type réel du fichier
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file["tmp_name"]);
        finfo_close($finfo);

        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($mimeType, $allowedMimeTypes)) {
            return null;
        }

        $name =  str_replace(' ', '-', strtolower($name));
        $name = preg_replace('/[^a-zA-Z0-9_-]/', '-', strtolower($name));
        $new_image_name = $name . '-' . $i . '-' . date('YmdHis') . '.webp';
        $destination = __DIR__ . '/../../public/images/' . $new_image_name;

        switch ($file_extension) {
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($file["tmp_name"]);
                break;
            case 'png':
                $image = imagecreatefrompng($file["tmp_name"]);
                break;
            case 'webp':
                $image = imagecreatefromwebp($file["tmp_name"]);
                break;
            default:
                return null;
        }

        if (!$image) {
            return null;
        }

        imagewebp($image, $destination, 80);
        imagedestroy($image);

        return $new_image_name;
    }

    // Modification informations utilisateur
    public function updateProductInfos(){

        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Non connecté']);
            return;
        }

        if ($_SESSION['role_name'] !== "admin") {
            echo json_encode(['success' => false, 'message' => 'Autorisation refusée']);
            return;
        }

        $headersToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        if (!$headersToken || $headersToken !== $_SESSION['csrf_token']) {
            echo json_encode(['success' => false, 'message' => 'Erreur token']);
            return;
        }

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Données invalides']);
            return;
        }

        if(empty($data['productId'])){
            echo json_encode(['success' => false, 'message' => 'Produit non défini']);
            return;
        }

        if (empty($data["name"]) || empty($data["description"]) || empty($data["price"]) || empty($data["stock"]) || empty($data["category_id"]) || !isset($data["is_active"])) {
            echo json_encode(['success' => false, 'message' => 'Champs requis manquants']);
            return;
        }


        $this->product->updateProductInfos($data['productId'], $data["name"], $data["description"], $data["price"], $data["stock"], $data["category_id"], $data["is_active"]);

        echo json_encode(['success' => true]);
    }

    public function updateProductImages(){

        if (empty($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Non connecté']);
            return;
        }

        if ($_SESSION['role_name'] !== "admin") {
            echo json_encode(['success' => false, 'message' => 'Autorisation refusée']);
            return;
        }

        $headersToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        if (!$headersToken || $headersToken !== $_SESSION['csrf_token']) {
            echo json_encode(['success' => false, 'message' => 'Erreur token']);
            return;
        }

        $productId = $_POST['product_id'];
        $name = $_POST['name'];

        if (!$productId) {
            echo json_encode(['success' => false, 'message' => 'Produit manquant']);
            return;
        }

        if (!$name) {
            echo json_encode(['success' => false, 'message' => 'Nom manquant']);
            return;
        }

        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === 0) {

            $old = $this->product->getCoverById($productId);
            $newCover = $this->imageProcessing($_FILES['cover'], $name, 1);
            if ($newCover) {
                if ($old) {
                    unlink(__DIR__ . "/../../public/images/" . $old['image']);
                }
                $this->product->updateCover($productId, $newCover);
            }
        }

        if (isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
            $startIndex = $this->product->getNextImageIndex($productId);
            for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
                $file = ["name" => $_FILES['files']["name"][$i], "type" => $_FILES['files']["type"][$i], "tmp_name" => $_FILES['files']["tmp_name"][$i], "error" => $_FILES['files']["error"][$i], "size" => $_FILES['files']["size"][$i]];
                $imageName = $this->imageProcessing($file, $name, $startIndex + $i);
                if ($imageName) {
                    $this->product->addProductImage($productId, $imageName);
                }
            }
        }

        echo json_encode(['success' => true]);
    }

    public function deleteImage(){

        if (empty($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Non connecté']);
            return;
        }

        if ($_SESSION['role_name'] !== "admin") {
            echo json_encode(['success' => false, 'message' => 'Autorisation refusée']);
            return;
        }

        $headersToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        if (!$headersToken || $headersToken !== $_SESSION['csrf_token']) {
            echo json_encode(['success' => false, 'message' => 'Erreur token']);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        $imageId = $data['image_id'];

        if (!$imageId) {
            echo json_encode(['success' => false, 'message' => 'Image non reconnue']);
            return;
        }

        $image = $this->product->getImageById($imageId);
        if ($image) {
            unlink(__DIR__ . "/../../public/images/" . $image['image']);
        }
        $this->product->deleteImage($imageId);

        echo json_encode(['success' => true]);
    }

    // Ajouter une catégorie
    public function addCategory(){

        if (empty($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Non connecté']);
            return;
        }

        if ($_SESSION['role_name'] !== "admin") {
            echo json_encode(['success' => false, 'message' => 'Autorisation refusée']);
            return;
        }

        $headersToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        if (!$headersToken || $headersToken !== $_SESSION['csrf_token']) {
            echo json_encode(['success' => false, 'message' => 'Erreur token']);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        $name = $data['name'];

        if (!$name) {
            echo json_encode(['success' => false, 'message' => 'Nom non reconnu']);
            return;
        }

        $success = $this->product->addCategory($name);

        echo json_encode(['success' => $success]);
    }

    // Modifier une catégorie
    public function updateCategory(){

        if (empty($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Non connecté']);
            return;
        }

        if ($_SESSION['role_name'] !== "admin") {
            echo json_encode(['success' => false, 'message' => 'Autorisation refusée']);
            return;
        }

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

        $id = $data['id'];
        $name = $data['name'];

        $success = $this->product->updateCategory($id, $name);

        echo json_encode(['success' => $success]);
    }

    // Supprimer une catégorie
    public function deleteCategory(){

        if (empty($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Non connecté']);
            return;
        }

        if ($_SESSION['role_name'] !== "admin") {
            echo json_encode(['success' => false, 'message' => 'Autorisation refusée']);
            return;
        }

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

        $id = $data['id'];

        $count = $this->product->getProductByCategory($id);

        if($count <= 0){
            $success = $this->product->deleteCategory($id);
        } else {
            echo json_encode(['success' => false, 'message' => "Suppression impossible car $count produit(s) appartiennent à cette catégorie"]);
            return;
        }

        echo json_encode(['success' => $success]);
    }

    
}