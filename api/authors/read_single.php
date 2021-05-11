<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/QuoteDB.php';
  include_once '../../models/Author.php';

  $database = new Database();
  $db = $database->connect();

  $author = new Author($db);

  $author->id = isset($_GET['id']) ? $_GET['id'] : die();

  $author->read_single();

  $author_array = array(
    'id' => $author->id,
    'author' => $author->author
  );

  print_r(json_encode($author_array));

?>