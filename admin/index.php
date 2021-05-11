<?php

  // header('Access-Control-Allow-Origin: *');
  // header('Content-Type: application/json');

  include_once '../config/QuoteDB.php';
  include_once '../models/Quote.php';
  include_once '../models/Author.php';
  include_once '../models/Category.php';


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

  $action = filter_input(INPUT_GET, 'action');
  if($action == NULL) {
    $action = 'home';
  }

  $quote_add = filter_input(INPUT_GET, 'quote_add', FILTER_VALIDATE_BOOLEAN);
  $author_added = filter_input(INPUT_GET, 'author_added', FILTER_VALIDATE_BOOLEAN);
  $category_added = filter_input(INPUT_GET, 'category_added', FILTER_VALIDATE_BOOLEAN);
  $quote_updated = filter_input(INPUT_GET, 'quote_updated', FILTER_VALIDATE_BOOLEAN);
  $author_updated = filter_input(INPUT_GET, 'author_updated', FILTER_VALIDATE_BOOLEAN);
  $category_updated = filter_input(INPUT_GET, 'category_updated', FILTER_VALIDATE_BOOLEAN);
  $delete_success = filter_input(INPUT_GET, 'delete_success', FILTER_VALIDATE_BOOLEAN);

  if(isset($delete_success)) {
    if($delete_success == TRUE) {
      $message = 'Successfully deleted!';
    }else if($delete_success == FALSE) {
      $error = 'There was an issue processing your request. Please try again.';
    }
  }
  
  if(isset($quote_add)) {
    if($quote_add == TRUE) {
      $message = 'Quote added successfully!';
    }else if($quote_add == FALSE) {
      $error = 'Quote failed to add. Please try again.';
    }
  }

  if(isset($author_added)) {
    if($author_added == TRUE) {
      $message = 'Author added successfully!';
    }else if($author_added == FALSE) {
      $error = 'Adding the author failed. Please try again.';
    }
  }

  if(isset($category_added)) {
    if($category_added == TRUE) {
      $message = 'Category added successfully!';
    }else if($category_added == FALSE) {
      $error = 'Adding the category failed. Please try again.';
    }
  }

  if(isset($quote_updated)) {
    if($quote_updated == TRUE) {
      $message = "Quote updated successfully!";
    }else if($quote_updated == FALSE) {
      $error = "Quote failed to update. Please try again.";
    }
  }

  if(isset($author_updated)) {
    if($author_updated == TRUE) {
      $message = "Author updated successfully!";
    }else if($author_updated == FALSE) {
      $error = "Author failed to update. Please try again.";
    }
  }

  if(isset($category_updated)) {
    if($category_updated == TRUE) {
      $message = "Category updated successfully!";
    }else if($category_updated == FALSE) {
      $error = "Category failed to update. Please try again.";
    }
  }


  if($action == 'delete_quote') {
    if(isset($_GET['id'])) {
      $quote->id = $_GET['id'];
      if($quote->delete()) {
        header("Location: ./?delete_success=TRUE#quotes-tab");
      }else {
        $error = "There was an issue processing your request.";  
        header("Location: ./?delete_success=FALSE#quotes-tab");
      }
    }else {
      $error = "There was an issue processing your request.";
      header("Location: ./?delete_success=FALSE#quotes-tab");
    }
  }else if($action == 'delete_author') {
    if(isset($_GET['id'])) {
      $author->id = $_GET['id'];
      if($author->delete()) {
        header("Location: ./?action=manage_authors&delete_success=TRUE#authors-tab");
      }else {
        $error = "There was an issue processing your request.";  
        header("Location: ./?action=manage_authors&delete_success=FALSE#authors-tab");
      }
    }else {
      $error = "There was an issue processing your request.";
      header("Location: ./?manage_authors&delete_success=FALSE#authors-tab");
    }
  }else if($action == 'delete_category') {
    if(isset($_GET['id'])) {
      $category->category_id = $_GET['id'];
      if($category->delete()) {
        header("Location: ./?action=manage_categories&delete_success=TRUE#categories-tab");
      }else {
        $error = "There was an issue processing your request.";  
        header("Location: ./?action=manage_categories&delete_success=FALSE#categories-tab");
      }
    }else {
      $error = "There was an issue processing your request.";
      header("Location: ./?manage_authors&delete_success=FALSE#authors-tab");
    }
  }else if($action == 'edit_quote') {
    if(isset($_GET['id'])) {
      $quote->id = $_GET['id'];
      $quote->read_by_id();
    }else {
      $error = "There was an error processing your request.";
    }
    $authors = $author->read();
    $categories = $category->read();
    include('./views/edit_quote.php');
  }else if ($action == 'edit_author') {
    if(isset($_GET['id'])) {
      $author->id = $_GET['id'];
      $author->read_single();
    }
    include('./views/edit_author.php');
  }else if ($action == 'edit_category') {
    if(isset($_GET['id'])) {
      $category->category_id = $_GET['id'];
      $category->read_single();
    }
    include('./views/edit_category.php');
  }else if($action == 'add_quote') {
    $authors = $author->read();
    $categories = $category->read();
    include('./views/add_quote.php');
  }else if($action == 'add_author') {
    include('./views/add_author.php');
  }else if($action == 'manage_authors') {
    $authors = $author->read();
    include('./views/authors.php');
  }else if($action == 'manage_categories') {
    $categories = $category->read();
    include('./views/categories.php');
  }else if($action == 'add_category') {
    include('./views/add_category.php');
  }else if ($action == 'home') {
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
    include('./views/quotes.php');
  }
  
  
?>
<?php 
  // include('./views/header.php'); 
  ?>
  <!-- <main> -->
    <?php 
    // include('./views/quotes.php'); 
    ?>
  
  <!-- </main> -->

<?php 
// include('./views/footer.php'); 
?>