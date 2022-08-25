<?php
require_once __DIR__ . "/../Classes/DatabaseUsers.php";

session_start();

$success = false;

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $db = new DatabaseUsers();
    $user = $db->get_one_by_username($username);

    if ($user) {
        $success = $user->test_password($password);

        if ($success) {
            $_SESSION["loggedIn"] = true;
            $_SESSION["user"] = $user;
        }
    }
} else {
    echo "ERROR: Invalid input.";
    var_dump($_POST);
    die();
}

if ($success) {
    header("Location: /sms");
} else {
    header("Location: /sms/pages/login.php?error=wrong_login");
    die();
}
