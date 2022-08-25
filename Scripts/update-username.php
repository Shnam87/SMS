<?php
require_once __DIR__ . "/../Classes/DatabaseUsers.php";

session_start();

$success = false;

$user_info = $_SESSION["user"];
$id = (int)$_POST["id"];
$username = $_POST["username"];

if (isset($username) && isset($id) && $user_info->id === $id) {

    $db = new DatabaseUsers();
    $user = new User($username);

    $success = $db->update_my_username($user, $id);
} else {
    echo "ERROR: Invalid input";
}

if ($success) {
    session_destroy();
    header("Location: /sms/pages/login.php");
} else {
    echo "Error: could not update user.";
}
