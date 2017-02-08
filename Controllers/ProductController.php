<?php
namespace Controllers;

use Models\Product;

class ProductController
{
    private $db;
    private $product_model;


    public function __construct($db)
    {
        $this->db = $db;
        $this->product_model = new Product($this->db);
    }

    public function listProducts()
    {
        $products = $this->product_model->getProduct();
        include_once 'Views/index_frontend.php';
    }

    public function editProduct($data)
    {
        $this->product_model->updateProduct($data);

    }

    public function createProduct($data)
    {
        $this->product_model->createProduct($data);

    }

    public function deleteProduct($data)
    {
        $this->product_model->deleteProduct($data);

    }

    public function uploadFile($data)
    {
        foreach ($data["pictures"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $data["pictures"]["tmp_name"][$key];
                // basename() may prevent filesystem traversal attacks;
                // further validation/sanitation of the filename may be appropriate
                $name = basename($data["pictures"]["name"][$key]);
                move_uploaded_file($tmp_name, "./data/$name");
            }
        }
    }

}
