<?php
require_once __DIR__ . "/../classes/DatabaseProducts.php";
require_once __DIR__ . "/../classes/DatabaseUsers.php";
require_once __DIR__ . "/../classes/DatabaseOrders.php";

require_once __DIR__ . "/../classes/Template.php";

$users_db = new DatabaseUsers();
// $user_role = $_SESSION['user']->user_role;
$users = $users_db->get_all();

//var_dump($_SESSION);



$products_db = new DatabaseProducts();
$products = $products_db->get_all();


$order_db = new DatabaseOrders();
$orders = $order_db->get_all();
$statuses = $order_db->statuses();



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
<!--
<nav class="admin-nav">
    <a href="#admin-user-container">USERS</a>
    <a href="#admin-product-container">PRODUCTS</a>
    <a href="#admin-order-container">ORDERS</a>
</nav>

<h1>ADMIN</h1>
 -->

<button class="accordion">Manage users:
    <p class="underrubrik"> Click to edit users </p>
</button>
<div class="panel">
    <div id="admin-user-container">
        <!-- <h2>FOR USERS</h2> -->
        <?php foreach ($users as $user) : /*var_dump($user)*/ ?>

            <form action="/sms/scripts/update-user.php" method="post">
                <input type="text" class="user-info" required name="username" placeholder="Username" value="<?= $user->username ?>">
                <input type="text" class="user-info" required name="role" placeholder="Role" value="<?= $user->role ?>">
                <input type="hidden" name="id" value="<?= $user->id; ?>">

                <input type="submit" class="btn btn-edit" value="Update User">
                <input type="submit" class="btn btn-delete" formaction="/sms/scripts/delete-user.php" value="Delete User">
            </form>

        <?php endforeach; ?>
    </div>
</div>

<button class="accordion">Manage products:
    <p class="underrubrik"> Click to add a new product or edit the products </p>
</button>
<div class="panel">
    <div id="admin-product-container">
        <!-- <h2>FOR RODUCTS</h2> -->
        <!-- <div class="product-form-container">
            <form action="/sms/scripts/post-product.php" method="post" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Name">
                <input type="number" name="price" placeholder="Price">
                <textarea type="text" name="description" rows="5" cols="100" placeholder="Description"></textarea>
                <input type="file" name="image" accept="image/*"><br>
                <input type="submit" value="Save">
            </form>
        </div> -->

        <table class="products-table">
            <thead>
                <tr>
                    <th class="products-table-head">Name</th>
                    <th class="products-table-head">Description</th>
                    <th class="products-table-head">Price</th>
                    <th class="products-table-head">Img</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <form action="/sms/scripts/post-edit-product.php" method="post" enctype="multipart/form-data">
                            <td>
                                <input type="text" name="title" placeholder="Tilte" value="<?= $product->title ?>"><br>
                            </td>
                            <td>
                                <textarea name="description" placeholder="Description"><?= $product->description ?></textarea>
                            </td>
                            <td>
                                <input type="number" name="price" placeholder="Price" value="<?= $product->price ?>">
                            </td>
                            <td>
                                <input type="file" name="image" accept="image/*">
                            </td>
                            <input type="hidden" name="id" value="<?= $product->id; ?>">
                            <td>
                                <input type="submit" value="Save">
                            </td>

                        </form>

                        <td>
                            <form action="/sms/scripts/delete-product.php" method="post">
                                <input type="hidden" name="id" value="<?= $product->id ?>">
                                <input class="btn-add" type="submit" value="Delete">
                            </form>
                        </td>


                    </tr>


                    <!-- 
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
                </tr> -->
                <?php endforeach; ?>
            </tbody>

        </table>

        <div class="product-form-container">
            <form action="/sms/scripts/post-product.php" method="post" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Name">
                <input type="number" name="price" placeholder="Price">
                <textarea type="text" name="description" rows="5" cols="100" placeholder="Description"></textarea>
                <input type="file" name="image" accept="image/*"><br>
                <input type="submit" value="Save">
            </form>
        </div>


    </div>

</div>

<button class="accordion">Manage orders:
    <p class="underrubrik">Click to update orders</p>
</button>
<div class="panel">
    <!-- <hr> -->
    <div id="admin-order-container">
        <div class="admin-order-wrapper">
            <fieldset class="order-fieldset">
                <legend class="order-legend">Orders</legend>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th class="order-table-head">Order #</th>
                            <th class="order-table-head">Customer</th>
                            <th class="order-table-head">Date</th>
                            <th class="order-table-head">Status</th>
                            <!-- <th class="order-table-head">Update</th> -->
                            <th class="order-table-head">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) : /*var_dump($order)*/ ?>
                            <tr>
                                <td>
                                    <p>
                                        <?= $order->id ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?= $order->user_id ?>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <?= $order->date ?>
                                    </p>
                                </td>
                                <td>
                                    <form action="/sms/scripts/post-edit-order.php" method="post">
                                        <select name="order-status">
                                            <option value=""><?= $order->status ?></option>
                                            <?php foreach ($statuses as $status) : ?>
                                                <option name="order-status" value="<?= $status->status; ?>"><?= $status; ?></option>
                                            <?php endforeach; ?>
                                            <input type="hidden" name="order-id" value="<?= $order->id ?>">
                                        </select>

                                        <input type="submit" value="Update">
                                    </form>
                                </td>
                                <!-- <td>
                                    <p></p>
                                </td> -->
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


                <-- BACKUP TABLE DATA -->
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
                <?php foreach ($orders as $order) : ?>
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

</div>


<?php
Template::footer();
?>