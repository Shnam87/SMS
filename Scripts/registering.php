<?php
require_once __DIR__ . "/../Classes/DatabaseUsers.php";

$success = false;

if (isset($_POST['username']) && isset($_POST['password']) ) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($username);
    $user->hash_password($password);

    $db = new DatabaseUsers();
    $success = $db->addUser($user);
} else {
    echo "ERROR: Invalid input";
    var_dump($_POST);
    die();
}

if ($success) {
    header("Location: /sms");
} else {
    echo "ERROR: Unable to save user";
    die();
}