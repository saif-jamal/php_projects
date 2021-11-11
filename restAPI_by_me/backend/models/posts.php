<?php
// posts class here  

class Posts{
    // database stuf here 
    private $conn;
    private $table="posts";


    // posts properties 
    public $ID;
    public $postname;
    public $descriptions;
    public $image;
    public $user_id;
    public $categories_id;
    public $status;
    public $create_at;
    public $update_at;

    // user of post properties
    public $username;
    public $userImage;

    //categories of post  properties
    public $categorieTitle;

    // get database connections by constructor 
    public function __construct($db){
        $this->conn=$db;
    }


    // so here will create << crud >> for any table 
    // crud means 1-creat 2-read 3-update 4-delete 

    // read data from api 
    public function read(){

        // create query 
        $query="SELECT p.ID,p.postname,p.descriptions,p.image as postImage,p.user_id,p.categories_id,p.create_at,p.update_at,p.status as userStatus
                      ,u.username,u.image as userImage,u.role,u.wallpaper
                      ,c.title as categorie_title FROM ( ( {$this->table} p
                      inner join users u on p.user_id = u.ID)
                      inner join categories c on p.categories_id = c.ID )
                      order by p.create_at desc;";
        
        // prepare my query 
        $statment =$this->conn->prepare($query);

        // execute my query 
        $statment->execute();

        // finshed read and return data final step
        return $statment;

    }


    // creade data in database and insert intoapi 
    public function create(){
        // query    "INSERT INTO {$this->table} (postname,descriptions,'image','user_id',categories_id,'status',create_at) VALUES(:postname,:descriptions,:postImage,:user_id,:categories_id,:status,:create_at) 
        $query = "INSERT INTO {$this->table}
        SET postname = :postname , descriptions=:descriptions, image=:image , user_id=:user_id , categories_id = :categories_id , status=:status ,create_at=:create_at ;";
        
        // preapare query 
        $statmentC=$this->conn->prepare($query);

        // clean data
        $this->ID = htmlspecialchars(strip_tags($this->ID));
        $this->postname = htmlspecialchars(strip_tags($this->postname));
        $this->descriptions = htmlspecialchars(strip_tags($this->descriptions));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->categories_id = htmlspecialchars(strip_tags($this->categories_id));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->create_at = htmlspecialchars(strip_tags($this->create_at));
        $this->update_at = htmlspecialchars(strip_tags($this->update_at));
        
        // bind data 
        $statmentC->bindParam(':postname',$this->postname);
        $statmentC->bindParam(':descriptions',$this->descriptions);
        $statmentC->bindParam(':image',$this->image);
        $statmentC->bindParam(':user_id',$this->user_id);
        $statmentC->bindParam(':categories_id',$this->categories_id);
        $statmentC->bindParam(':status',$this->status);
        $statmentC->bindParam(':create_at',$this->create_at);
        // $statmentC->bindParam(':update_at',$this->update_at);

        // execute query 
        if($statmentC->execute()) {
            return true;
      }

        // Print error if something goes wrong
        printf("Error: %s.\n", $statmentC->error);
        return false;
    

    }
     
    // update row with new data
    public function update(){

        // Create query
        $query = 'UPDATE ' . $this->table . '
        SET postname=:postname,descriptions=:descriptions,image=:image,user_id=:user_id,categories_id=:categories_id,status=:status,update_at=:update_at
        WHERE ID = :ID';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->ID = htmlspecialchars(strip_tags($this->ID));
        $this->postname = htmlspecialchars(strip_tags($this->postname));
        $this->descriptions = htmlspecialchars(strip_tags($this->descriptions));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->categories_id = htmlspecialchars(strip_tags($this->categories_id));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->create_at = htmlspecialchars(strip_tags($this->create_at));
        $this->update_at = htmlspecialchars(strip_tags($this->update_at));

        // Bind data
        $stmt->bindParam(':postname',$this->postname);
        $stmt->bindParam(':descriptions',$this->descriptions);
        $stmt->bindParam(':image',$this->image);
        $stmt->bindParam(':user_id',$this->user_id);
        $stmt->bindParam(':categories_id',$this->categories_id);
        $stmt->bindParam(':status',$this->status);
        $stmt->bindParam(':update_at',$this->update_at);
        $stmt->bindParam(':ID', $this->ID);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // delete row of data 
    public function delete(){
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE ID = :ID';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        // Bind data
        $stmt->bindParam(':ID', $this->ID);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
        

}


?>

