<?php
namespace App\ImageCrud\Databases;
use PDO;
use PDOException;

class ProductModel
{
    private $db;

    public function __construct($db)
 {
  $this->db = $db->connect();
 }


  public function getAllProduct()
    {
        try {
            $query = "SELECT p.*, c.category_name
                      FROM products p
                      INNER JOIN categories c ON p.category_id = c.id";

            $statement = $this->db->prepare($query);
            $statement->execute();

            // Fetch all rows as an associative array
            $products = $statement->fetchAll(\PDO::FETCH_ASSOC);

            // Return the products array
            return $products;
        } catch (\PDOException $e) {
            // Handle the exception (you can log the error, display a message, etc.)
            return [];
        }
    }
    public function insertProduct($data)
    {
         
        try {
           $query = "INSERT INTO products (category_id, title, description, price, qty, product_image, public_status, created_at) 
          VALUES (:category_id, :title, :description, :price, :qty, :product_image, :public_status, NOW())";
            $statement = $this->db->prepare($query);
            $statement->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getProductByID($productID)
    {
        try {
            $query = "SELECT p.*, c.category_name
                      FROM products p
                      INNER JOIN categories c ON p.category_id = c.id
                      WHERE p.id = :product_id";

            $statement = $this->db->prepare($query);
            $statement->bindParam(':product_id', $productID, \PDO::PARAM_INT);
            $statement->execute();

            // Fetch the product as an associative array
            $product = $statement->fetch(\PDO::FETCH_ASSOC);

            // Return the product details
            return $product;
        } catch (\PDOException $e) {
            // Handle the exception (you can log the error, display a message, etc.)
            return null;
        }
    }
    //  public function updateProduct($data)
    // {
    //     try {
    //         $query = "UPDATE products 
    //                   SET category_id = :category_id,
    //                       title = :title,
    //                       description = :description,
    //                       price = :price,
    //                       qty = :qty,
    //                       product_image = :product_image,
    //                       public_status = :public_status
    //                   WHERE id = :id";

    //         $statement = $this->db->prepare($query);
    //         $statement->execute($data);

    //         // Return the updated product ID or true if you prefer
    //         return $data['id'];
    //     } catch (\PDOException $e) {
    //         // Handle the exception (you can log the error, display a message, etc.)
    //         return false;
    //     }
    // }


        public function updateProduct($data)
    {
        try {
            // Check if the new product image is provided
            if (empty($data['product_image'])) {
                // If not, fetch the old product image from the database
                $oldProductImage = $this->getProductImageById($data['id']);
                $data['product_image'] = $oldProductImage;
            }

            $query = "UPDATE products 
                      SET category_id = :category_id,
                          title = :title,
                          description = :description,
                          price = :price,
                          qty = :qty,
                          product_image = :product_image,
                          public_status = :public_status
                      WHERE id = :id";

            $statement = $this->db->prepare($query);
            $statement->execute($data);

            // Return the updated product ID or true if you prefer
            return $data['id'];
        } catch (\PDOException $e) {
            // Handle the exception (you can log the error, display a message, etc.)
            return false;
        }
    }

    // Add a method to fetch the old product image from the database
    public function getProductImageById($id)
    {
        try {
            $query = "SELECT product_image FROM products WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->execute(['id' => $id]);
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result ? $result['product_image'] : null;
        } catch (\PDOException $e) {
            // Handle the exception (you can log the error, display a message, etc.)
            return null;
        }
    }

    public function deleteProduct($id)
    {
        try {
            $query = "DELETE FROM products WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->execute(['id' => $id]);

            // Return true if the deletion was successful
            return true;
        } catch (\PDOException $e) {
            // Handle the exception (you can log the error, display a message, etc.)
            return false;
        }
    }

}