<?php
    // header  Access control 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
    // include files here 
    include_once '../../config/Database.php';
    include_once '../../models/users.php';

    // Instantiate db 
    $database=new Database();
    $db= $database->connect();

    // Instantiate user & post object
    $admin__=new Users($db);

    // get data from user in from 
    $get_dataInput=json_decode(file_get_contents("php://input"));
    
    $admin__->username = $get_dataInput->username;
    $admin__->email= $get_dataInput->email;
    $admin__->password= $get_dataInput->password;
    $admin__->status= $get_dataInput->status;
    $admin__->role= "admin";
    $admin__->create_at=  date("Y-m-d H:m:s");
    $admin__->image= $get_dataInput->image;

    if( $admin__->create_admin($admin__->read())){
        echo json_encode(array(
            'message'=>'Admin Added successfully'
        ));
    }else{
        echo json_encode(array(
            'message'=>'Admin not Added'
        ));
    }



?>