<?php

header('Access-Control-Allow-Orgin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Products.php';



/* Creating a new instance of the Database class and then calling the connect method on it. */
$database = new Database();
$db = $database->connect();


/* Creating a new instance of the Post class and then calling the connect method on it. */
$product = new Product($db);


// get id
$product->id = isset($_GET['id']) ? $_GET['id'] : die();

$product->show();

$product_arr = array(
    'id' => $product->id,
    'sku' => $product->sku,
    'product_name' => $product->product_name,
    'type' => $product->type,
    'price' => $product->price,
    'size' => $product->size,
    'height' => $product->height,
    'width' => $product->width,
    'length' => $product->length,
    'created_at' => $product->created_at
);

print_r(json_encode($product_arr));