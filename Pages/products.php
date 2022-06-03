<?php
require_once __DIR__ . "/../classes/DatabaseProducts.php";
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products_db = new DatabaseProducts();
$products = $products_db->get_all();

Template::header("SMS");
?>

<div class="products-container">
    <?php foreach($products as $product): ?>
    <div class="card-wrapper">
        <div class="card-img">IMAGE</div>
        <h2>
            <a class="products-title-link" href="/sms/pages/product.php?id=<?= $product->id ?>">
                <?= $product->title ?>
            </a>
        </h2>
        <p><?= $product->description ?></p>
        <h4><?= $product->price ?></h4>
        <form action="/sms/scripts/add-to-cart.php" method="post">
            <input type="hidden" name="id" value="<?= $product->id ?>">
            <input class="btn btn-add" type="submit" value="Add to cart">
        </form>
        <?php endforeach; ?>
    </div>
</div>

<div class="products-container">
    <table class="products-table">
        <thead>
            <tr>
                <th></th>
                <th class="products-table-head">Name</th> 
                <th class="products-table-head">Description</th>
                <th class="products-table-head">Price</th> 
            </tr>
        </thead>
        <tbody>
        <?php foreach($products as $product): ?>
            <tr>
                <td>
                    <p>IMAGE</p>
                </td>
                <td>
                    <a class="products-title-link" href="/sms/pages/product.php?id=<?= $product->id ?>">
                        <?= $product->title ?>
                    </a>
                </td> 
                <td>
                    <p><?= $product->description ?></p>
                </td>
                <td>
                    <p><?= $product->price ?></p>
                </td>
                <td>
                <form action="/sms/scripts/add-to-cart.php" method="post">
                    <input type="hidden" name="id" value="<?= $product->id ?>">
                    <input class="btn btn-add" type="submit" value="Add to cart">
                </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php
var_dump($products);

Template::footer();
?>
</body>
</html>

    
