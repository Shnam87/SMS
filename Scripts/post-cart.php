<?php 
require_once __DIR__ . "/../classes/DatabaseOrders.php";
// require_once __DIR__ . "/../Classes/User.php";

// session_start();

$success = false;

if(isset($_POST["product-id"]) && isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    $current_date = date("Y-m-d H:i:s");

    $order_db = new DatabaseOrders(); 

    $order = new Order($user->id, $_POST["product-id"], $current_date); //$user->id

    $success = $order_db->save($order);
    
} else{
    echo "Invalid input.";
}

if($success){
    header ("Location: /sms/pages/create-order.php");
} else {
    echo "Error saving order to db.";
    var_dump($order);
}

// if(isset($_POST["create-order"]) && isset($_SESSION["user"])){
//     $user_id = $_SESSION["user"]->id; 
//     var_dump($_SESSION["user"]);

//     $create_order = $_POST["create-order"];
//     $current_date = date("Y-m-d H:i:s");

//     $order_db = new DatabaseOrders(); 

//     $order = new Order($create_order, $current_date, $user_id);

//     $success = $db->save_task($task);
   
// } else{
//     echo "Invalid input.";
// }

// if($success){
//     header ("Location: /sms/pages/create-order.php");
// } else {
//     echo "Error saving order to db.";
// }





