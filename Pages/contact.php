<?php
require_once __DIR__ . "/../Classes/Template.php";
require_once __DIR__ . "/../Classes/DatabaseSupport.php";
require_once __DIR__ . "/../Classes/DatabaseUsers.php";
require_once __DIR__ . "/../google-config.php";

$user_id = $_SESSION["user"]->id;
$user_role = $_SESSION["user"]->role;

$messages_db = new DatabaseSupport;
$messages = $messages_db->get_all_by_user_id($user_id);


/*
var_dump($_SESSION["user"]);
var_dump($user_id);
var_dump($user_role);
*/
$isLoggedIn = (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]);

if (!$isLoggedIn) {
    header("Location: /sms");
    die();
}

Template::header("Contact");
?>

<?php 
var_dump($user_id);
var_dump($user_role);
?>

<hr>
<h2>Send us a message: </h2>

<div class="contact-container">
    <form action="/sms/scripts/post-contact.php" method="post" class="contact-form">
        <textarea class="contact-text" placeholder="Type your message..." name="contact-msg" required></textarea>
        <button type="submit" class="contact-btn">Send Message</button>
    </form>

    <?php foreach ($messages as $message) : ?>
        <div class="chat-container <?= $message["sent_by"] ?>">
            <h3 class="chat-msg <?= $message["sent_by"] ?>"><?= $message["message"] ?></h3>
        </div>
    <?php endforeach ?>

</div>

<?php
Template::footer();
?>