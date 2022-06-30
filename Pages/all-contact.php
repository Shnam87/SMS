<?php
require_once __DIR__ . "/../Classes/Template.php";
require_once __DIR__ . "/../Classes/DatabaseSupport.php";
require_once __DIR__ . "/../Classes/DatabaseUsers.php";
require_once __DIR__ . "/../google-config.php";

$isLoggedIn = (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]);
$isAdmin = (isset($_SESSION["user"]->role) && $_SESSION["user"]->role == "admin");

if (!$isLoggedIn || !$isAdmin) {
    header("Location: /sms");
    die();
}

$users_db = new DatabaseUsers();
$messages_db = new DatabaseSupport();

$users = $users_db->get_all_regular_users();

Template::header("All user Contact");
?>

<main>
    <h2>Here is all user contact history: </h2>
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
</main>

<?php
Template::footer();
?>