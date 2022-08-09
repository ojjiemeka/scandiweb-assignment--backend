<?php

class Category {
    // DB

    private $conn;
    private $table = 'category';

    //Post Properties
    public $id;
    public $category_name;
   

    // constructor with db
    public function __construct($db){
        $this->conn = $db;
    }


    public function create(){
        $query = 'INSERT INTO ' . $this->table . ' SET category_name = :category_name';

        $stmt = $this->conn->prepare($query);

        $this->category_name = htmlspecialchars(strip_tags($this->category_name));

        $stmt->bindParam(':category_name', $this->category_name);


        if($stmt->execute()){
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

     // Update Post
     public function update() {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                              SET product_id = :product_id, category_name = :category_name, size = :size, weight = :weight
                              WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->category_name = htmlspecialchars(strip_tags($this->category_name));
        $this->size = htmlspecialchars(strip_tags($this->size));
        $this->weight = htmlspecialchars(strip_tags($this->weight));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':category_name', $this->category_name);
        $stmt->bindParam(':size', $this->size);
        $stmt->bindParam(':weight', $this->weight);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
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