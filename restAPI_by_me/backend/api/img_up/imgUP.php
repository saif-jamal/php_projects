<?php
   // header  Access control 
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Credentials: true');
   header('Access-Control-Max-Age: 86400');


 class imgUPloded{

   public $imgUP="";

  public function create(){
      // files of images that come from frontend
        
        if($_SERVER['REQUEST_METHOD']=="POST"){

            $files=$_FILES['image'];
            $filename=$files["name"];
            $$templocation=$files['tmp_name'];            
            $siplatedName=explode('.',$filename);
            $fileextention=strtolower(end($siplatedName));

            $new_file_name = uniqid().'.'.$fileextention;
            $fileDestination='../../images/'.$new_file_name;
            move_uploaded_file($_FILES["image"]["tmp_name"], $fileDestination);
                       
                     $this->imgUP=$fileDestination;

        }

             
            
  }

 }

     // Instantiate img object 
     $img__UPloaded = new imgUPloded();
     $img__UPloaded->create();

?>