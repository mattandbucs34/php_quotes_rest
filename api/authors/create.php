<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
  
  include_once '../../config/QuoteDB.php';
  include_once '../../models/Author.php';
  
  //Instantiate DB && connect
  $database = new Database();
  $db = $database->connect();
  
  $author = new Author($db);

  $data = json_decode(file_get_contents("php://input"));

  $author->author = $data->author;
  // $quote->authorId = $data->authorId;
  // $quote->categoryId = $data->categoryId;

  if($author->create()) {
    echo json_encode(
      array('message' => 'Author Created')
    );
  }else {
    echo json_encode(
      array('message' => 'Author failed to create')
    );
  }
