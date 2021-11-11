<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/comments.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $comment_ = new Comments($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $comment_->ID =            $data->ID;
  $comment_->comment =       $data->comment;
  $comment_->status =        $data->status;
  // $comment_->user_id =       $data->user_id;
  // $comment_->post_id =       $data->post_id;
  $comment_->update_at =      date("Y-m-d H:m:s");



  // Update post
  if($comment_->update()) {
    echo json_encode(
      array('message' => 'Comment Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Comment Not Updated')
    );
  }

?>