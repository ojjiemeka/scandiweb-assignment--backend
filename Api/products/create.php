<?php

// if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
//     header("HTTP/1.1 200");
//     header('Access-Control-Allow-Origin: *');
//     header('Content-Type: application/json');
//     header('Access-Control-Allow-Methods: POST');
//     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//     exit;
// }
header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Origin: http://localhost:4200');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Products.php';



/* Creating a new instance of the Database class and then calling the connect method on it. */
$database = new Database();

$db = $database->connect();


/* Creating a new instance of the Post class and then calling the connect method on it. */
//data is being gotten here
$product = new Product($db);
$data = json_decode(file_get_contents("php://input"));

// echo json_encode(
//     array(
//         'data' => $data 
//     )
//     );
//     die();

//data is being put into model here and the create method from class product is called
// $product->sku = $data->id;
$product->sku = isset($data->sku) ? $data->sku : null;
$product->product_name = isset($data->product_name) ? $data->product_name : null;
$product->price = isset($data->price) ? $data->price : null;
$product->type = isset($data->type) ? $data->type : null;
$product->size =  isset($data->size) ? $data->size : null;
$product->weight = isset($data->weight ) ? $data->weight  : null;
$product->height =  isset($data->height) ? $data->height : null;
$product->width =  isset($data->width) ? $data->width : null;
$product->length =  isset($data->length) ? $data->length : null;

// echo json_encode(
//     array(
//         'products' => $product
//     )
//     );
//     die();

$add = $product->create();
if($add ){
    echo json_encode(
        array(
            // 'message' => 'Product Created'
            'message' => $add
        )
        );
        die();
}else{
    echo json_encode(
        array(
            'message' => $add

        ) 
        );
        die();

}
