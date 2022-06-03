<?php
require_once __DIR__ . "/../classes/DatabaseProducts.php";
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products_db = new DatabaseProducts();
$products = $products_db->get_all();

Template::header("SMS");
?>

<div class="products-container" style="border: 2px solid green;">
    <table class="products-table">
        <thead>
            <tr>
                <th></th>
                <th class="products-table-head">Name</th> 
                <th class="products-table-head">Description</th>
                <th class="products-table-head">Price</th> 
                <th class="products-table-head">Quantity</th>
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
                    <p>TBD</p>
                </td>
                <td>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $product->id ?>">
                    <input class="btn btn-delete" type="submit" value="Delete">
                </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
Template::footer();
?>
</body>
</html>
