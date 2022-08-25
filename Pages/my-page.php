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

<main>

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

    <div class="mypage-orders-container">
        <h2>Your orders</h2>
        <table class="users-orders-table">
            <thead>
                <tr>
                    <th class="orders-table-head">Order Number</th>
                    <th class="orders-table-head">Ordered On</th>
                    <th class="orders-table-head">Status</th>
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
</main>

<?php

Template::footer();

?>