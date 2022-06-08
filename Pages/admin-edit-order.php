<?php 
// require_once __DIR__ . "/../classes/DatabaseConnection.php";
require_once __DIR__ . "/../Classes/DatabaseOrders.php";
require_once __DIR__ . "/../classes/Template.php";

// session_start();

// $is_logged_in = (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]); // true om inloggad, false om ej
// $user = $_SESSION["user"];

// if(!$is_logged_in || $order->user_id != $user->id){
//     header("Location: /sms");   
// }

$order_id = $_GET["id"];

$order_db = new DatabaseOrders();
$orders = $order_db->get_by_id($order_id);

var_dump($orders);
Template::header("SMS");
?>

 <div class="edit-order-container"> 
    <div class="edit-order-box">
        <h2>Edit order: <?= $order->id ?></h2><br>
        <form action="/sms/scripts/post-edit-order.php" method="post">
            <input class="input-field" autofocus type="text" name="order-date" placeholder="Date" value="<?= $order->date ?>"><br>
            <input class="input-field" type="text" name="order-status" placeholder="Status" value="<?= $order->status ?>"><br>
            <input type="hidden" name="user-id" value="<?= $order->user_id ?>">
            <input type="hidden" name="order-id" value="<?= $order->id ?>"><br>
            <input class="input-submit" type="submit" value="Save">
        </form><br>
    </div>
</div>   

<?php
Template::footer();
?>