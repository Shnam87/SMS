<?php
require_once __DIR__ ."/../classes/Product.php";
require_once __DIR__ ."/../classes/Template.php";


$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

Template::header("Cart"); ?>

<div id="product-details" hidden>
    <img src="" id="product-img">
    <p id= "product-title"></p>
    <p id= "product-description"></p>
    <p id= "product-price"></p>
</div>

<?php foreach ($products as $product) : ?> 
    <div    >
        <img src="<?= $product->img_url ?>" width="50" height="50" alt="Product image">
        <b><?= $product->title ?></b>
        <i><?= $product->title ?></i>
        <p><?= $product->description ?></p>
    </div>

<?php

endforeach;

Template::footer();