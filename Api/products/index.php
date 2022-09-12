<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../../models/Products.php';

/* Creating a new instance of the product class and then calling the connect method on it. */
$product = new Product();

/* Calling the getAllProducts method on the product class. */
$res = $product->getAllProducts();

    if (empty($res)) {
        $response = [
            'message' => "No Data Found"
        ];
        echo json_encode($response);
    }

    echo json_encode($res);


