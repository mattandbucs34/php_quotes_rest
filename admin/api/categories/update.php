<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

  include_once '../../../config/QuoteDB.php';
  include_once '../../../models/Category.php';

  //Instantiate DB && connect
  $database = new Database();
  $db = $database->connect();

  $category = new Category($db);

  //Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  //Set ID to update
  $category->category_id = $data ? $data->id : filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

  $category->category_name = $data ? $data->category : filter_input(INPUT_POST, 'category');

  //Update Category
  if($category->update()) {
    if($data != NULL) {
      echo json_encode(
        array('message' => 'Category Updated')
      );
    }else {
      header("Location: ../../?action=manage_categories&category_updated=TRUE#categories-tab");
    }
  }else {
    if($data != NULL) {
      echo json_encode(
        array('message' => 'Author failed to create')
      );
      header("Location: ../../?action=manage_categories&category_updated=FALSE#categories-tab");
    }
  }

?>