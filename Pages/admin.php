<?php
require_once __DIR__ . "/../classes/DatabaseProducts.php";
require_once __DIR__ . "/../classes/DatabaseUsers.php";
require_once __DIR__ . "/../classes/DatabaseOrders.php";

require_once __DIR__ . "/../classes/Template.php";

// session_start();

// $user = $_SESSION["user"];

// $is_logged_in = (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]);

// if(!$is_logged_in){
//     header("Location: /todo");
// }

// $products_db = new DatabaseProducts();
// $products = $products_db->get_all();

// $users_db = new DatabaseUsers();
// $users = $users_db->get_all();


$order_db = new DatabaseOrders();
$orders = $order_db->get_all();


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
    <div class="admin-order-wrapper">
        <fieldset class="order-fieldset">
            <legend class="order-legend">Orders</legend>
            <table class="order-table">
                <thead>
                    <tr>
                        <th class="order-table-head">Order #</th>
                        <th class="order-table-head">Date</th>
                        <th class="order-table-head">User ID</th> 
                        <th class="order-table-head">Status</th>
                        <th class="order-table-head">Update</th> 
                        <th class="order-table-head">Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td>
                            <p>
                                <?= $order->id ?>
                            </p>
                        </td> 
                        <td>
                            <p><?= $order->date ?></p>
                            <!-- <form action="/sms/scripts/post-edit-order.php" method="post">
                                <input type="text" name="order-id" value="<?= $order->date ?>">
                            </form> -->
                        </td>
                        <td>
                            <p><?= $order->user_id ?></p>
                        </td>
                        <td>
                            <p><?= $order->status ?></p>
                            <!-- <form action="/sms/scripts/post-edit-order.php" method="post">
                                <input type="text" name="order-status" value="<?= $order->status ?>">
                            </form> -->
                        </td>
                        <td>
                            <a class="admin-order-edit-link" href="/sms/pages/admin-edit-order.php?id=<?= $order->id ?>">Edit</a>
                        </td>
                        <td>
                            <form action="/sms/scripts/post-delete-order.php" method="post">
                                <input type="hidden" name="order-id" value="<?= $order->id ?>">
                                <input class="order-btn btn-delete" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


  

            <!-- <table class="order-table">
                <thead>
                    <tr>
                        <th class="order-table-head">Order #</th>
                        <th class="order-table-head">Date</th>
                        <th class="order-table-head">User ID</th> 
                        <th class="order-table-head">Status</th>
                        <th class="order-table-head">Update</th> 
                        <th class="order-table-head">Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td>
                            <p>
                                <?= $order->id ?>
                            </p>
                        </td> 
                        <td>
                            <p><?= $order->date ?></p>
                        </td>
                        <td>
                            <p><?= $order->user_id ?></p>
                        </td>
                        <td>
                            <p><?= $order->status ?></p>
                        </td>
                        <td>
                            <a class="admin-order-edit-link" href="/sms/pages/admin-edit-order.php?id=<?= $order->id ?>">Edit</a>
                        </td>
                        <td>
                            <form action="/sms/scripts/post-delete-order.php" method="post">
                                <input type="hidden" name="id" value="<?= $order->id ?>">
                                <input class="order-btn btn-delete" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table> -->
        </fieldset>
    </div> 
</div>

<?php
Template::footer();
?>
