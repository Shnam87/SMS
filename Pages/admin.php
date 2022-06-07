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

<nav class="admin-nav">
    <a href="#admin-user-container">USERS</a>
    <a href="#admin-product-container">PRODUCTS</a>
    <a href="#admin-order-container">ORDERS</a>
</nav>

<h1>ADMIN</h1>

<div id="admin-user-container">
    <h2>FOR USERS</h2>
    <p>CREATE USERS</p>
    <p>tabell - visa alla users (med alla kolumner från db)</p>
    <p>CRUD </p>
</div>


<div id="admin-product-container">
   <h2>FOR PRODUCTS</h2>
   <p>tabell - visa alla produkter (db)</p>
</div>

<div id="admin-order-container">
    <h2>FOR ORDERS</h2>
    <p>tabell - visa alla orders (db)</p>
</div>







<?php
Template::footer();
?>
