<?php
require_once __DIR__ . "/../Classes/Template.php";
require_once __DIR__ . "/../Classes/DatabaseUsers.php";
require_once __DIR__ . "/../Classes/DatabaseOrders.php";
require_once __DIR__ . "/../Classes/DatabaseSupport.php";
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

Template::header("My account");
?>

<main>
    <div class="mypage-orders-container">
        <fieldset class="order-fieldset">
            <legend class="order-legend">Orders History</legend>
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
        </fieldset>
    </div>
    <br>
    <hr>
    <?php if ($isLoggedIn && !$isAdmin) : ?>
        <a href="/sms/pages/contact.php"> <button class="btn btn-contact"> Contact Support </button> </a>
    <?php endif; ?>
    <form method="GET" action="/sms/pages/edit-account.php">
        <input type="hidden" name="id" value="<?= $user->id ?>">
        <input type="submit" class="btn btn-edit-me" value="Edit my info">
    </form>

    <button class="btn btn-delete-modal" id="openModal">Delete my account</button>
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h1 class="delete-me-tag">Are you sure?</h1>
            <h4 class="delete-me-tag">Clicking the button below will <u> instantaneously</u> and <u> permanently</u> delete your account.</h4>
            <form method="POST" action="/sms/scripts/delete-me.php">
                <input type="hidden" name="id" value="<?= $user->id ?>">
                <input type="submit" class="btn btn-delete-me" value="Yes, delete my account">
            </form>
        </div>
    </div>
    <hr>
    <?php if ($isLoggedIn && $isAdmin) : ?>
        <?php
        $users_db = new DatabaseUsers();
        $users = $users_db->get_all_regular_users();
        ?>
        <br>
        <div>
            <h1>Contact with users</h1>
        </div>
        <form action="/sms/pages/user-contact.php" method="post">
            <select class="user-option" required name="user-id">
                <option class="user-option" value=""> Choose a user : </option>
                <?php foreach ($users as $user) : ?>
                    <option class="user-option" value="<?= $user->id ?>"><?= $user->id . " - " . $user->username ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" class="btn btn-contact" value="View & reply to this user">
        </form>
        <br>
        <button class="accordion">Click to view all users contact history.</button>
        <div class="panel">
            <?php
            $users_db = new DatabaseUsers();
            $messages_db = new DatabaseSupport();
            $users = $users_db->get_all_regular_users();
            ?>
            <br>
            <div>
                <?php foreach ($users as $user) : ?>
                    <h3 class="contact-history">Contact history with <?= $user->username ?>: </h3>
                    <?php $messages = $messages_db->get_all_by_user_id($user->id); ?>
                    <div class="contact-container">
                        <?php foreach ($messages as $message) : ?>
                            <div class="chat-container <?= $message["sent_by"] ?>">
                                <div class="chat-msg <?= $message["sent_by"] ?>">
                                    <h3><?= $message["message"] ?></h3>
                                    <h6 class="chat-msg <?= $message["sent_by"] ?>"><?= $message["date"] ?></h6>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php
Template::footer();
?>