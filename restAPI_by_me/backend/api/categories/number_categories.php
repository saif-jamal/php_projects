
<?php
// headers allow some access here in header
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json ");

// include the files of database and posts classes
include_once "../../config/Database.php";
include_once "../../models/categories.php";

//  Instantiate DB & connect
$database = new Database();
$db=$database->connect();

// Instantiate post object 
$categorie = new Categories($db);

// posts query call 
$data_result=$categorie->read();

// number of posts 
$numberOf_categorie=$data_result->rowCount();

// check if there a post 
if($numberOf_categorie >=0 ){
  

    // create object of arry that will show in browser as json data encode
     $categories_arry=array();
     $categories_item=array(
         "Number"=>$numberOf_categorie
     );
    
    // push this data to main object created before
    array_push($categories_arry,$categories_item);
 
        // encode this object as json file 
    // if($checkNew_data == $chcek_secondary)
       echo json_encode($categories_arry);

   

}else{
//   no posts  
 echo json_encode(
     array('message'=>'no users Found')
 );
}


 
?>





