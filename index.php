<?php

  // header('Access-Control-Allow-Origin: *');
  // header('Content-Type: application/json');

  include_once './config/QuoteDB.php';
  include_once './models/Quote.php';
  include_once './models/Author.php';
  include_once './models/Category.php';


  //Instantiate DB and connect
  $database = new Database();
  $db = $database->connect();

  //Instantiate quote object
  $quote = new Quote($db);
  $author = new Author($db);
  $category = new Category($db);
  
  $quote->authorId = isset($_GET['authorId']) ? $_GET['authorId'] : NULL;
  $quote->category_id = isset($_GET['categoryId']) ? $_GET['categoryId'] : NULL;
  $quote->limit = isset($_GET['limit']) ? intval($_GET['limit']) : NULL;
  
  if($quote->authorId != NULL && $quote->authorId != 0 && $quote->category_id != NULL && $quote->category_id != 0) {
    $quotes = $quote->quote_by_author_and_category();
  }else if($quote->authorId != NULL && $quote->authorId != 0) {
    $quotes = $quote->quote_by_author_id();
  }else if($quote->category_id != NULL && $quote->category_id != 0) {
    $quotes = $quote->quote_by_category_id();
  }else if($quote->limit != NULL && $quote->limit != 0) {
    $quotes = $quote->quotes_limited();
  }else{
    $quotes = $quote->read();
    $authors = $author->read();
    $categories = $category->read();
  }
  $authors = $author->read();
  $categories = $category->read();
?>
<?php include('./views/header.php'); ?>
  <main>
    <?php include('./views/quotes.php'); ?>
  
  </main>

<?php include('./views/footer.php'); ?>