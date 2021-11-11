<?php
    // headers allow some access here in header
    header("Access-Control-Allow-Origin: * ");
    header("Content-Type: application/json ");

    // include the files of database and posts classes
    include_once "../../config/Database.php";
    include_once "../../models/categories.php";

    // Instantiate db 
    $database= new Database();
    $db = $database->connect();
    
    // Instantiate user object 
    $categories = new Categories($db);

    // read data of users 
    $read_categories_data = $categories->read();

    // number of posts 
    $numberOf_categories=$read_categories_data->rowCount();
    
    // check if any data founded 
    if($numberOf_categories > 0){

    //  url data object 
     $data_array= array();

    // fetch data from database and pushed to as api url 
     while($categories_ = $read_categories_data->fetch(PDO::FETCH_ASSOC)){
           extract($categories_);
           $data_item =array(
                 'ID'=>$ID,
                 'title'=>$title,
                 'descriptions'=>$descriptions,
                 'status'=>$status,
                 'create_at'=>$create_at,
                 'update_at'=>$update_at
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