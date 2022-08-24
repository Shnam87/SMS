<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/DatabaseProducts.php";
require_once __DIR__ . "/../classes/Product.php";

$products_db = new DatabaseProducts();
$products = $products_db->get_all();

Template::header("Products");
?>

<!-- <div class="products-main">
    <div class="prod-container">
        <div class="prod-box prod-box-1">
            <h2>New Arrivals</h2>
        </div>
        <div class="prod-box prod-box-2">
            <p>Get back-to-school ready with everything you need to dominate this fall!</p>
        </div>
    </div>
</div> -->

<div class="product-card-container">
    <?php foreach($products as $product): ?>
        <div class="product-card">
            <div class="card-img">
                <img src="<?= $product->img_url ?>"alt="product image">
            </div>

            <div class="card-title">
                <h2 class="products-h2">
                    <a class="products-title-link" href="/sms/pages/product.php?id=<?= $product->id ?>">
                        <?= $product->title ?>
                    </a>
                </h2>
            </div>
            <!-- <div class="card-desc">
                <p><?= $product->description ?></p>
            </div> -->
            <div class="card-price">
                <h4 class="products-h4"><?= $product->price ?> SEK</h4>
            </div>
            
                <form class="products-btn" action="/sms/scripts/add-to-cart.php" method="post">
                    <input type="hidden" name="product-id" value="<?= $product->id ?>">
                    <input class="products-btn-add" type="submit" value="Add to cart">
                </form>
            
        </div> 
    <?php endforeach; ?>
</div>

<?php
Template::footer();
?>


    
