<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
  
  include_once '../../config/QuoteDB.php';
  include_once '../../models/Quote.php';
  
  //Instantiate DB && connect
  $database = new Database();
  $db = $database->connect();
  
  $quote = new Quote($db);

  $data = json_decode(file_get_contents("php://input"));

  $quote->quote = $data->quote;
  $quote->authorId = $data->authorId;
  $quote->categoryId = $data->categoryId;

  if($quote->create()) {
    echo json_encode(
      array('message' => 'Quote Created')
    );
  }else {
    echo json_encode(
      array('message' => 'Quote failed to create')
    );
  }
?>