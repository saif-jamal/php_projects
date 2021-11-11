<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/comments.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $comment = new Comments($db);

  // Get raw user__ed data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $comment->ID = $data->ID;

  // Delete comment
  if($comment->delete()) {
    echo json_encode(
      array('message' => 'Your comments is  Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'unseccessful Deleted')
    );
  }

?>