<?php 
require_once __DIR__ . "/../Classes/DatabaseOrders.php";
require_once __DIR__ . "/../Classes/Template.php";

$order_db = new DatabaseOrders();
$orders = $order_db->get_all();

Template::header("SMS");
?>

<div class="create-order-container">
    <div class="create-order-input">
        <form action="/sms/scripts/post-cart.php" method="post">
            <input class="input-field" autofocus required type="text" name="create-order" placeholder="Order">
            <input class="create-btn" type="submit" value="Create">
        </form><br>
    </div>
</div>

<form action="/sms/scripts/order.php" method="post">
        <select name="book-id">
            <?php foreach($books as $book): ?>
            <option value="<?= $book->id; ?>"><?= $book; ?></option>
            <?php endforeach; ?> 
            <br>
            <input type="submit" value="Borrow">
        </select>
    </form>

<?php
Template::footer();
?>
