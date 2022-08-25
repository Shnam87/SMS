<?php
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

$total = 0;

foreach ($products as $product) {
    $total += $product->price;
}

Template::header("Cart"); ?>

<!-- <div id="product-details" hidden>
    <img src="" id="product-img">
    <p id= "product-title"></p>
    <p id= "product-description"></p>
    <p id= "product-price"></p>
</div> -->

<section class="cart-wrapper">
    <h1>My Cart</h1>

    <?php if ($total == 0) : ?>
        <div class="empty-cart">
            <img src="/SMS/Assets/empty-cart.png" alt="empty cart">
            <h3>And here it was empty.</h3>
            <h3>Time to add some goods!</h3>
            <button class="btn btn-empty-cart"><a href="/sms/Pages/products.php"> Continue shopping </button>
        </div>
    <?php else : ?>
        <ul class="cart-list">
            <?php foreach ($products as $product) : ?>
                <li class="cart-list-item">
                    <img src="<?= $product->img_url ?>" width="50" height="50" alt="Product image">
                    <div class="cart-item-details">
                        <a class="products-title-link" href="/sms/pages/product.php?id=<?= $product->id ?>"><?= $product->title ?></a>
                        <p><?= $product->description ?></p>
                    </div>
                    <h3 class="cart-item-price"><?= $product->price ?> SEK</h3>
                </li>
            <?php endforeach; ?>
        </ul>
        <span class="cart-total">
            <h3><?= $total ?> SEK</h3>
        </span>
        <div>
            <form action="/sms/scripts/post-order.php" method="post">
                <!-- <input type="hidden" name="product-id" value="<?= $product->id ?>"> -->
                <input class="btn btn-add" type="submit" value="Pleace order">
            </form>
        </div>
    <?php endif; ?>
</section>

<?php

Template::footer();

?>