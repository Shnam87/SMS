<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/DatabaseProducts.php";
require_once __DIR__ . "/../classes/Product.php";

$products_db = new DatabaseProducts();
$products = $products_db->get_all();

Template::header("Products");
?>

<main>
    <div class="product-card-container">
        <?php foreach($products as $product): ?>
            <div class="product-card">
                <div class="card-img">
                    <img class="card-img-tag" src="<?= $product->img_url ?>"alt="product image">
                </div>

                <div class="card-title">
                    <h2 class="products-h2">
                        <a class="products-title-link" href="/sms/pages/product.php?id=<?= $product->id ?>">
                            <?= $product->title ?>
                        </a>
                    </h2>
                </div>
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
</main>


<?php
Template::footer();
?>


    
