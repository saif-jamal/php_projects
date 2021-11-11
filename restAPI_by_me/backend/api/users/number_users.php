
<?php
// headers allow some access here in header
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json ");

// include the files of database and posts classes
include_once "../../config/Database.php";
include_once "../../models/users.php";

//  Instantiate DB & connect
$database = new Database();
$db=$database->connect();

// Instantiate post object 
$user = new Users($db);

// posts query call 
$data_result=$user->read();

// number of posts 
$numberOf_user=$data_result->rowCount();

// check if there a post 
if($numberOf_user >=0 ){
  

    // create object of arry that will show in browser as json data encode
     $users_arry=array();
     $users_item=array(
         "Number"=>$numberOf_user
     );
    
    // push this data to main object created before
    array_push($users_arry,$users_item);
 
        // encode this object as json file 
    // if($checkNew_data == $chcek_secondary)
       echo json_encode($users_arry);

   

}else{
//   no posts  
 echo json_encode(
     array('message'=>'no users Found')
 );
}


 
?>





