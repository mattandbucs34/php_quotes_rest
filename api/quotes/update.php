<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

  include_once '../../config/QuoteDB.php';
  include_once '../../models/Quote.php';

  //Instantiate DB && connect
  $database = new Database();
  $db = $database->connect();

  $quote = new Quote($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  //Set ID to update
  $quote->id = $data->id;

  $quote->quote = $data->quote;
  $quote->authorId = $data->authorId;
  $quote->category_id = $data->categoryId;

  //Update Quote
  if($quote->update()) {
    echo json_encode(
      array('message' => 'Quote Updated')
    );
  }else {
    echo json_encode(
      array('message' => 'Quote failed to update')
    );
  }

?>