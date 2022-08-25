<?php

require_once __DIR__ . "/../Classes/DatabaseOrders.php";
require_once __DIR__ . "/../Classes/User.php";
require_once __DIR__ . "/../Classes/Order.php";

$order_db = new DatabaseOrders();
$orders = $order_db->get_all();

$success = false;

if(isset($_POST["order-status"]) && isset($_POST["order-id"])){
    $db = new DatabaseOrders();

    $order = new Order(
        $_POST["order-id"], 
        $_POST["order-status"]);

    $id = $_POST["order-id"];

    $success = $db->update($order, $order_status, $id);   
    
} else{
    echo "Invalid input.";
    die();
}

if($success){
    header("Location: /sms/pages/admin.php");
} else{
    echo "Error updating order.";
}

