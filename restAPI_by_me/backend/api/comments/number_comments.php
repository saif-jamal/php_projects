
<?php
// headers allow some access here in header
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json ");

// include the files of database and posts classes
include_once "../../config/Database.php";
include_once "../../models/comments.php";

//  Instantiate DB & connect
$database = new Database();
$db=$database->connect();

// Instantiate post object 
$comment = new Comments($db);

// posts query call 
$data_result=$comment->read();

// number of posts 
$numberOf_comment=$data_result->rowCount();

// check if there a post 
if($numberOf_comment >=0 ){
  

    // create object of arry that will show in browser as json data encode
     $comments_arry=array();
     $comments_item=array(
         "Number"=>$numberOf_comment
     );
    
    // push this data to main object created before
    array_push($comments_arry,$comments_item);
 
        // encode this object as json file 
    // if($checkNew_data == $chcek_secondary)
       echo json_encode($comments_arry);

   

}else{
//   no posts  
 echo json_encode(
     array('message'=>'no users Found')
 );
}


 
?>





