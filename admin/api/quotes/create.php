<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
  
  include_once '../../../config/QuoteDB.php';
  include_once '../../../models/Quote.php';
  
  //Instantiate DB && connect
  $database = new Database();
  $db = $database->connect();
  
  $quote = new Quote($db);
  
  $data = json_decode(file_get_contents("php://input"));
  
  $quote->quote = $data ? $data->quote : filter_input(INPUT_POST, 'quote');
  $quote->authorId = $data ? $data->authorId : filter_input(INPUT_POST, 'authorId', FILTER_VALIDATE_INT);
  $quote->categoryId = $data ? $data->categoryId : filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);
  print_r("Line 21: " . $quote->category_id);

  if(!isset($quote->authorId) || $quote->authorId == 0 || !isset($quote->category_id) || $quote->category_id ==0) {
    header("Location: ../../?action=add&quote_add=FALSE");
  }
  
  if($quote->create()) {
    if($data != NULL) {
      echo json_encode(
        array('message' => 'Quote Created')
      );
    }else {
      header("Location: ../../?quote_add=TRUE");
    }

  }else {
    if($data != NULL) {
      echo json_encode(
        array('message' => 'Quote failed to create')
      );
    }else {
      header("Location: ../../?action=add&quote_add=FALSE");
    }
  }
?>