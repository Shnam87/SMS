<?php
require_once __DIR__ . "/../classes/DatabaseProducts.php";
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products_db = new DatabaseProducts();
$products = $products_db->get_all();

Template::header("Products");
?>

<div class="products-main">
    <div class="prod-container">
        <div class="prod-box prod-box-1">
            <h2>SUMMER BLAST</h2>
        </div>
        <div class="prod-box prod-box-2">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, reiciendis quaerat quibusdam at soluta ducimus nemo, voluptates nihil id iusto sed quae odio veritatis culpa odit nesciunt aperiam quidem autem.</p>
        </div>
    </div>
</div>
<?php // var_dump($products) ?>
<div class="product-card-container">
    <?php foreach($products as $product): ?>
        <div class="product-card">
            <div class="card-img">
                <img src="<?= $product->img_url ?>" alt="Product image">
            </div>
            <div class="card-title">
                <h2>
                    <a class="products-title-link" href="/sms/pages/product.php?id=<?= $product->id ?>">
                        <?= $product->title ?>
                    </a>
                </h2>
            </div>
            <!-- <div class="card-desc">
                <p><?= $product->description ?></p>
            </div> -->
            <div class="card-price">
                <h4><?= $product->price ?> SEK</h4>
            </div>
            <div class="card-btn">
                <form action="/sms/pages/cart.php" method="post">
                    <input type="hidden" name="product-id" value="<?= $product->id ?>">
                    <input class="btn-add" type="submit" value="Add to cart">
                </form>

                
            </div>
        </div> 
    <?php endforeach; ?>
</div>

<?php
// var_dump($products);

Template::footer();
?>


    
