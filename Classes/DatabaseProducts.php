<?php

require_once __DIR__ ."/DatabaseConnection.php";
require_once __DIR__ ."/Product.php";

class DatabaseProducts extends DatabaseConnection{

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
}

?>