<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/DatabaseProducts.php";

$product_id = $_GET["id"];
$products_db = new DatabaseProducts();
$product = $products_db->get_product_by_id($product_id);

Template::header("Product");
?>

<main class="product-site-container">
    <nav class="product-nav">
        <a class="product-nav-a" href="/sms/pages/products.php">Products</a>
        <p class="product-nav-p">/ <?= $product->title ?></p>
    </nav>

    <section class="product-wrapper">
        <section class="img-container">
            <img src="<?= $product->img_url ?>" alt="Product image">
        </section>

        <section class="product-info-container">
            <h1><?= $product->title ?></h1>
            <p><b>Description:</b><?= $product->description ?></p>
            <p><b>Price:</b><?= $product->price ?> SEK</p>
            <hr>

            <div>
                <form action="/sms/scripts/add-to-cart.php" method="post">
                    <input type="hidden" name="product-id" value="<?= $product->id ?>">
                    <input class="btn btn-add" type="submit" value="Add to cart">
                </form>
            </div>
        </section>
    </section>
</main>

<?php
Template::footer();
?>