<?php

require_once __DIR__ . "/../classes/DatabaseProducts.php";
require_once __DIR__ . "/../classes/Product.php";

$success = false;


if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["id"])) {
    $upload_directory = __DIR__ . "/../assets/uploads/";

    $upload_name = basename($_FILES["image"]["name"]);

    $name_parts = explode(".", $upload_name);

    $file_extension = end($name_parts);

    $timestamp = time();

    $file_name = "{$timestamp}.{$file_extension}";

    $full_upload_path = $upload_directory . $file_name;

    $file_relative_url = "/sms/assets/uploads/{$file_name}";

    $success = move_uploaded_file($_FILES["image"]["tmp_name"], $full_upload_path);

    if ($success) {
        $product = new Product(
            $_POST["title"],
            $_POST["description"],
            $_POST["price"],
            $file_relative_url
        );

        $products_db = new DatabaseProducts();

        $success = $products_db->update_product($product, $_POST["id"]);
    } else {
        die("Error uploadning image");
    }
} else {
    die("Invalid input.");
}



if ($success) {
    header("Location: /sms/pages/admin.php");
    die();
} else {
    die("Error saving product.");
}
