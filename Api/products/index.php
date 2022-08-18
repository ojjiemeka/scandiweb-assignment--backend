<?php

header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: GET, POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Products.php';



/* Creating a new instance of the Database class and then calling the connect method on it. */
$database = new Database();
$db = $database->connect();


/* Creating a new instance of the Post class and then calling the connect method on it. */
$product = new Product($db);


/* Calling the read method on the Post class. */
$result = $product->index();


$num = $result->rowCount();


/* The above code is fetching the data from the database and then converting it into JSON format. */
if($num > 0){
    $products_arr = array();
    $products_arr['data'] = array();

    while( $row = $result->fetch(PDO::FETCH_ASSOC)){
        // $row['title'];
        extract($row);
        $product_item = array(
            'id' => $id,
            'sku' => $sku,
            'product_name' => $product_name,
            'type' => $type,
            'price' => $price,
            'size' => $size,
            'weight' => $weight,
            'height' => $height,
            'width' => $width,
            'length' => $length,
            'created_at' => $created_at,
            // 'body' => html_entity_decode($body),
        );
        /* Pushing the  array into the ['data'] array. */
        array_push($products_arr['data'], $product_item);
    }

    echo json_encode($products_arr);
}else{
    echo json_encode(
        array(
            'message' => 'No Product Found'
        )
        );
}
