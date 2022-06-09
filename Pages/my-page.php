<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../Classes/DatabaseUsers.php";
require_once __DIR__ . "/../Classes/DatabaseOrders.php";
require_once __DIR__ . "/../google-config.php";

$isLoggedIn = (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]);
$isAdmin = (isset($_SESSION["user"]->role) && $_SESSION["user"]->role == "admin");

$db = new DatabaseOrders(); 

if(!$isLoggedIn){
    http_response_code(401);
    die("Access denied");
}

$user = $_SESSION["user"];
$orders = $db->get_order_by_user_id($user->id);

Template::header("My page");
?>

<h2>Hello <?= $_SESSION['user']->username ?>!</h2>

<nav>
    <a href="/sms/scripts/logging-out.php" class="nav-link">Logout</a>
    <a href="/sms/pages/contact.php" class="nav-link">Contact</a>
</nav>

<hr>

<div class="mypage-orders-container">
    <h2>Your orders</h2>
    <table class="users-orders-table">
        <thead>
            <tr>
                <th class="orders-table-head">Order no.</th>
                <th class="orders-table-head">Order date</th>
                <th class="orders-table-head">Order status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?= $order["id"] ?></td>
                    <td><?= $order["date"] ?></td>
                    <td><?= $order["status"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php

Template::footer();

?>