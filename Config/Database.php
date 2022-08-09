<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'ecom-test';
    private $username = 'root';
    private $password = '';
    private $conn;

    
   /**
    * This function creates a connection to the database and returns the connection object.
    * 
    * @return The connection to the database.
    */
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }
  
?>