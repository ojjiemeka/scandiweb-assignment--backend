<?php

header('Access-Control-Allow-Orgin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Products.php';



/* Creating a new instance of the Database class and then calling the connect method on it. */
$database = new Database();
$db = $database->connect();


/* Creating a new instance of the Post class and then calling the connect method on it. */
$product = new Product($db);
$data = json_decode(file_get_contents("php://input"));
$product->sku = $data->sku;
$product->product_name = $data->product_name;
$product->price = $data->price; 
$product->type = $data->type;
$product->size = $data->size;
$product->weight = $data->weight;
$product->height = $data->height;
$product->width = $data->width;
$product->length = $data->length;



if($product->create()){
    echo json_encode(
        array(
            'message' => 'Product Created'
        )
        );
}else{
    echo json_encode(
        array(
            'message' => 'Something Went Wrong'
        ) 
        );
}