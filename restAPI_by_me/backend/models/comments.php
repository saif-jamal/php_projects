<?php
    //  class comments 
    class Comments{

        // private data 
        private $conn;
        private $table="comments";

        // public data 
        public $ID;
        public $comment;
        public $status;
        public $user_id;
        public $post_id;
        public $create_at;
        public $update_at;

        // user of post properties
        public $username;
        public $userImage;

        //post name 
        public $postname;

        // get database connections by constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //read comments
        public function read(){
          
            // create query 
            $query="SELECT p.postname
            ,u.username,u.image as userImage,u.email as useremail
            ,c.ID,c.comment,c.status,c.user_id,c.post_id,c.create_at,c.update_at  FROM ( ( {$this->table} c
            inner join users u on c.user_id = u.ID)
            inner join posts p on c.post_id = p.ID )
            order by c.create_at desc;";

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
            SET comment = :comment , status=:status  , user_id=:user_id ,post_id=:post_id,create_at=:create_at ;";
            
            // preapare query 
            $statmentC=$this->conn->prepare($query);

            // clean data
            $this->ID = htmlspecialchars(strip_tags($this->ID));
            $this->comment = htmlspecialchars(strip_tags($this->comment));
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $this->post_id = htmlspecialchars(strip_tags($this->post_id));
            $this->create_at = htmlspecialchars(strip_tags($this->create_at));
            $this->update_at = htmlspecialchars(strip_tags($this->update_at));
            
            // bind data 
            $statmentC->bindParam(':comment',$this->comment);
            $statmentC->bindParam(':status',$this->status);
            $statmentC->bindParam(':user_id',$this->user_id);
            $statmentC->bindParam(':post_id',$this->post_id);
            $statmentC->bindParam(':create_at',$this->create_at);

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
            SET comment = :comment , status=:status  , update_at=:update_at
            WHERE ID = :ID ;';

            // preapare query 
            $statmentC=$this->conn->prepare($query);

            // clean data
            $this->ID = htmlspecialchars(strip_tags($this->ID));
            $this->comment = htmlspecialchars(strip_tags($this->comment));
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $this->post_id = htmlspecialchars(strip_tags($this->post_id));
            $this->create_at = htmlspecialchars(strip_tags($this->create_at));
            $this->update_at = htmlspecialchars(strip_tags($this->update_at));
            
            // bind data 
            $statmentC->bindParam(':ID',$this->ID);
            $statmentC->bindParam(':comment',$this->comment);
            $statmentC->bindParam(':status',$this->status);
            // $statmentC->bindParam(':user_id',$this->user_id);
            // $statmentC->bindParam(':post_id',$this->post_id);
            $statmentC->bindParam(':update_at',$this->update_at);

            // execute query 
            if($statmentC->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $statmentC->error);
            return false;
        
        }


        // delete categories but be careful if delete any categories will delete all post that associated with him
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