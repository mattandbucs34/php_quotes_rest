<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/QuoteDB.php';
  include_once '../../models/Author.php';

  $database = new Database();
  $db = $database->connect();

  $author = new Author($db);

  $result = $author->read();

  $num = $result->rowCount();

  if($num > 0) {
    $authors_array = array();
    $authors_array['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $author_item = array(
        'id' => $id,
        'author' => $author
      );

      array_push($authors_array['data'], $author_item);
    }

    echo json_encode($authors_array);
  }else {
    echo json_encode(
      array('message' => 'No Authors Found.')
    );
  }
?>