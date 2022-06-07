<?php
require_once __DIR__ . "/../classes/DatabaseProducts.php";
require_once __DIR__ . "/../classes/DatabaseUsers.php";
require_once __DIR__ . "/../classes/DatabaseOrders.php";

require_once __DIR__ . "/../classes/Template.php";


require_once __DIR__ . "/../classes/Product.php";

$products_db = new DatabaseProducts();
$products = $products_db->get_all();

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
    <h2>FOR RODUCTS</h2>



    <form action="/sms/scripts/post-product.php" method="post">
        <input type="text" name="title" placeholder="Name">
        <textarea type="text" name="description" rows="5" cols="100" placeholder="Description"></textarea>
        <input type="number" name="price" placeholder="Price">
        <input type="submit" value="Save">
    </form>

    <table class="products-table">
        <thead>
            <tr>
                <th></th>
                <th class="products-table-head">Name</th> 
                <th class="products-table-head">Description</th>
                <th class="products-table-head">Price</th> 
            </tr>
        </thead>
        <tbody>
        <?php foreach($products as $product): ?>
            <tr>
                <td>
                    <p>IMAGE</p>
                </td>
                <td>
                    <a class="products-title-link" href="/sms/pages/product.php?id=<?= $product->id ?>">
                        <?= $product->title ?>
                    </a>
                </td> 
                <td>
                    <p><?= $product->description ?></p>
                </td>
                <td>
                    <p><?= $product->price ?></p>
                </td>
                <td>
                <form action="/sms/scripts/delete-product.php" method="post">
                    <input type="hidden" name="id" value="<?= $product->id ?>">
                    <input class="btn-add" type="submit" value="Delete">
                </form>

       

                <form action="/sms/pages/update-product.php?id=<?= $product->id; ?>" method="post">
                    <input type="hidden" name="id" value="<?= $product->id ?>">
                    <input class="btn-add" type="submit" value="Update">
                </form>


                

                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>

<div id="admin-order-container">
    <h2>FOR ORDERS</h2>
    <p>tabell - visa alla orders (db)</p>
</div>







<?php
Template::footer();
?>
