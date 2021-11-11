<?php
    //   class categories 
    class Categories{
        
        // private data for this class 
        private $conn;
        private $table='categories';
       
        // public data for this class 
        public $ID;
        public $title;
        public $descriptions;
        public $status;
        public $create_at;
        public $update_at;

        // constructor for make connections with database 
        public function __construct($db){
             $this->conn=$db;
        }

        // read data 
        public function read(){
            // create query 
            $query="SELECT * from {$this->table} order by create_at DESC;";

            // prepare my query 
            $statment =$this->conn->prepare($query);

            // execute my query 
            $statment->execute();

            // finshed read and return data final step
            return $statment;
        }
        
        // create categories 
        public function create($categor__){
         
            // create query to insert data to database 
            $query="INSERT INTO {$this->table} SET title=:title,descriptions=:descriptions,status=:status,create_at=:create_at ;";

            // prepare my query 
            $statm= $this->conn->prepare($query);

            // clean data that I geted from user 
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->descriptions=htmlspecialchars(strip_tags($this->descriptions));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->create_at=htmlspecialchars(strip_tags($this->create_at));

            // check if categories is already exists 
             
            while($categor_=$categor__->fetch(PDO::FETCH_ASSOC)){
                extract($categor_);

                if($this->title === $title)
                {
                    echo json_encode(array(
                        'message'=>'this categories is already exists'
                    ));
                    return false;
                }
            }

            // bind data 
             $statm->bindParam(':title',$this->title);
             $statm->bindParam(':descriptions',$this->descriptions);
             $statm->bindParam(':status',$this->status);
             $statm->bindParam(':create_at',$this->create_at);

            //  execute and return if execute or not 
            if($statm->execute()){
                return true;
            }


            // Print error if something goes wrong
            printf("Error: %s.\n", $$statm->error);
            return false;

        }
       
        //categorie updated
        public function update($categor__){
            
            // create query to insert data to database 
            $query="UPDATE  {$this->table} SET title=:title,descriptions=:descriptions,status=:status,update_at=:update_at
                    WHERE ID = :ID ;";

            // prepare my query 
            $statm= $this->conn->prepare($query);

           // clean data that I geted from user 
           $this->title=htmlspecialchars(strip_tags($this->title));
           $this->descriptions=htmlspecialchars(strip_tags($this->descriptions));
           $this->status=htmlspecialchars(strip_tags($this->status));
           $this->update_at=htmlspecialchars(strip_tags($this->update_at));

           // check if categories is already exists 
            
           while($categor_=$categor__->fetch(PDO::FETCH_ASSOC)){
               extract($categor_);

               if($this->title === $title)
               {
                    echo json_encode(array(
                        'message'=>'this categories is already exists'
                    ));
                   return false;
               }
           }

           // bind data 
           $statm->bindParam(':ID',$this->ID);
           $statm->bindParam(':title',$this->title);
           $statm->bindParam(':descriptions',$this->descriptions);
           $statm->bindParam(':status',$this->status);
           $statm->bindParam(':update_at',$this->update_at);

           //  execute and return if execute or not 
           if($statm->execute()){
               return true;
           }


           // Print error if something goes wrong
           printf("Error: %s.\n", $$statm->error);
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