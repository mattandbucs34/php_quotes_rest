<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

  include_once '../../../config/QuoteDB.php';
  include_once '../../../models/Quote.php';

  //Instantiate DB && connect
  $database = new Database();
  $db = $database->connect();

  $quote = new Quote($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  //Set ID to update
  $quote->id = $data ? $data->id : filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

  $quote->quote = $data ? $data->quote : filter_input(INPUT_POST, 'quote');
  $quote->authorId = $data ? $data->authorId : filter_input(INPUT_POST, 'authorId', FILTER_VALIDATE_INT);
  $quote->category_id = $data ? $data->categoryId : filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);
print_r("Line 26: " . $quote->quote);
  //Update Quote
  if($quote->update()) {
    if($data != NULL) {
      echo json_encode(
        array('message' => 'Quote Updated')
      );
    }else {
      header("Location: ../../?home&quote_updated=TRUE#quotes-tab");
    }
  }else {
    if($data != NULL) {
      echo json_encode(
        array('message' => 'Quote failed to update')
      );
    }else {
      header("Location: ../../?home&quote_updated=FALSE#quotes-tab");
    }
  }

?>