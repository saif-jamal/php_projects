<!-- connect website to database  -->
<?php
$dbc="mysql:host=localhost;dbname=dashboard;";
$user="root";
$pass="";
$options= array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try{
$connections=new PDO($dbc,$user,$pass,$options);
$connections->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo "<script> alert('{$e->getMessage()}');</script>";
}

?>