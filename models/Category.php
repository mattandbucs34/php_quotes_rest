<?php
  class Category {
    private $conn;
    private $table = 'categories';

    public $category_id;
    public $category_name;

    public function __construct($db) {
      $this->conn = $db;
    }

    public function read() {
      $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id';
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt;
    }

    public function read_single() {
      $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':id', $this->category_id);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->category_id = $row['id'];
      $this->category_name = $row['category'];
    }

    public function create() {
      $query = 'INSERT INTO ' . $this->table . ' SET
        category = :category
      ';

      $stmt = $this->conn->prepare($query);
      $this->category = htmlspecialchars(strip_tags($this->category_name));

      $stmt->bindParam(':category', $this->category_name);

      if($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    public function delete() {
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(':id', $this->category_id);

      if($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    public function update() {
      $query = 'UPDATE ' . $this->table . ' SET category = :category WHERE id = :id';
      $stmt = $this->conn->prepare($query);

      $this->category_name = htmlspecialchars(strip_tags($this->category_name));
      $this->category_id = htmlspecialchars(strip_tags($this->category_id));

      $stmt->bindParam(':id', $this->category_id);
      $stmt->bindParam(':category', $this->category_name);

      if($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);
      return false;
    }
  }

?>