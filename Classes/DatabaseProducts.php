<?php
require_once __DIR__ ."/DatabaseConnection.php";
require_once __DIR__ ."/Product.php";

class DatabaseProducts extends DatabaseConnection
{

    // GET ONE 
    public function get_product_by_id($id){
            $query  = "SELECT * FROM `products` WHERE id = ?";
            $stmt = mysqli_prepare($this->conn, $query);
            $stmt->bind_param("i", $id); 
            $stmt->execute();
            $result = $stmt->get_result();
            $db_product = mysqli_fetch_assoc($result);
            
            $product = new Product($db_product["title"], $db_product["description"], $db_product["price"], $db_product["id"]);

            return $product;
    }

    
    // GET ALL 
    public function get_all(){
        $query = "SELECT * from products";
        $result = mysqli_query($this->conn, $query);
        $db_products = mysqli_fetch_all($result, MYSQLI_ASSOC); // tar in data från db och gör array

        $products = []; // skapar en tom array

        foreach($db_products as $db_product){ 
            $db_id = $db_product["id"];
            $db_title = $db_product["title"];
            $db_description = $db_product["description"];
            $db_price = $db_product["price"];

            $products[] = new Product($db_title, $db_description, $db_price, $db_id); 
        }
        
        return $products;
    }

    // CREATE

    // UPDATE

    // DELETE
}
