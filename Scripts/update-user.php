<?php
require_once __DIR__ . "/../Classes/DatabaseUsers.php";

$success = false;


if (isset($_POST["username"]) && isset($_POST["role"]) && isset($_POST["id"])) {

    $db = new DatabaseUsers();
    $user = new User($_POST["username"], $_POST["role"], $_POST["id"]);

    $success = $db->update_user($user);
} else {
    echo "ERROR: Invalid input.";
}

if ($success) {
    header("Location: /sms/pages/admin.php");
} else {
    echo "Error: could not update user.";
}
