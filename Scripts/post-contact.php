<?php
require_once __DIR__ . "/../Classes/DatabaseSupport.php";
require_once __DIR__ . "/../Classes/DatabaseUsers.php";

session_start();

$user_id = $_SESSION["user"]->id;
$user_role = $_SESSION["user"]->role;

$success = false;

if (isset($_POST["contact-msg"])) {

    $user_id = $_SESSION["user"]->id;
    $sent_by = $_SESSION["user"]->role;
    $message = $_POST["contact-msg"];

    $support = new Support($user_id, $sent_by, $message);
    $db = new DatabaseSupport();

    $success = $db->save_contact($support);
} else {
    echo "ERROR: Invalid input.";
    var_dump($_POST);
    die();
}

if ($success) {
    header("Location: /sms/pages/contact.php");
} else {
    header ("Location: /sms/pages/contact.php?error=msg_error");
    die();
}

