<?php
  class Database {
    private static $host = 'localhost';
    private static $db_name = 'quotesdb';
    private static $username = 'root';
    private static $password = 'YaZ5iaewp@z2GU5';
    private static $conn;

    public function connect() {
      $this->conn = null;

      try {
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }
?>