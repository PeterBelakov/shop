<?php
include 'config.php';
include 'Drivers/Database.php';
include 'Drivers/DatabaseStatement.php';
include 'DTO/ProductDTO.php';
include 'Controllers/ProductController.php';
include 'Models/Product.php';


Drivers\Database::setInstance($database['host'], $database['username'], $database['password'], $database['dbName'], $database['access']);
$db = Drivers\Database::getInstance($database['access']);

$productController = new \Controllers\ProductController($db);

/*
 * CRUD
 */

//Delete
if (isset($_GET['action']) && ($_GET['action'] == 'delete_product') && !empty($_GET['id'])) {
    $productController->deleteProduct($_GET['id']);
}
if ($_POST) {

    // Create
    if ($_POST['action'] == 'add_product') {
        $productController->createProduct($_POST);
    }

    // Update product
    if ($_POST['action'] == 'update_product') {
        $productController->editProduct($_POST);
    }
    if ($_POST['action'] == 'upload_files') {
        $productController->uploadFile($_FILES);
    }
}


//Read / List products
$productController->listProducts();
