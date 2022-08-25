<?php 
require_once __DIR__ . "/../classes/DatabaseOrders.php";

$success = false;

if(isset($_POST["product-id"]) && isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    $current_date = date("Y-m-d H:i:s");

    $order_db = new DatabaseOrders(); 

    $order = new Order($user->id, $_POST["product-id"], $current_date); 

    $success = $order_db->save($order);
    
} else{
    echo "Invalid input.";
}

if($success){
    header ("Location: /sms/pages/create-order.php");
} else {
    echo "Error saving order to database.";
}






