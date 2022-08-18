<?php 

require_once __DIR__ . "/../classes/DatabaseOrders.php";
require_once __DIR__ . "/../Classes/User.php";
require_once __DIR__ . "/../Classes/Product.php";

session_start();


$is_logged_in = isset($_SESSION["user"]);
$user = $is_logged_in ? $_SESSION["user"] : null;

$cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];


if( $is_logged_in && count($cart) > 0){
   
    // $date = date("Y-m-d H:i:s");

    // $order = new Order($user->id, 'approved', $date);

    // $status = "approved";
    
    $order = new Order($user->id);




    $orders_db = new DatabaseOrders(); 

    $order_id = $orders_db->save($order);

    if($order_id == false){
        die("Error creating order");
    }

    $success = true;
    var_dump($_SESSION);
    var_dump($order);
    var_dump($cart);

    foreach($cart as $product){
        var_dump("hej");
        $success = $success && $orders_db->create_product_order($order_id, $product->id);
    }
    
    if($success){
        unset($_SESSION["cart"]);
        header("Location: /sms/pages/my-page.php");
        die();
    } 
    else {
        die("Error saving order");  
    }   
    
} else{
    echo "Invalid input.";
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





