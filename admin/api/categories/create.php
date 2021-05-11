<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
  
  include_once '../../../config/QuoteDB.php';
  include_once '../../../models/Category.php';
  
  //Instantiate DB && connect
  $database = new Database();
  $db = $database->connect();
  
  $category = new Category($db);

  $data = json_decode(file_get_contents("php://input"));

  $category->category_name = $data ? $data->category : filter_input(INPUT_POST, 'category');
  // $quote->authorId = $data->authorId;
  // $quote->categoryId = $data->categoryId;

  if($category->create()) {
    if($data != NULL) {
      echo json_encode(
        array('message' => 'Category Created')
      );
    }else {
      header("Location: ../../?action=manage_categories&category_added=TRUE#categories-tab");
    }
  }else {
    if($data != NULL) {
      echo json_encode(
        array('message' => 'Category failed to create')
      );
    }else {
      header("Location: ../../?action=manage_categories&category_added=FALSE#categories-tab");
    }
  }
  