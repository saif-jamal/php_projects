<?php
    // class of Users 
    class Users{
         
        // private properties for this class 
        private $conn;
        private $table='users';

        // public access properties for this class
        public $ID;
        public $username;
        public $email;
        public $password;
        public $status;
        public $role;
        public $create_at;
        public $update_at;
        public $image;

        // constructor for make connections with database
        public function __construct($db){
            $this->conn=$db;
        }

        // read data of users
        public function read(){
            // create query 
            $query="SELECT * from {$this->table} order by create_at DESC;";

            // prepare query 
            $statm=$this->conn->prepare($query);

            // execute the query 
            $statm->execute();
            return $statm;
        }

        //create user 
        public function create_user($userRead){
         
            // create query to insert data to database 
            $query="INSERT INTO {$this->table} SET username=:username,email=:email,password=:password,status=:status,role=:role,create_at=:create_at,image=:image";

            // prepare my query 
            $statm= $this->conn->prepare($query);

            // clean data that I geted from user 
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->role = htmlspecialchars(strip_tags($this->role));
            $this->create_at=htmlspecialchars(strip_tags($this->create_at));
            $this->image=htmlspecialchars(strip_tags($this->image));

            // check if user is already here 
             
            while($user__=$userRead->fetch(PDO::FETCH_ASSOC)){
                extract($user__);

                if($this->username === $username)
                {
                    echo json_encode(array(
                        'message'=>'user name already token enter another'
                    ));
                    return false;
                }elseif($this->email=== $email){
                    echo json_encode(array(
                        'message'=>'user email vaild or already token enter another'
                    ));
                    return false;
                }elseif($this->password===$password){
                    echo json_encode(array(
                        'message'=>'user password vaild or already token enter another'
                    ));
                    return false;
                }
            }

            // bind data 
             $statm->bindParam(':username',$this->username);
             $statm->bindParam(':email',$this->email);
             $statm->bindParam(':password',$this->password);
             $statm->bindParam(':status',$this->status);
             $statm->bindParam(':role',$this->role);
             $statm->bindParam(':create_at',$this->create_at);
             $statm->bindParam(':image',$this->image);

            //  execute and return if execute or not 
            if($statm->execute()){
                return true;
            }


            // Print error if something goes wrong
            printf("Error: %s.\n", $$statm->error);
            return false;

        }

        // create admin 
        public function create_admin($adminRead){

            // create query to insert data to database 
            $query="INSERT INTO {$this->table} SET username=:username,email=:email,password=:password,status=:status,role=:role,create_at=:create_at,image=:image";

            // prepare my query 
            $statm= $this->conn->prepare($query);

            // clean data that I geted from user 
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->role = htmlspecialchars(strip_tags($this->role));
            $this->create_at=htmlspecialchars(strip_tags($this->create_at));
            $this->image=htmlspecialchars(strip_tags($this->image));

            // check if user is already here 
             
            while($admin__=$adminRead->fetch(PDO::FETCH_ASSOC)){
                extract($admin__);

                if($this->username === $username)
                {
                    echo json_encode(array(
                        'message'=>'Admin name already token enter another'
                    ));
                    return false;
                }elseif($this->email=== $email){
                    echo json_encode(array(
                        'message'=>'Admin email vaild or already token enter another'
                    ));
                    return false;
                }elseif($this->password===$password){
                    echo json_encode(array(
                        'message'=>'Admin password vaild or already token enter another'
                    ));
                    return false;
                }
            }

            // bind data 
             $statm->bindParam(':username',$this->username);
             $statm->bindParam(':email',$this->email);
             $statm->bindParam(':password',$this->password);
             $statm->bindParam(':status',$this->status);
             $statm->bindParam(':role',$this->role);
             $statm->bindParam(':create_at',$this->create_at);
             $statm->bindParam(':image',$this->image);

            //  execute and return if execute or not 
            if($statm->execute()){
                return true;
            }


            // Print error if something goes wrong
            printf("Error: %s.\n", $$statm->error);
            return false;

        }

        // update user 
        public function update_user($userRead){

            // create query to insert data to database 
            $query="UPDATE  {$this->table} SET username=:username,email=:email,password=:password,status=:status,role=:role,update_at=:update_at,image=:image
                    WHERE ID = :ID ;";

            // prepare my query 
            $statm= $this->conn->prepare($query);

            // clean data that I geted from user 
            $this->ID=htmlspecialchars(strip_tags($this->ID));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->role = htmlspecialchars(strip_tags($this->role));
            $this->update_at=htmlspecialchars(strip_tags($this->update_at));
            $this->image=htmlspecialchars(strip_tags($this->image));

            // check if user is already here 
            
            while($user__=$userRead->fetch(PDO::FETCH_ASSOC)){
                extract($user__);
                if($this->username === $username)
                {
                    echo json_encode(array(
                        'message'=>'user name already token enter another'
                    ));
                    return false;
                }elseif($this->email=== $email){
                    echo json_encode(array(
                        'message'=>'user email vaild or already token enter another'
                    ));
                    return false;
                }elseif($this->password===$password){
                    echo json_encode(array(
                        'message'=>'user password vaild or already token enter another'
                    ));
                    return false;
                }
            }

            // bind data 
            $statm->bindParam(':ID',$this->ID);
            $statm->bindParam(':username',$this->username);
            $statm->bindParam(':email',$this->email);
            $statm->bindParam(':password',$this->password);
            $statm->bindParam(':status',$this->status);
            $statm->bindParam(':role',$this->role);
            $statm->bindParam(':update_at',$this->update_at);
            $statm->bindParam(':image',$this->image);

            //  execute and return if execute or not 
            if($statm->execute()){
                return true;
            }


            // Print error if something goes wrong
            printf("Error: %s.\n", $$statm->error);
            return false;


        }

        // update user 
        public function update_admin($adminRead){

            // create query to insert data to database 
            $query="UPDATE  {$this->table} SET username=:username,email=:email,password=:password,status=:status,role=:role,update_at=:update_at,image=:image
                    WHERE ID = :ID ;";

            // prepare my query 
            $statm= $this->conn->prepare($query);

            // clean data that I geted from user 
            $this->ID=htmlspecialchars(strip_tags($this->ID));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->role = htmlspecialchars(strip_tags($this->role));
            $this->update_at=htmlspecialchars(strip_tags($this->update_at));
            $this->image=htmlspecialchars(strip_tags($this->image));

            // check if user is already here 
            
            while($admin__=$adminRead->fetch(PDO::FETCH_ASSOC)){
                extract($admin__);

                if($this->username === $username)
                {
                    echo json_encode(array(
                        'message'=>'Admin name already token enter another'
                    ));
                    return false;
                }elseif($this->email=== $email){
                    echo json_encode(array(
                        'message'=>'Admin email vaild or already token enter another'
                    ));
                    return false;
                }elseif($this->password===$password){
                    echo json_encode(array(
                        'message'=>'Admin password vaild or already token enter another'
                    ));
                    return false;
                }
            }

            // bind data 
            $statm->bindParam(':ID',$this->ID);
            $statm->bindParam(':username',$this->username);
            $statm->bindParam(':email',$this->email);
            $statm->bindParam(':password',$this->password);
            $statm->bindParam(':status',$this->status);
            $statm->bindParam(':role',$this->role);
            $statm->bindParam(':update_at',$this->update_at);
            $statm->bindParam(':image',$this->image);

            //  execute and return if execute or not 
            if($statm->execute()){
                return true;
            }


            // Print error if something goes wrong
            printf("Error: %s.\n", $$statm->error);
            return false;


        }

        // delete user 
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