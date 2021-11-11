
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
  
    // that's means we founded Posts ^-^

    // create object of arry that will show in browser as json data encode
     $posts_arry=array();

    // check if new update to the data had been added
    // $checkNew_data=0;
    // $chcek_secondary=0;
    
    // fetch all data 
    while($res = $data_result->fetch(PDO::FETCH_ASSOC)){
        extract($res);
        $post_item=array(
            'ID'=>$ID,
            'postname'=>$postname,
            'descriptions'=>$descriptions,
            'postImage'=>$postImage,
            'user_id'=>$user_id,
            'categories_id'=>$categories_id,
            'userStatus'=>$userStatus,
            'create_at'=>$create_at,
            'update_at'=>$update_at,
            'username'=>$username,
            'userImage'=>$userImage,
            'categorie_title'=>$categorie_title,
            'role'=>$role,
            'wallpaper'=>$wallpaper	
           
        );

        // push this data to main object created before
        array_push($posts_arry,$post_item);
        // $chcek_secondary++;
        

    }
   
    
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





