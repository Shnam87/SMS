<?php
require_once __DIR__ . "/DatabaseConnection.php";
require_once __DIR__ . "/Product.php";

class DatabaseProducts extends DatabaseConnection
{

    // GET ONE 

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

