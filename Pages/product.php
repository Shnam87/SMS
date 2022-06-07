
<?php

require_once __DIR__ ."/../classes/Template.php";
require_once __DIR__ ."/../classes/Product.php";
require_once __DIR__ ."/../classes/DatabaseProducts.php";


$product_id = $_GET["id"];

$products_db = new DatabaseProducts();

$product = $products_db->get_product_by_id($product_id);


Template::header("");
?>
    <main class="product-info-wrapper">
        <h1><?= $product->title ?></h1>

        <section>
            <p>
                <b>Description:</b>
                <?= $product->description ?>
            </p>

            <p>
                <b>Price:</b>
                <?= $product->price ?>
            </p>
        </section>

        <button>Add to cart</button>


        <a href="/sms/pages/products.php">Back to products</a>
    </main>

<?php    

Template::footer();

?>