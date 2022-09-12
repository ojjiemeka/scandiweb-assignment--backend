<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../../models/Products.php';


$json = json_decode(file_get_contents("php://input"));

$data = [];

if(isset($json)) {
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
    // print_r($data);

} else {
    echo json_encode(array('message' => 'Error'));
    exit();
}

$product = new Product();
$product->setSku($data['sku']);
$product->setProductName($data['product_name']);
$product->setPrice($data['price']);
$product->setType($data['type']);
$product->setSize($data['size']);
$product->setWeight($data['weight']);
$product->setHeight($data['height']);
$product->setWidth($data['width']);
$product->setLength($data['length']);

try {
    $product->create();
    $response = [
        'message' => "Created Successfully",
        'status' => 200
    ];
    echo json_encode($response);

} catch (\Throwable $th) {
    $response = [
        'message' => $th->getMessage()
    ];
    echo json_encode($response);

}
