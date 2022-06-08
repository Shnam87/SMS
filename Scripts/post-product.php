<?php

require_once __DIR__ ."/../classes/DatabaseProducts.php";
require_once __DIR__ ."/../classes/Product.php";

$success = false;

if (isset($_POST["title"]) && isset ($_POST["description"]) && isset ($_POST["price"])){
    $db = new DatabaseProducts();
    $product = new Product($_POST["title"], $_POST["description"], $_POST["price"]);
    $success = $db->create_product($product);
}

else{
    echo "Invalid input";
}
    
   
if($success){
    header("Location: /sms/pages/admin.php");
}else{
    echo "Error saving product to database";
}