<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/QuoteDB.php';
  include_once '../../models/Quote.php';

  //Instantiate DB and connect
  $database = new Database();
  $db = $database->connect();

  //Instantiate quote object
  $quote = new Quote($db);

  $quote->authorId = isset($_GET['authorId']) ? $_GET['authorId'] : NULL;
  $quote->category_id = isset($_GET['categoryId']) ? $_GET['categoryId'] : NULL;
  $quote->limit = isset($_GET['limit']) ? intval($_GET['limit']) : NULL;
  
  if($quote->authorId != NULL && $quote->authorId != 0 && $quote->category_id != NULL && $quote->category_id != 0) {
    $quote->quote_by_author_and_category();
    // include('../../index.php');
    header("Location: ../../?authorId=" . $quote->authorId . "&categoryId=" . $quote->category_id);
  }else if($quote->authorId != NULL && $quote->authorId != 0) {
    $quote->quote_by_author_id();
    header("Location: ../../?authorId=" . $quote->authorId);
  }else if($quote->category_id != NULL && $quote->category_id != 0) {
    $quote->quote_by_category_id();
    header("Location: ../../?categoryId=" . $quote->category_id);
  }else if($quote->limit != NULL && $quote->limit != 0) {
    $quote->quotes_limited();
    header("Location: ../../?limit=" .$quote->limit);
  }else{
    // $quote->read();
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
  }
?>