<?php
    // header  Access control 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
    // include files here 
    include_once '../../config/Database.php';
    include_once '../../models/users.php';

    // Instantiate db 
    $database=new Database();
    $db= $database->connect();

    // Instantiate user & post object
    $user__=new Users($db);

    // get data from user in from 
    $get_dataInput=json_decode(file_get_contents("php://input"));

    $user__->ID = $get_dataInput->ID;
    $user__->username = $get_dataInput->username;
    $user__->email= $get_dataInput->email;
    $user__->password= $get_dataInput->password;
    $user__->status= $get_dataInput->status;
    $user__->role= "user";
    $user__->update_at=  date("Y-m-d H:m:s");
    $user__->image= $get_dataInput->image;

    if( $user__->update_user($user__->read())){
        echo json_encode(array(
            'message'=>'user Updated successfully'
        ));
    }else{
        echo json_encode(array(
            'message'=>'user not Updated'
        ));
    }



?>