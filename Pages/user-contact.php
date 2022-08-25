<?php
require_once __DIR__ . "/../Classes/Template.php";
require_once __DIR__ . "/../Classes/DatabaseSupport.php";
require_once __DIR__ . "/../Classes/DatabaseUsers.php";
require_once __DIR__ . "/../google-config.php";

$isLoggedIn = (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]);
$user_id = isset($_POST["user-id"]) ? (int)$_POST["user-id"] : null;

$messages_db = new DatabaseSupport;
$messages = $messages_db->get_all_by_user_id($user_id);

if (!$isLoggedIn) {
    header("Location: /sms");
    die();
}

Template::header("Contact");
?>
<main>
    <h2>Send a reply: </h2>
    <div class="contact-container">
        <form action="/sms/scripts/admin-reply-contact.php" method="post" class="contact-form">
            <input type="hidden" name="user-id" value="<?= $user_id ?>">
            <textarea class="contact-text" placeholder="Type your message..." name="contact-msg" required></textarea>
            <button type="submit" class="contact-btn">Send Message</button>
        </form>
        <?php if (isset($_GET["error"]) && $_GET["error"] == "msg_error") : ?>
            <h3 class="error-msg">Error: could not send your message, please try again later</h3>
        <?php endif; ?>

        <?php foreach ($messages as $message) : ?>
            <div class="chat-container <?= $message["sent_by"] ?>">
                <div class="chat-msg <?= $message["sent_by"] ?>">
                    <h3><?= $message["message"] ?></h3>
                    <h6 class="chat-msg <?= $message["sent_by"] ?>"><?= $message["date"] ?></h6>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</main>

<?php
Template::footer();
?>