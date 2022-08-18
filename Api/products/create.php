<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Products.php';


/* Creating a new instance of the Database class and then calling the connect method on it. */
$database = new Database();
$db = $database->connect();

/* Creating a new instance of the Product class and then calling the connect method on it. */
$product = new Product($db);
$json = json_decode(file_get_contents("php://input"));

if(count($_POST)){
    // print_r($_POST);

    //creating new product from input
    $data = [
        'sku' => $_POST['sku'],
        'product_name' => $_POST['product_name'],
        'price' => $_POST['price'],
        'type' => $_POST['type'],
        'size' => $_POST['size'],
        'weight' => $_POST['weight'],
        'height' => $_POST['height'],
        'width' => $_POST['width'],
        'length' => $_POST['length'],
    ];

    if($product->create($data)){
        echo json_encode(array('message' => 'Product Added Successfully'));
    }
    
}elseif(isset($json))
{
    // print_r($json);
    $data = [
        'sku' => $json->sku,
        'product_name' => $json->product_name,
        'price' => $json->price,
        'type' => $json->type,
        'size' => $json->size,
        'weight' => $json->weight,
        'height' => $json->height,
        'width' => $json->width,
        'length' => $json->length,
    ];

    if($product->create($data)){
        echo json_encode(array('message' => 'Product Added Successfully'));
    }
}
