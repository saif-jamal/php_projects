<?php

// header  Access control 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    // include files here 
    include_once '../../config/Database.php';

    // Instantiate db 
    $database=new Database();
    $db= $database->connect();
    
    $statment=$db->prepare("SELECT u.username,u.image as userImage,u.email as Useremail, u.password as Userpassword FROM users u where role='admin' ;");
    $statment->execute();
    $numberusers= $statment->rowCount();

    if($numberusers>0){
         $checkmax=0;
        // get data from user in from 
         $get_dataInput=json_decode(file_get_contents("php://input"));
          
         while($data=$statment->fetch(PDO::FETCH_ASSOC)){
              extract($data);
              $checkmax++;
              if($get_dataInput->email==$Useremail && $get_dataInput->password==$Userpassword){
                echo json_encode(array(
                    "username"=>$username,
                    "image"=>$userImage,
                    "email"=>$Useremail,
                    'message'=>"it's admin"
                ));
                break;
              }else{
                  if($checkmax==$numberusers)
                        echo json_encode(array(
                            'message'=>"You not allow to login here"
                        ));
              }
         }

    }else{
        echo json_encode(array(
                    'message'=>'not admin'
                ));
    }




?>