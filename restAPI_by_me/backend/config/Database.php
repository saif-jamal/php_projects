<?php

// clase database  so here we make connections with database just 
class Database{
    private  $host="localhost";
    private  $db_name='dashboard';
    private $usrname="root";
    private $password="";
    private $conn;

    //database connection
    public function connect(){

        $this->conn=null;
        try{
            $this->conn= new PDO("mysql:host={$this->host};dbname={$this->db_name}",$this->usrname,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
           echo "connections error:{$e->getmessage()}";

        }
        return $this->conn;
    }

}


?>



