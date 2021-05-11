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

  $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

  //Get quote
  $quote->read_by_id();

  //create data array
  $quote_array = array(
    'id' => $quote->id,
    'quote' => $quote->quote,
    'author' => $quote->author,
    'categoryId' => $quote->categoryId,
    'category_name' => $quote->category_name
  );

  print_r(json_encode($quote_array));
?>