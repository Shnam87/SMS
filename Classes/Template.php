<?php

class Template {

    public static function header($title) 
    { ?>
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

            <h1><?=$title?></h1>

            <nav>
                <a href="/sms">Home</a> |
                <a href="/sms/pages/products.php">Products</a> |
                <a href="/sms/pages/contact.php">Contact</a> |
                <a href="/sms/pages/login.php">Login</a> |
                <a href="/sms/pages/register.php">Register</a>
                
            </nav>
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