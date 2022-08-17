<?php

// INCOMPLETE! 

require_once __DIR__ . "/../Classes/DatabaseOrders.php";

$order_db = new DatabaseOrders();
$orders = $order_db->get_all();


$success = false;

if(isset($_POST["order-status"]) && isset($_POST["order-id"])){
    $db = new DatabaseOrders();

    $order = new Order($_POST["order-id"], $_POST["order-date"], $_POST["order-status"]);

    $id = $_POST["order-id"];
    $success = $db->update($order, $order_status, $id);   
    
} else{
    echo "Invalid input.";
}

if($success){
    header("Location: /sms/pages/admin.php");
} else{
    echo "Error updating order.";
}


// $success = false;

// if(isset($_POST["order-date"]) && isset($_POST["order-status"]) && isset($_POST["user-id"]) && isset($_POST["order-id"])){
//     $db = new DatabaseOrders();

//     $order = new Order($_POST["order-date"], $_POST["order-status"], $_POST["user-id"], $_POST["order-id"]);

//     $id = $_POST["order-id"];
//     $success = $db->update($order, $id);   
    
// } else{
//     echo "Invalid input.";
// }

// if($success){
//     header("Location: /sms/pages/admin.php?id=" . $_POST["order-id"]);
// } else{
//     echo "Error updating order.";
// }