<?php
require_once __DIR__ . "/../Classes/DatabaseUsers.php";

session_start();

$success = false;
$verify_password = false;

if (
    isset($_POST["old-password"]) &&
    isset($_POST["new-password"]) &&
    isset($_POST["confirm-password"]) &&
    $_POST["new-password"] === $_POST["confirm-password"]
) {

    $db = new DatabaseUsers();
    $username = $_SESSION["user"]->username;

    $my_info = $db->get_one_by_username($username);
    $verify_password = $my_info->test_password($_POST["old-password"]);

    if ($verify_password) {
        $new_password = $_POST["new-password"];

        $new_password_hash = password_hash($new_password, null);
        $id = $_SESSION["user"]->id;

        $success = $db->update_password($new_password_hash, $id);
    } else {
        echo "ERROR: Invalid input";
    }

    if ($success) {
        session_destroy();
        header("Location: /sms/pages/login.php");
    } else {
        echo "ERROR: Unable to update password.";
    }
}
