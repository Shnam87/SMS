<?php

require_once __DIR__ ."/../classes/DatabaseProducts.php";
require_once __DIR__ ."/../classes/Product.php";

session_start();

$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";


if(!$is_admin){
    http_response_code(401);
    die("Access danied");
}

$success = false;


/* if (isset($_POST["title"]) && isset ($_POST["description"]) && isset ($_POST["price"])){
    $db = new DatabaseProducts();
    $product = new Product($_POST["title"], $_POST["description"], $_POST["price"]);
    $success = $db->create_product($product);
}else{
    echo "Invalid input";
}
      
if($success){
    header("Location: /sms/pages/admin.php");
    die();
}else{
    echo "Error saving product to database";
} */



if (isset($_POST["title"]) && isset ($_POST["description"]) && isset ($_POST["price"])){
    $upload_directory = __DIR__ . "/../assets/uploads/";
    $upload_name = basename($_FILES["image"]["name"]); //katt.jpeg
    $name_parts = explode(".", $upload_name); //["katt", "jpeg"]
    $file_extension = end($name_parts); //
    $timestamp = time();
    $file_name = "{$timestamp}.{$file_extension}";
    $full_upload_path = $upload_directory . $file_name;
    $file_relative_url = "/sms/assets/uploads/{$file_name}";
    $success = move_uploaded_file($_FILES["image"]["tmp_name"], $full_upload_path);

    if($success){
        $product = new Product(
            $_POST["title"],
            $_POST["description"],
            $_POST["price"],
            $file_relative_url
        );

        $products_db = new DatabaseProducts();

        $success = $products_db->create_product($product);
    
    }else {
        die("Error uploadning image");
    }
 
}else{
    die("Invalid input");
}

if($success){
    header("Location: /sms/pages/admin.php");
    die();
}else{
    echo "Error saving product to database";
}




