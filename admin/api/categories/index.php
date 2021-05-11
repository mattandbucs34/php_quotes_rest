<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../../config/QuoteDB.php';
  include_once '../../../models/Category.php';

  $database = new Database();
  $db = $database->connect();

  $category = new Category($db);

  $result = $category->read();

  $num = $result->rowCount();

  if($num > 0) {
    $categories_array = array();
    $categories_array['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $category_item = array(
        'category_id' => $id,
        'category_name' => $category
      );
      array_push($categories_array['data'], $category_item);
    }

    echo json_encode($categories_array);
  }else {
    echo json_encode(
      array('message' => 'No Categories Found.')
    );
  }
?>