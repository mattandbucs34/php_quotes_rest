<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../../config/QuoteDB.php';
  include_once '../../../models/Quote.php';

  //Instantiate DB and connect
  $database = new Database();
  $db = $database->connect();

  //Instantiate quote object
  $quote = new Quote($db);

  //Query quotes database
  $result = $quote->read();
  //get row count for validation of results
  $num = $result->rowCount();
  //check if quotes exist
  if($num > 0) {
    //initialize array for quotes
    $quotes_array = array();
    $quotes_array['data'] = array(); //stores data

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $quote_item = array(
        'id' => $id,
        'quote' => html_entity_decode($quote),
        'authorId' => $authorId,
        'author' => $author,
        'categoryId' => $categoryId,
        'category' => $category_name
      );

      array_push($quotes_array['data'], $quote_item);
    }
    echo json_encode($quotes_array);
  }else {
    echo json_encode(
      array(
        'message' => 'There are no quotes'
      )
    );
  }
?>