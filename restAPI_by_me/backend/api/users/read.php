<?php
    // headers allow some access here in header
    header("Access-Control-Allow-Origin: * ");
    header("Content-Type: application/json ");

    // include the files of database and posts classes
    include_once "../../config/Database.php";
    include_once "../../models/users.php";

    // Instantiate db 
    $database= new Database();
    $db = $database->connect();
    
    // Instantiate user object 
    $user = new Users($db);

    // read data of users 
    $read_users_data = $user->read();

    // number of posts 
    $numberOf_users=$read_users_data->rowCount();
    
    // check if any data founded 
    if($numberOf_users > 0){

    //  url data object 
     $data_array= array();

    // fetch data from database and pushed to as api url 
     while($row = $read_users_data->fetch(PDO::FETCH_ASSOC)){
           extract($row);
           $data_item =array(
                 'ID'=>$ID,
                 'username'=>$username,
                 'email'=>$email,
                 'password'=>$password,
                 'status'=>$status,
                 'role'=>$role,
                 'create_at'=>$create_at,
                 'update_at'=>$update_at,
                 'image'=>$image,
                 'wallpaper'=>$wallpaper	
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