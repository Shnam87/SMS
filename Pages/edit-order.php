<?php

require_once __DIR__ ."/../classes/DatabaseOrders.php";
require_once __DIR__ ."/../classes/Template.php";


$order_id = $_GET["id"];
$orders_db = new DatabaseOrders();
$order = $orders_db->get_by_id($order_id);

var_dump($order);

Template::header("SMS");
?>


<form action="/sms/scripts/post-edit-order.php" method="post">
    <input type="hidden" name="id" value="<?= $order->id ?>">
    <input type="hidden" name="user-id" value="<?= $order->user_id ?>">
    <label for="">Date:</label>
    <input type="text" name="date" placeholder="Date" value="<?= $order->date ?>">
    <label for="">Status:</label>
    <input type="text" name="status" placeholder="Status" value="<?= $order->status ?>">
    <input type="submit" value="Save">
</form>

<?php  

Template::footer();