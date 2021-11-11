<?php
    // header  Access control 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
    // include files here 
    include_once '../../config/Database.php';
    include_once '../../models/comments.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate posts object 
    $comment = new Comments($db);

    // get posted data 
    $data = json_decode(file_get_contents("php://input"));

   $comment->comment =       $data->comment;
   $comment->status =        $data->status;
   $comment->user_id =       $data->user_id;
   $comment->post_id =       $data->post_id;
   $comment->create_at =     date("Y-m-d H:m:s");

    // create post
    if($comment->create()) {
        echo json_encode(
        array('message' => 'comment Created')
        );
    } else {
        echo json_encode(
        array('message' => 'comment Not Created')
        );
    }
?>



