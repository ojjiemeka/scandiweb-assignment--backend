<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  // include_once '../../config/Database.php';
  include_once '../../models/Products.php';

  // Instantiate DB & connect
  // $database = new Database();
  // $db = $database->connect();

  // Instantiate product object
  // $product = new Product();

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // echo json_encode(
  //   array('message' => $data->checkedItems)
  // );
  $arr = $data->checkedItems;
  // $d = $product->delete();

  // echo json_encode($arr);
  // die();

  // Set ID to update
  if(count($arr) > 0){
    // while ($arr){

      $product = new Product();
      $product->setId($arr);
//   echo json_encode($product->getId());
// die();
      $d = $product->delete();
      // Delete post
      if(!$d) {
        echo json_encode(
          array('message' => 'couldn\'t delete post with id '.$arr)
        );
      }
    // }

    echo json_encode(
      array('message' => 'Deleted Successfully')
    );
 
  }
  // else{
//     echo json_encode(
//       array('message' => 'No ids received delete')
//     );
//   }
 