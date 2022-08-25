<?php
require_once __DIR__ . "/../Classes/DatabaseSupport.php";
require_once __DIR__ . "/../Classes/DatabaseUsers.php";

session_start();

$success = false;

$user_id = (int)$_POST["user-id"];
$user_role = $_SESSION["user"]->role;

if (isset($_POST["contact-msg"])) {

    $user_id = (int)$_POST["user-id"];
    $sent_by = $_SESSION["user"]->role;
    $message = $_POST["contact-msg"];

    $support = new Support($user_id, $sent_by, $message);
    $db = new DatabaseSupport();

    $success = $db->save_contact($support);
} else {
    echo "ERROR: Invalid input";
    var_dump($_POST);
    die();
}

if ($success) {
    header("Location: /sms/pages/my-page.php");
} else {
    header("Location: /sms/pages/contact3.php?error=msg_error");
    die();
}
