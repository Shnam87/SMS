<?php
require_once __DIR__ . "/../Classes/DatabaseOrders.php";

$order_id = $_GET["order-id"];

$db = new DatabaseOrders();
$order = $db->get_by_id($order_id);

var_dump($order);

?>
