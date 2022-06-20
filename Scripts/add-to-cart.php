<?php

require_once __DIR__ ."/../classes/Product.php";
require_once __DIR__ ."/../classes/DatabaseProducts.php";

session_start();

if(isset($_POST["product-id"])){
    $products_db = new DatabaseProducts();
    $product = $products_db->get_product_by_id($_POST["product-id"]);

    if(!isset($_SESSION["cart"])){
        $_SESSION["cart"] = [];
    }

    if($product){

    $_SESSION["cart"] [] = $product;

    header("Location: /sms/pages/cart.php");

    }

}else{
    die("Invalid input");
}

die("Error adding produict");
 
















      






