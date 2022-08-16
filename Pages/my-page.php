<?php
require_once __DIR__ . "/../Classes/Template.php";
require_once __DIR__ . "/../Classes/DatabaseUsers.php";
require_once __DIR__ . "/../Classes/DatabaseOrders.php";
require_once __DIR__ . "/../google-config.php";

$isLoggedIn = (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]);
$isAdmin = (isset($_SESSION["user"]->role) && $_SESSION["user"]->role == "admin");

$db = new DatabaseOrders();

if (!$isLoggedIn) {
    http_response_code(401);
    header("Location: /sms");
    die();
}

$user = $_SESSION["user"];
$orders = $db->get_order_by_user_id($user->id);

Template::header("My page");
?>

<!-- <h3>Hello <?= $_SESSION['user']->username ?>!</h3> -->

<?php if ($isLoggedIn && !$isAdmin) : ?>
    <a href="/sms/pages/contact.php"> <button class="btn btn-contact"> Contact Support </button> </a>
<?php endif; ?>

<form method="GET" action="/sms/pages/edit-account.php">
    <input type="hidden" name="id" value="<?= $user->id ?>">
    <input type="submit" class="btn btn-edit-me" value="Edit my info">
</form>

<form method="POST" action="/sms/scripts/delete-me.php">
    <input type="hidden" name="id" value="<?= $user->id ?>">
    <input type="submit" class="btn btn-delete-me" value="Delete my account">
</form>
<hr>

<?php // var_dump($_SESSION); 
?>
<!-- <hr> -->

<?php if ($isLoggedIn && $isAdmin) : ?>
    <?php
    $users_db = new DatabaseUsers();
    $users = $users_db->get_all_regular_users();
    ?>

    <br>
    <form action="/sms/pages/user-contact.php" method="post">
        <select class="user-option" name="user-id">
            <option class="user-option" selected> Choose a user: </option>
            <?php foreach ($users as $user) : ?>
                <option class="user-option" value="<?= $user->id ?>"><?= $user->id . " - " . $user->username ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" class="btn btn-contact" value="Show this user contact">
    </form>
    <a href="/sms/pages/all-contact.php"> <button class="btn btn-all-contact"> Show all users Contact </button> </a>
    <br>
    <hr>
<?php endif; ?>

<?php
/*
if (isset($_POST["user-id"])) {
    var_dump((int)$_POST["user-id"]);
}
*/
?>

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