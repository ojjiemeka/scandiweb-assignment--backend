<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../config/Database.php';

class Product
{
    // DB
    private $conn;
    private $table = 'products';

   
    //Product Properties
    private $id;
    private $sku;
    private $product_name;
    private $price;
    private $type;
    private $size;
    private $weight;
    private $height;
    private $width;
    private $length;
    // private $checkedItems;

    public function startDB()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setSku($sku)
    {
        $this->sku = $sku;
    }
    public function setProductName($product_name)
    {
        $this->product_name = $product_name;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setType($type)
    {
        $this->type = $type;
    }
    public function setSize($size)
    {
        $this->size = $size;
    }
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
    public function setHeight($height)
    {
        $this->height = $height;
    }
    public function setWidth($width)
    {
        $this->width = $width;
    }
    public function setLength($length)
    {
        $this->length = $length;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getSku()
    {
        return $this->sku;
    }
    public function getProductName()
    {
        return  $this->product_name;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getSize()
    {
        return $this->size;
    }
    public function getWeight()
    {
        return $this->weight;
    }
    public function getHeight()
    {
        return $this->height;
    }
    public function getWidth()
    {
        return $this->width;
    }
    public function getLength()
    {        
        return $this->length;
    }


    /**
     * It's a function that reads all the product from the database and returns them in a statement.
     * 
     * @return An object of the PDOStatement class.
     */
    public function getAllProducts()
    {
        try {
            $this->startDB();

            $sql = "SELECT * FROM $this->table";

            // statement
            $query = $this->conn->prepare($sql);

            // execute
            $query->execute();

            /* Counting the number of rows in the database. */
            $num = $query->rowCount();
            
            $products_arr = [];

            /* The below code is fetching the data from the database and then converting it into JSON format. */
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                
                    $this->setID($row['id']);
                    $this->setSku($row['sku']);
                    $this->setProductName($row['product_name']);
                    $this->setType($row['type']);
                    $this->setPrice($row['price']);
                    $this->setSize($row['size']);
                    $this->setWeight($row['weight']);
                    $this->setHeight($row['height']);
                    $this->setWidth($row['width']);
                    $this->setLength($row['length']);
            
                    $data = [
                        'id' => $this->getId(),
                        'sku' => $this->getSku(),
                        'product_name' => $this->getProductName(),
                        'type' => $this->getType(),
                        'price' => $this->getPrice(),
                        'size' => $this->getSize(),
                        'weight' => $this->getWeight(),
                        'height' => $this->getHeight(),
                        'width' => $this->getWidth(),
                        'length' => $this->getLength()
                    ];

                    $product_arr[] = $data;
                }

            if (!$query->execute()) {
                throw new Exception("Error!! Cant get products");
            }
            return $product_arr;

            
        } catch (\Throwable $th) {
            $response = [
                'message' => $th->getMessage()
            ];
            echo json_encode($response);
        }
    }

    public function create()
    {
        try {
            $this->startDB();

            $sql = "SELECT COUNT(*) FROM $this->table WHERE sku = '$this->sku'"; // use `COUNT(*)`
            $result = $this->conn->prepare($sql);
            $result->execute();
            $data = $result->fetchColumn();
            if ($data > 0) {
                throw new Exception("SKU already exists");
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

            $product->bindValue('sku', $this->getSku());
            $product->bindValue('product_name', $this->getProductName());
            $product->bindValue('price', $this->getPrice());
            $product->bindValue('type', $this->getType());
            $product->bindValue('size', $this->getSize());
            $product->bindValue('weight', $this->getWeight());
            $product->bindValue('height', $this->getHeight());
            $product->bindValue('width', $this->getWidth());
            $product->bindValue('length', $this->getLength());

            if (!$product->execute()) {
                throw new Exception("Product Creation Failed");
            }

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Delete Product
    public function delete()
    {
        try {
            $this->startDB();

            $b = trim(implode(",", $this->getId()));

            $query = "DELETE FROM $this->table WHERE id IN ($b)";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            if (!$stmt->execute()) {
                throw new Exception("Something went wrong");
            }

            return true;

        } catch (\Throwable $th) {
            $response = [
                'message' => $th->getMessage()
            ];
            echo json_encode($response);
        }
    }

    // public function show()
    // {
    //     $query = 'SELECT * 
    //                 FROM 
    //                 ' . $this->table . ' 
    //                 WHERE id = ?';

    //     // statement
    //     $stmt = $this->conn->prepare($query);

    //     /* It's binding the parameter to the query. */
    //     $stmt->bindParam(1, $this->id);

    //     // execute
    //     $stmt->execute();

    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     $this->sku = $row['sku'];
    //     $this->product_name = $row['product_name'];
    //     $this->type = $row['type'];
    //     $this->size = $row['size'];
    //     $this->weight = $row['weight'];
    //     $this->height = $row['height'];
    //     $this->width = $row['width'];
    //     $this->length = $row['length'];
    //     $this->created_at = $row['created_at'];
    // }


    
}
