<?php

require_once __DIR__ . "/../classes/DatabaseProducts.php";
$success = false;

if (isset($_POST["id"])) {
    $db = new DatabaseProducts();

    $product_id = $_POST["id"];
    $db->delete_product($product_id);

    $success = $db->delete_product($product_id);
} else {
    echo "Invalid input.";
}

if ($success) {
    header("Location: /sms/pages/admin.php");
} else {
    echo "Error removing product from database.";
}
