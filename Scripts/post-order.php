<?php 

require_once __DIR__ . "/../classes/DatabaseOrders.php";
require_once __DIR__ . "/../Classes/User.php";
require_once __DIR__ . "/../Classes/Product.php";

session_start();


$is_logged_in = isset($_SESSION["user"]);
$user = $is_logged_in ? $_SESSION["user"] : null;

$cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];


if( $is_logged_in && count($cart) > 0){
    $order = new Order($user->id);

    $orders_db = new DatabaseOrders(); 

    $order_id = $orders_db->save($order);

    if($order_id == false){
        die("Error creating order.");
    }

    $success = true;

    foreach($cart as $product){
        $success = $success && $orders_db->create_product_order($order_id, $product->id);
    }
    
    if($success){
        unset($_SESSION["cart"]);
        header("Location: /sms/pages/my-page.php");
        die();
    } 
    else {
        die("Error saving order.");  
    }   
    
} else{
    header("Location: /sms/pages/login.php");
}






