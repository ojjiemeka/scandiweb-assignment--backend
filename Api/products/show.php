<?php

header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


// include_once '../../config/Database.php';
include_once '../../models/Products.php';



/* Creating a new instance of the Database class and then calling the connect method on it. */
// $database = new Database();
// $db = $database->connect();

if(!isset($_GET['id'])){
  die(
    // return message
  );

}


/* Creating a new instance of the product class and then calling the connect method on it. */
$product = new Product();


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

// Adeyinka Adefolurin20:45
// class Product {
//     public function find($id) {
//          // query
//          // with the result, use the setters to the set the columns
//         // return $this;
//     }
// Adeyinka Adefolurin09:21
// $product = $product->find($_GET['id'])
// inside the controller...

// $product = $product->find($_GET['id'])

// $responseData = [
//   'id' => $product->getId();
//   'sku' => product->getSku();
// ]
// echo json_encode($responseData);