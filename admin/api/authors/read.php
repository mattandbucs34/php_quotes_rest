<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../../config/QuoteDB.php';
  include_once '../../../models/Author.php';

  $database = new Database();
  $db = $database->connect();

  $author = new Author($db);
