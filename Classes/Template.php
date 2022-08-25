<?php
 require_once __DIR__ . "/DatabaseUsers.php";
 require_once __DIR__ . "/../google-config.php";

class Template
{
    public static function header($title)
    {
        $isLoggedIn = (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]);
        $isAdmin = (isset($_SESSION["user"]->role) && $_SESSION["user"]->role == "admin");
        $cart_count = isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0;
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $title ?></title>
            <script src="/sms/assets/js.js" defer></script>
            <link rel="stylesheet" href="/sms/assets/style.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        </head>
        <body>
            <header>
                <section class="header-top-section">
                    <div class="left-container">
                        <?php if ($isLoggedIn && $isAdmin) : ?>
                                    <button class="header-nav-btn" id="admin-btn">
                                        <a href="/sms/pages/admin.php" class="top-header-link">Admin Dashboard</a>
                                    </button>
                        <?php endif; ?>

                        <?php if (!$isLoggedIn) : ?>
                            <p class="header-text">You're currently in observer mode, please login or register an account in order to experience the site in full.</p>
                            <?php else : ?>
                                <p class="header-text">Welcome, <i><?= $_SESSION['user']->username ?>!</i> </p>
                        <?php endif; ?>
                    </div>
                    <div class="right-container">
                        <nav class="icons-contianer">

                            <?php if (!$isLoggedIn) : ?>
                                <button class="header-nav-btn">
                                    <a href="/sms/pages/login.php" class="top-header-link">
                                        <span class="material-icons">login</span>
                                        <p> Login / Register</p>
                                    </a>
                                </button>
                            <?php else : ?>
                                <button class="header-nav-btn">
                                    <a href="/sms/pages/my-page.php" class="top-header-link"> 
                                        <span class="material-symbols-outlined">person</span>
                                        <p> My Account</p>
                                    </a>
                                </button>
                                <a href="/sms/scripts/logging-out.php" class="top-header-link">
                                    <span class="material-icons">logout</span>
                                </a>
                            <?php endif; ?>
                            <a href="/sms/pages/cart.php" class="top-header-link">
                                <span class="material-symbols-outlined">shopping_cart</span>
                            <p class="count-cart"><?=$cart_count?></p></a>
                        </nav>
                    </div>
                </section>   
                <section class="header-bottom-section">
                    <a href="/sms"><img src="/../SMS/Assets/sms_logo.png" alt="sms-logo" class="sms-logo"></a>
                    <nav class="header-nav">
                        <a href="/sms" class="nav-link"><b>HOME</b></a>
                        <a href="/sms/pages/products.php" class="nav-link"><b>PRODUCTS</b></a>
                    </nav>
                </section>
            </header>
        <?php  }
    public static function footer()
    { ?>
            <footer>
                <div class='main-footer'>
                    <div class='footer-container'>
                        <div class='footer-box box-1'>
                            <h3 class='footer-h3'>About</h3>
                            <p class='footer-p'>Our mission explained</p>
                            <p class='footer-p'>Annual charity report</p>
                        </div>
                        <div class='footer-box box-2'>
                            <h3 class='footer-h3'>Info</h3>
                            <p class='footer-p'>Shipping and tracking</p>
                            <p class='footer-p'>FAQs</p>
                        </div>
                        <div class='footer-box box-3'>
                            <h3 class='footer-h3'>Contact</h3>
                            <p class='footer-p'>email: sms@sms.com</p>
                            <p class='footer-p'>phone: +46 (0)8 673 6000</p>
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
