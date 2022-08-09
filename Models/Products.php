<?php

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
     * It's a function that reads all the posts from the database and returns them in a statement.
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

    public function create(){
        $query = 'INSERT INTO ' . $this->table . ' 
        SET sku = :sku, 
            product_name = :product_name, 
            price = :price, 
            type = :type, 
            size = :size, 
            weight = :weight, 
            height = :height, 
            width = :width, 
            length = :length ';

        $stmt = $this->conn->prepare($query);

        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->product_name = htmlspecialchars(strip_tags($this->product_name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->size = htmlspecialchars(strip_tags($this->size));
        $this->weight = htmlspecialchars(strip_tags($this->weight));
        $this->height = htmlspecialchars(strip_tags($this->height));
        $this->width = htmlspecialchars(strip_tags($this->width));
        $this->length = htmlspecialchars(strip_tags($this->length));

        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':product_name', $this->product_name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':size', $this->size);
        $stmt->bindParam(':weight', $this->weight);
        $stmt->bindParam(':height', $this->height);
        $stmt->bindParam(':width', $this->width);
        $stmt->bindParam(':length', $this->length);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
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