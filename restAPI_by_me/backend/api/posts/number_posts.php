
<?php
// headers allow some access here in header
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json ");

// include the files of database and posts classes
include_once "../../config/Database.php";
include_once "../../models/posts.php";

//  Instantiate DB & connect
$database = new Database();
$db=$database->connect();

// Instantiate post object 
$posts = new Posts($db);

// posts query call 
$data_result=$posts->read();

// number of posts 
$numberOf_Posts=$data_result->rowCount();

// check if there a post 
if($numberOf_Posts >=0 ){
  

    // create object of arry that will show in browser as json data encode
     $posts_arry=array();
     $post_item=array(
         "Number"=>$numberOf_Posts
     );
    
    // push this data to main object created before
    array_push($posts_arry,$post_item);
 
        // encode this object as json file 
    // if($checkNew_data == $chcek_secondary)
       echo json_encode($posts_arry);

   

}else{
//   no posts  
 echo json_encode(
     array('message'=>'no posts Found')
 );
}


 
?>





