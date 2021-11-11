<?php
    // header  Access control 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
    // include files here 
    include_once '../../config/Database.php';
    include_once '../../models/categories.php';

    // Instantiate db 
    $database=new Database();
    $db= $database->connect();

    // Instantiate user & post object
    $categorie = new Categories($db);

    // get data from user in from 
    $get_dataInput=json_decode(file_get_contents("php://input"));
    
    $categorie->title = $get_dataInput->title;
    $categorie->descriptions= $get_dataInput->descriptions;
    $categorie->status= $get_dataInput->status;
    $categorie->create_at=  date("Y-m-d H:m:s");

    if( $categorie->create($categorie->read())){
        echo json_encode(array(
            'message'=>'categorie Added successfully'
        ));
    }else{
        echo json_encode(array(
            'message'=>'categorie not Added'
        ));
    }



?>