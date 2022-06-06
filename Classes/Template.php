<?php

class Template
{

    public static function header($title)
    { ?>
        <?php
        require_once __DIR__ . "/DatabaseUsers.php";
        require_once __DIR__ . "/../google-config.php";
        
        $isLoggedIn = (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]);
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $title ?> - Skön text</title>
            <link rel="stylesheet" href="/sms/assets/style.css">
        </head>

        <body>

            <h1><?= $title ?></h1>

            <nav>
            <?php if (!$isLoggedIn) : ?>
                <a href="/sms">Home</a> |
                <a href="/sms/pages/products.php">Products</a> |
                <a href="/sms/pages/contact.php">Contact</a> |
                <a href="/sms/pages/login.php">Login</a> |
                <a href="/sms/pages/register.php">Register</a>
            <?php else : ?>
                <p> Logged in as: <?= $_SESSION['user']->username ?> </p>
                <a href="/sms">Home</a> |
                <a href="/sms/pages/products.php">Products</a> |
                <a href="/sms/pages/contact.php">Contact</a> |
                <a href="/sms/scripts/logging-ut.php">Logout</a>
            <?php endif; ?>
            </nav>
            <hr>
            <?php if (!$isLoggedIn) : ?>
                <h3>Register or login to your account to be able to complete your purchase.</h3>
            <?php else : ?>
                <h3>Welcome<i><?= $_SESSION['user']->username ?> </i> </h3>
            <?php endif; ?>
        <?php  }


    public static function footer()
    { ?>
            <footer>
                Copyright SMS 2022
            </footer>

        </body>

        </html>

<?php  }
}
