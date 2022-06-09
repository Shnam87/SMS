<?php
require_once __DIR__ . "/../classes/DatabaseProducts.php";
require_once __DIR__ . "/../classes/DatabaseUsers.php";
require_once __DIR__ . "/../classes/DatabaseOrders.php";

require_once __DIR__ . "/../classes/Template.php";

// session_start();

$users_db = new DatabaseUsers();
// $user_role = $_SESSION['user']->user_role;
$users = $users_db->get_all();

//var_dump($_SESSION);


require_once __DIR__ . "/../classes/Product.php";

$products_db = new DatabaseProducts();
$products = $products_db->get_all();

// $order_db = new DatabaseOrders();
// $orders = $orders_db->get_all();

Template::header("SMS");
?>

<?php

// var_dump($_SESSION["user"]->role);
$isLoggedIn = (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]);
$isAdmin = (isset($_SESSION["user"]->role) && $_SESSION["user"]->role == "admin");

if (!$isLoggedIn || !$isAdmin) {
    header("Location: /sms");
    die();
}
?>

<nav class="admin-nav">
    <a href="#admin-user-container">USERS</a>
    <a href="#admin-product-container">PRODUCTS</a>
    <a href="#admin-order-container">ORDERS</a>
</nav>

<h1>ADMIN</h1>

<div id="admin-user-container">
    <h2>FOR USERS</h2>
    <?php foreach ($users as $user) : /*var_dump($user)*/ ?>

        <form action="/sms/scripts/update-user.php" method="post">
            <input type="text" class="user-info" required name="username" placeholder="Username" value="<?= $user->username ?>">
            <input type="text" class="user-info" required name="role" placeholder="Role" value="<?= $user->role ?>">
            <input type="hidden" name="id" value="<?= $user->id; ?>">
            <input type="submit" class="btn btn-edit" value="Update User">
        </form>

        <form method="POST" action="/sms/scripts/delete-user.php">
            <input type="hidden" name="id" value="<?= $user->id ?>">
            <input type="submit" class="btn btn-delete" value="Delete User">
        </form>
    <?php endforeach; ?>
</div>


<div id="admin-product-container">
    <!-- 
    <h2>FOR PRODUCTS</h2>
    <form action="" class="add-product">
        <p class="admin-header">Please enter the details and an image of the product:</p>
        <div>
            <input type="text" required class="adminForm-input" name="" id="objName" placeholder="Product Name">
        </div>
        <div>
            <input type="file" required accept="image/*" class="adminForm-input" name="" id="objImg">
        </div>
        <div>
            <input type="number" required min="1" class="adminForm-input" name="" id="objPrice" placeholder="Price of the product">
        </div>
        <div>
            <textarea name="" required class="adminForm-textarea" id="objDescription" cols="35" rows="4" placeholder="Product description"></textarea>
        </div>
        <input type="submit" class="btn btn-delete" value="Add product">
    </form>
 -->

    <h2>FOR RODUCTS</h2>
    <div class="product-form-container">
        <form action="/sms/scripts/post-product.php" method="post">
            <input type="text" name="title" placeholder="Name">
            <input type="number" name="price" placeholder="Price">
            <textarea type="text" name="description" rows="5" cols="100" placeholder="Description"></textarea>
            <input type="submit" value="Save">
        </form>
    </div>

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
            <?php foreach ($products as $product) : ?>
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