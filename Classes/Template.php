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
                <div className='main-footer'>
                    <div className='footer-container'>
                    <div className='footer-box box-1'>
                        <h3 className='footer-h3'>About</h3>
                        <p className='footer-p'><a href=''>Our mission explained</a></p>
                        <p className='footer-p'><a href=''>Annual charity report</a></p>
                    </div>
                    <div className='footer-box box-2'>
                        <h3 className='footer-h3'>Info</h3>
                        <p className='footer-p'><a href=''>Shipping and tracking</a></p>
                        <p className='footer-p'><a href=''>FAQs</a></p>
                    </div>
                    <div className='footer-box box-3'>
                        <h3 className='footer-h3'>Contact</h3>
                        <p className='footer-p'><a href="mailto:sms@sms.com">Email us</a></p>
                        <p className='footer-p'><a href="tel:+4686736000">08 - 673 60 00</a></p>
                    </div>
                    </div>
                    <div className='footer-row'>
                    <p className='footer-socials'><a href=''><BsFacebook  /></a> <a href=''> <BsInstagram /></a> <a href=''> <BsTwitter /></a> <a href=''><BsYoutube /></a> <a href=''><BsPinterest /></a></p>
                    <p>SMS | All Rights Reserved &copy; 2022</p>
                    <p>The content of this site is copyright-protected and is property of SMS. SMS' business concept is to offer function and quality at the best price in a sustainable way.</p>
                    </div>
                </div>
            </footer>       
        </body>
    </html>
    
    <?php  }    
}