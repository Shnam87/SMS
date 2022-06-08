<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/DatabaseProducts.php";

$product_id = $_GET["id"];
$products_db = new DatabaseProducts();
$product = $products_db->get_product_by_id($product_id);

Template::header("SMS");
?>

<main class="product-site-container">

    <nav class="product-nav">
        <a class="product-nav-a" href="/sms/pages/products.php">Products</a>
        <p class="product-nav-p">/  <?= $product->title ?></p>
   
    </nav>

    <section class="product-wrapper">
        <section class="img-container">
            <img src="https://www.elgiganten.se/image/dv_web_D180001002838537/361908/iphone-13-pro-max-5g-smartphone-1tb-silver--pdp_zoom-3000--pdp_main-960.jpg" alt="">
        </section>

        <section class="product-info-container">
            <h1><?= $product->title ?></h1>
            <p>
                <b>Description:</b>
                <?= $product->description ?>
            </p>

            <p>
                <b>Price:</b>
                <?= $product->price ?> SEK
            </p>
            <hr>

            <button class="button-cart">Add to cart</button>
        </section>
    </section>
</main>

<?php

Template::footer();

?>