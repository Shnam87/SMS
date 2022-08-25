<?php
require_once __DIR__ . "/../Classes/DatabaseUsers.php";

$success = false;

if (isset($_POST["id"])) {

    $db = new DatabaseUsers();
    $userId = $_POST["id"];

    $success = $db->delete_user($userId);
    
} else {
    echo "Invalid input.";
}

if ($success) {
    header("Location: /sms/pages/admin.php");
} else {
    echo "Error: could not delete user.";
}
