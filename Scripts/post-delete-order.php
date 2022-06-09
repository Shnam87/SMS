<?php 

require_once __DIR__ . "/../classes/DatabaseOrders.php";

$success = false;

if(isset($_POST["order-id"])){
    $order_db = new DatabaseOrders();

    $order_id = $_POST["order-id"];
    var_dump($order_id);

    $success = $order_db->delete($order_id);
} else{
    echo "Invalid input.";
}

if($success){
    header("Location: /sms/pages/admin.php"); 
} else {
    echo "Error deleting order.";
}