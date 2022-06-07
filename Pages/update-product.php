<?php


require_once __DIR__ ."/../classes/DatabaseProducts.php";
require_once __DIR__ ."/../classes/Template.php";


$product_id = $_GET["id"];

$products_db = new DatabaseProducts();

$product = $products_db->get_product_by_id($product_id);


var_dump($product);



Template::header("SMS");
?>


<form action="/sms/scripts/post-edit-product.php" method="post">
    <input type="text" name="title" placeholder="Name" value="<?= $product->title ?>"> <br>
    <textarea type="text" name="description" rows="10" cols="30"><?= $product->description ?></textarea> <br>
    <input type="number" name="price" placeholder="Price" value="<?= $product->price ?>"> <br>
    <input type="hidden" name="id" value="<?= $product->id ?>">
    <input type="submit" value="Save">
</form>

<?php    

Template::footer();

?>