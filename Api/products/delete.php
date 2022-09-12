<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../models/Products.php';

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $arr = $data->checkedItems;

  // Set ID to update
  if(count($arr) > 0){
      $product = new Product();
      $product->setId($arr);

      // Delete product
      $d = $product->delete();

      if(!$d) {
        echo json_encode(
          array('message' => 'couldn\'t delete post with id '.$arr)
        );
      }

      echo json_encode(
        array('message' => 'Deleted Successfully')
      );
 
  }
  else{
    echo json_encode(
      array('message' => 'No ids received delete')
    );
  }
 