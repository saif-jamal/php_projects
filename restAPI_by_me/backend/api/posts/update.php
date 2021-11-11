<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/posts.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Posts($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $post->ID =            $data->ID;
  $post->postname =      $data->postname;
  $post->descriptions =  $data->descriptions;
  $post->image =         $data->image;
  $post->user_id =       $data->user_id;
  $post->categories_id = $data->categories_id;
  $post->status =        $data->status;
  $post->update_at =      date("Y-m-d H:m:s");



  // Update post
  if($post->update()) {
    echo json_encode(
      array('message' => 'Post Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Updated')
    );
  }

?>