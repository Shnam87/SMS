<?php
require_once __DIR__ . "/../classes/DatabaseUsers.php";
require_once __DIR__ . "/../classes/Template.php";

$users_db = new DatabaseUsers();

Template::header("Edit account");
?>

<?php
$isLoggedIn = (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]);
$user = $_SESSION["user"];
$userId = (int)$_GET["id"];

if (!$isLoggedIn || $user->id != $userId) {
    header("Location: /sms");
    die();
}

?>
<div class="edit-account">
    <h2><ins>NOTE</ins>:<i> upon changing your username or password, you will also be logged out and will need to log in again </i></h2>
    <hr>
</div>

<main class="edit-account-main">
    <section>
        <form action="/sms/scripts/update-username.php" method="post">
            <input type="text" id="username" class="user-info" required name="username" placeholder="Username" value="<?= $user->username ?>"> <br>
            <input type="hidden" name="id" value="<?= $user->id; ?>">
            <input type="submit" class="btn btn-update-me" value="Change username">
        </form>
    </section>

    <hr>

    <section>
        <form action="/sms/Scripts/change-password.php" method="post">
            <input type="password" id="password" class="user-info" required name="old-password" placeholder="Old password"> <br>
            <input type="password" id="password" class="user-info" required name="new-password" placeholder="New password"> <br>
            <input type="password" id="password" class="user-info" required name="confirm-password" placeholder="Confirm password"> <br>
            <input type="hidden" name="id" value="<?= $user->id; ?>">
            <input type="submit" class="btn btn-update-me" value="Change password">
        </form>
    </section>
</main>

<?php
Template::footer();
?>