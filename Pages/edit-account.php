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
    <h2><ins>NOTE</ins>:<i> Upon changing your username or password, you will also be logged out and will need to log in again if you so please.</i></h2>
    <hr>
</div>

<main>
        <nav class="product-nav">   
            <a class="product-nav-a" href="/sms/pages/my-page.php">My Account</a>
            <p class="product-nav-p">/ Chat </p>
        </nav>
    <div class="edit-account-main">
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
    </div>
</main>

<?php
Template::footer();
?>