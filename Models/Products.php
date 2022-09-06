<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


class Product {
    // DB
    private $conn;
    private $table = 'products';

    //Post Properties
    public $id;
    public $sku;
    public $product_name;
    public $price;
    public $type;
    public $size;
    public $weight;
    public $height;
    public $width;
    public $length;

    // constructor with db
    public function __construct($db){
        $this->conn = $db;
    }


    /**
     * It's a function that reads all the product from the database and returns them in a statement.
     * 
     * @return An object of the PDOStatement class.
     */
    public function index(){
        $query = "SELECT *
        FROM $this->table 
        ";

        // statement
        $stmt = $this->conn->prepare($query);

        // execute
        $stmt->execute();

        return $stmt;
    }

    public function create($data){
        try {
            //assigning values
            $this->sku = $data['sku'];
            $this->product_name = $data['product_name'] ;
            $this->price = $data['price'] ;
            $this->type = $data['type'] ;
            $this->size = empty($data['size']) ? null: $data['size'] ;
            $this->weight = empty($data['weight']) ? null: $data['weight'] ;
            $this->height = empty($data['height']) ? null: $data['height'] ;
            $this->width = empty($data['width']) ? null: $data['width'] ;
            $this->length = empty($data['length']) ? null: $data['length'] ;

            // $q = "SELECT 'sku' FROM $this->table WHERE 'sku' = '$this->sku' ";
    
            $sql = "SELECT COUNT(*) FROM $this->table WHERE sku = '$this->sku'";// use `COUNT(*)`
            $result = $this->conn->prepare($sql);
            $result->execute();
            $data = $result->fetchColumn();    
            // echo json_encode(array('myres' => $data));
            if ($data > 0) 
                {
                    echo json_encode(array('status'=>"400", 'message' => "SKU already exists"));
                    return false;
                    die();
                }

            $query = "INSERT INTO $this->table 
            SET sku = :sku, 
                product_name = :product_name, 
                price = :price, 
                type = :type, 
                size = :size, 
                weight = :weight, 
                height = :height, 
                width = :width, 
                length = :length ";
            
            $product = $this->conn->prepare($query);

            $product->bindValue('sku', $this->sku);
            $product->bindValue('product_name', $this->product_name);
            $product->bindValue('price', $this->price);
            $product->bindValue('type', $this->type);
            $product->bindValue('size', $this->size);
            $product->bindValue('weight', $this->weight);
            $product->bindValue('height', $this->height);
            $product->bindValue('width', $this->width);
            $product->bindValue('length', $this->length);

            if($product->execute()){
                return true;
            }

            return false;


        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    
    public function show(){
        $query = 'SELECT * 
                    FROM 
                    ' . $this->table . ' 
                    WHERE id = ?';


         // statement
         $stmt = $this->conn->prepare($query);

        /* It's binding the parameter to the query. */
         $stmt->bindParam(1, $this->id);

         // execute
         $stmt->execute();
 
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         $this->sku = $row['sku'];
         $this->product_name = $row['product_name'];
         $this->type = $row['type'];
         $this->size = $row['size'];
         $this->weight = $row['weight'];
         $this->height = $row['height'];
         $this->width = $row['width'];
         $this->length = $row['length'];
         $this->created_at = $row['created_at'];
    }


  // Delete Post
  public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
  }

}