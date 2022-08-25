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

            $product = new Product($db_product["title"], $db_product["description"], $db_product["price"], $db_product["img-url"], $db_product["id"]);

            return $product;
    }
    
    // GET ALL 
    public function get_all(){
        $query = "SELECT * FROM products";
        $result = mysqli_query($this->conn, $query);
        $db_products = mysqli_fetch_all($result, MYSQLI_ASSOC); // tar in data från db och gör array

        $products = []; // skapar en tom array

        foreach($db_products as $db_product){ 
            $db_id = $db_product["id"];
            $db_title = $db_product["title"];
            $db_description = $db_product["description"];
            $db_price = $db_product["price"];
            $db_img_url = $db_product["img-url"];
          
            $products[] = new Product($db_title, $db_description, $db_price, $db_img_url, $db_id);
    
        }
        
        return $products;
    }

    // CREATE
    public function create_product(Product $product)
    {
        $query = "INSERT INTO products (title, `description`, price, `img-url`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $title = $product->title;
        $description = $product->description;
        $price = $product->price;
        $img_url = $product->img_url;
        $stmt->bind_param("ssis", $title, $description, $price, $img_url); 
        $success = $stmt->execute(); 

        return $success;
    }

/*     // UPDATE
    public function update_product(Product $product){
        $query  = "UPDATE products SET title = ?, description = ?, price = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("ssii", $product->title, $product->description, $product->price, $product->id); 
        return $stmt->execute();
    } */

    public function update_product(Product $product, $id){
        $query  = "UPDATE products SET title = ?, `description` = ?, price = ?, `img-url`=? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("ssisi", $product->title, $product->description, $product->price, $product->img_url, $id); 
        
        return $stmt->execute();
    }

    // DELETE
    public function delete_product($id){
        $query  = "DELETE FROM products WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id); 
        return $stmt->execute();
    }
}
