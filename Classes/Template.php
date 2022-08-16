<?php
 require_once __DIR__ . "/DatabaseUsers.php";
 require_once __DIR__ . "/../google-config.php";


class Template
{

    public static function header($title)
    {
        
       
        $isLoggedIn = (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]);
        $isAdmin = (isset($_SESSION["user"]->role) && $_SESSION["user"]->role == "admin");
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $title ?></title>
            <link rel="stylesheet" href="/sms/assets/style.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        </head>

        <body>
            <header>
                <a href="/sms"><img src="/../SMS/Assets/sms_logo.png" alt="sms-logo" class="sms-logo"></a>
                <nav>
                    <a href="/sms" class="nav-link">Home</a> |
                    <a href="/sms/pages/products.php" class="nav-link">Products</a> |
                    <?php if ($isLoggedIn && $isAdmin) : ?>
                        <a href="/sms/pages/admin.php" class="nav-link admin-nav-link">Admin page</a>
                    <?php endif; ?>
                </nav>

                <nav class="icons-contianer">
                    <?php if (!$isLoggedIn) : ?>
                        <button class="my-site-btn">
                            <a href="/sms/pages/login.php"><span class="material-icons">login</span>
                                <p> Login/Register</p>
                            </a>
                        </button>

                    <?php else : ?>
                        <button class="my-site-btn">
                            <a href="/sms/pages/my-page.php" class="material-symbols-outlined">person
                                <p> My page</p>
                            </a>
                        </button>
                        <a href="/sms/scripts/logging-out.php"><span class="material-icons">logout</span></a>

                    <?php endif; ?>

                    <span class="material-symbols-outlined">favorite</span>
                    <a href="/sms/pages/cart.php"><span class="material-symbols-outlined">shopping_cart</span></a>
                </nav>
            </header>
            <hr>

            <?php if (!$isLoggedIn) : ?>
                <h3 class="header-text">Register or login to your account to be able to complete your purchase.</h3>
            <?php else : ?>
                <!-- <h3 class="header-text">Welcome <i><?= $_SESSION['user']->username ?>!</i> </h3> -->
            <?php endif; ?>

            <hr>
        <?php  }


    public static function footer()
    { ?>
            <footer>
                <div class='main-footer'>
                    <div class='footer-container'>
                        <div class='footer-box box-1'>
                            <h3 class='footer-h3'>About</h3>
                            <p class='footer-p'><a href=''>Our mission explained</a></p>
                            <p class='footer-p'><a href=''>Annual charity report</a></p>
                        </div>
                        <div class='footer-box box-2'>
                            <h3 class='footer-h3'>Info</h3>
                            <p class='footer-p'><a href=''>Shipping and tracking</a></p>
                            <p class='footer-p'><a href=''>FAQs</a></p>
                        </div>
                        <div class='footer-box box-3'>
                            <h3 class='footer-h3'>Contact</h3>
                            <p class='footer-p'><a href="mailto:sms@sms.com">Email us</a></p>
                            <p class='footer-p'><a href="tel:+4686736000">08 - 673 60 00</a></p>
                        </div>
                    </div>
                    <div class='footer-row'>
                        <p class='footer-socials'><a href=''>
                                <BsFacebook />
                            </a> <a href=''>
                                <BsInstagram />
                            </a> <a href=''>
                                <BsTwitter />
                            </a> <a href=''>
                                <BsYoutube />
                            </a> <a href=''>
                                <BsPinterest />
                            </a></p>
                        <p>SMS | All Rights Reserved &copy; 2022</p>
                        <p>The content of this site is copyright-protected and is property of SMS. SMS' business concept is to offer function and quality at the best price in a sustainable way.</p>
                    </div>
                </div>
            </footer>
        </body>

        </html>

<?php  }
}
