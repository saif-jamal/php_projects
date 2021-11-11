<?php
    // header  Access control 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
    // include files here 
    include_once '../../config/Database.php';
    include_once '../../models/posts.php';
    // include_once '../img_up/imgUP.php';


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate posts object 
    $post_insert = new Posts($db);



    // get posted data 
    $data = json_decode(file_get_contents("php://input"));

   $post_insert->postname =      $data->postname;
   $post_insert->descriptions =  $data->descriptions;
   $post_insert->image =         $data->image;
   $post_insert->user_id =       $data->user_id;
   $post_insert->categories_id = $data->categories_id;
   $post_insert->status =        $data->status;
   $post_insert->create_at =      date("Y-m-d H:m:s");



    // create post
    if($post_insert->create()) {
        echo json_encode(
        array('message' => 'Post Created')
        );
    } else {
        echo json_encode(
        array('message' => 'Post Not Created')
        );
    }
?>



