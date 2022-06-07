<?php
require_once __DIR__ . "/../classes/DatabaseProducts.php";
require_once __DIR__ . "/../classes/DatabaseUsers.php";
require_once __DIR__ . "/../classes/DatabaseOrders.php";

require_once __DIR__ . "/../classes/Template.php";

// $products_db = new DatabaseProducts();
// $products = $products_db->get_all();

// $users_db = new DatabaseUsers();
// $users = $users_db->get_all();

// $order_db = new DatabaseOrders();
// $orders = $orders_db->get_all();

Template::header("SMS");
?>

<h1>ADMIN</h1>






<?php
Template::footer();
?>
