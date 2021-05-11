<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
  
  include_once '../../../config/QuoteDB.php';
  include_once '../../../models/Author.php';
  
  //Instantiate DB && connect
  $database = new Database();
  $db = $database->connect();
  
  $author = new Author($db);

  $data = json_decode(file_get_contents("php://input"));

  $author->author = $data ? $data->author : filter_input(INPUT_POST, 'author');
  // $quote->authorId = $data->authorId;
  // $quote->categoryId = $data->categoryId;

  if($author->create()) {
    if($data != NULL) {
      echo json_encode(
        array('message' => 'Author Created')
      );
    }else {
      header("Location: ../../?action=manage_authors&author_added=TRUE#authors-tab");
    }
  }else {
    if($data != NULL) {
      echo json_encode(
        array('message' => 'Author failed to create')
      );
      header("Location: ../../?action=manage_authors&author_added=FALSE#authors-tab");
    }
  }
