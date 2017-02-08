<?php

namespace Models;
use Drivers\Database;


class Product
{
    /**
     * @var Database
     */
    private $db;

    public function __construct(Database $db)
    {

        $this->db = $db;

    }

    public function getProduct()
    {
        $query = "SELECT * FROM products ORDER BY id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll();
        return $row;
    }

    public function createProduct(array $productData)
    {
        $name = $productData['name'];
        $quantity = $productData['quantity'];
        $price = $productData['price'];
        $size = $productData['size'];
        $color = $productData['color'];
        $query = "INSERT INTO products (name, quantity, price, size, color) 
                  VALUES (?, ?, ?, ?, ?)";
        $productArgs = [$name, $quantity, $price, $size, $color];
        $stmt = $this->db->prepare($query);
        $stmt->execute($productArgs);
        return $stmt;
    }

    public function updateProduct(array $productData)
    {
        $query = "UPDATE products
                  SET 
                  name = ?, 
                  quantity = ?,
                  price = ?,
                  size = ?,
                  color = ? WHERE id = ?";
        $preparedArgs = [$productData['name'], $productData['quantity'], $productData['price'], $productData['size'], $productData['color'], $productData['id']];
        $stmt = $this->db->prepare($query);
        return $stmt->execute($preparedArgs);

    }

    public function deleteProduct($id)
    {
        $query = "DELETE FROM products WHERE id = $id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }

}

