<?php
require_once __DIR__ . "/../Classes/DatabaseUsers.php";

$success = false;

if (
    isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm-password"])
    && $_POST["password"] === $_POST["confirm-password"]
) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $users_db = new DatabaseUsers();

    $user = new User($username);
    $user->hash_password($password);

    $existing_user = $users_db->get_one_by_username($username);

    if ($existing_user) {
        //print_r("This username is taken, please try again");
        die("This username is taken, please try again");
        //exit();
    } else {
        $success = $users_db->add_user($user);
    }

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
