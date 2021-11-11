<?php
    // headers allow some access here in header
    header("Access-Control-Allow-Origin: * ");
    header("Content-Type: application/json ");

    // include the files of database and posts classes
    include_once "../../config/Database.php";
    include_once "../../models/comments.php";

    // Instantiate db 
    $database= new Database();
    $db = $database->connect();
    
    // Instantiate user object 
    $comment = new Comments($db);

    // read data of users 
    $read_comments_data = $comment->read();

    // number of posts 
    $numberOf_comments=$read_comments_data->rowCount();
    
    // check if any data founded 
    if($numberOf_comments > 0){

    //  url data object 
     $data_array= array();

    // fetch data from database and pushed to as api url 
     while($comment_ = $read_comments_data->fetch(PDO::FETCH_ASSOC)){
           extract($comment_);
           $data_item =array(
                 'ID'=>$ID,
                 'comment'=>$comment,
                 'status'=>$status,
                 'user_id'=>$user_id,
                 'post_id'=>$post_id,
                 'create_at'=>$create_at,
                 'update_at'=>$update_at,
                 'username'=>$username,
                 'userImage'=>$userImage,
                 'useremail'=>$useremail,
                 'postname'=>$postname
           );

        //    push item to global object 
        array_push($data_array,$data_item);
     }
     echo json_encode($data_array);

    }else{
        echo json_encode(array(
          'message'=>'No Users Fonded'
        ));
    }



?>