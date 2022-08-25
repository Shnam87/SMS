<?php
require_once __DIR__ . "/../Classes/DatabaseUsers.php";
session_start();

$success = false;

if (isset($_POST["id"])) {

    $db = new DatabaseUsers();
    $userId = $_POST["id"];

    $success = $db->delete_user($userId);
    
} else {
    echo "Invalid input";
}

if ($success) {
    session_destroy();
    header("Location: /sms");
} else {
    echo "Error: could not delete user.";
}
