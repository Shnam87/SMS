<?php
require_once __DIR__ . "/../Classes/DatabaseUsers.php";

// session_start();

$success = false;

if (isset($_POST["id"])) {

    $db = new DatabaseUsers();
    $userId = $_POST["id"];

    /*
    var_dump($_SESSION);
    var_dump($_POST);
    var_dump($userId);
    die();
    */

    $success = $db->delete_user($userId);
    
} else {
    echo "Invalid input";
}

if ($success) {
    header("Location: /sms/pages/admin.php");
} else {
    echo "Error: could not delete user";
}
