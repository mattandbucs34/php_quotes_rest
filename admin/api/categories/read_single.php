<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../../config/QuoteDB.php';
  include_once '../../../models/Category.php';

  $database = new Database();
  $db = $database->connect();

  $category = new Category($db);

  $category->category_id = isset($_GET['id']) ? $_GET['id'] : die();

  $category->read_single();

  $category_array = array(
    'category_id' => $category->category_id,
    'category_name' => $category->category_name
  );

  print_r(json_encode($category_array));

?>