<?php
  class Quote {
    //DB information
    private $conn;
    private $table = 'quotes';

    //Quote properties
    public $id;
    public $quote;
    public $author;
    public $authorId;
    public $category_id;
    public $category_name;
    public $limit;
    // public $created_at;

    public function __construct($db){
      $this->conn = $db;
    }

    public function read() {
      $query = 'SELECT a.author as author, c.category as category_name, q.id, q.categoryId, q.quote, q.authorId
        FROM ' . $this->table . ' q
        LEFT JOIN
          categories c ON q.categoryId = c.id
        LEFT JOIN
          authors a ON q.authorId = a.id
      ';

      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt;
    }

    public function read_by_id() {
      $query = 'SELECT a.author as author, c.category as category_name, q.id, q.categoryId, q.quote, q.authorId
        FROM ' . $this->table . ' q
        LEFT JOIN
          categories c ON q.categoryId = c.id
        LEFT JOIN
          authors a ON q.authorId = a.id
        WHERE q.id = ?
        LIMIT 0,1
      ';

      $stmt = $this->conn ->prepare($query);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->quote = $row['quote'];
      $this->author = $row['author'];
      $this->authorId = $row['authorId'];
      $this->category_id = $row['categoryId'];
      $this->category_name = $row['category_name'];
    }

    public function quote_by_author_and_category() {
      $query = 'SELECT a.author as author, c.category as category_name, q.id, q.categoryId, q.quote, q.authorID FROM ' . $this->table . ' q LEFT JOIN categories c ON q.categoryId = c.id LEFT JOIN authors a ON q.authorId = a.id WHERE a.id = :authorId AND c.id = :categoryId';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':authorId', $this->authorId);
      $stmt->bindParam(':categoryId', $this->category_id);
      $stmt->execute();
      // $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // $this->quote = $row['quote'];
      // $this->author = $row['author'];
      // $this->categoryId = $row['categoryId'];
      // $this->category_name = $row['category_name'];
      return $stmt;
    }

    public function quote_by_author_id() {
      $query = 'SELECT a.author as author, c.category as category_name, q.id, q.categoryId, q.quote, q.authorID FROM ' . $this->table . ' q LEFT JOIN categories c ON q.categoryId = c.id LEFT JOIN authors a ON q.authorId = a.id WHERE a.id = :authorId';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':authorId', $this->authorId);
      $stmt->execute();
      // $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // $this->quote = $row['quote'];
      // $this->author = $row['author'];
      // $this->categoryId = $row['categoryId'];
      // $this->category_name = $row['category_name'];
      return $stmt;
    }

    public function quote_by_category_id() {
      $query = 'SELECT a.author as author, c.category as category_name, q.id, q.categoryId, q.quote, q.authorID FROM ' . $this->table . ' q LEFT JOIN categories c ON q.categoryId = c.id LEFT JOIN authors a ON q.authorId = a.id WHERE c.id = :categoryId';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':categoryId', $this->category_id);
      $stmt->execute();
      // $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // $this->quote = $row['quote'];
      // $this->author = $row['author'];
      // $this->categoryId = $row['categoryId'];
      // $this->category_name = $row['category_name'];
      return $stmt;
    }

    public function quotes_limited() {
      $query = 'SELECT a.author as author, c.category as category_name, q.id, q.categoryId, q.quote, q.authorID FROM ' . $this->table . ' q LEFT JOIN categories c ON q.categoryId = c.id LEFT JOIN authors a ON q.authorId = a.id LIMIT 0,:limited';
      // $query = 'SELECT * FROM (SELECT * FROM quotes LIMIT 0, :limited) q LEFT JOIN categories c ON q.categoryId = c.id LEFT JOIN authors a ON q.authorId = a.id';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(":limited", $this->limit, PDO::PARAM_INT);
      $stmt->execute();
      // $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // $this->quote = $row['quote'];
      // $this->author = $row['author'];
      // $this->categoryId = $row['categoryId'];
      // $this->category_name = $row['category'];
      return $stmt;
    }

    public function create() {
      $query = 'INSERT INTO ' . $this->table . ' SET
        quote = :quote,
        authorId = :authorId,
        categoryId = :category_id
      ';

      $stmt = $this->conn->prepare($query);
      $this->quote = htmlspecialchars(strip_tags($this->quote));
      $this->authorId = $this->authorId;
      $this->categoryId = $this->categoryId;

      $stmt->bindParam(':quote', $this->quote);
      $stmt->bindParam(':authorId', $this->authorId);
      $stmt->bindParam(':category_id', $this->categoryId);

      if($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    public function delete() {
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(':id', $this->id);

      if($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    public function update() {
      $query = 'UPDATE ' . $this->table . '
        SET
          quote = :quote,
          authorId = :authorId,
          categoryId = :categoryId
        WHERE
          id = :id
      ';

      $stmt = $this->conn->prepare($query);
      $this->quote = htmlspecialchars(strip_tags($this->quote));
      
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':quote', $this->quote);
      $stmt->bindParam(':authorId', $this->authorId);
      $stmt->bindParam(':categoryId', $this->category_id);

      if($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);
      return false;
    }

  }//end of class


?>