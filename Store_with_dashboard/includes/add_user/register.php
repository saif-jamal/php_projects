<?php
//session
session_start();
$_SESSION['username']="";
$_SESSION['userpass']="";

  include("../db/db.php");
  ob_start();


// check admin 
$message_error="";
$name_error=$pass_error=$email_error=$image_error="";
$usercheck=$passcheck= $emailcheck=$imagecheck=0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["name"]);
        $password = test_input($_POST["password"]);
        $email = test_input($_POST["email"]);
        $image = test_input($_POST["imageURL"]);

        

        if(isset($_POST['name']) && !empty($_POST['name']) ){
            $usercheck=1;
        }else{
            $name_error="error unaccepted!";
        }
        if(isset($_POST['email']) && !empty($_POST['email']) ){
            $emailcheck=1;
        }else{
            $email_error="error unaccepted!";
        }
        if(isset($_POST['password']) && !empty($_POST['password']) ){
            $passcheck=1;
        }else{
            $pass_error="error unaccepted!";
        } 
        if(isset($_POST['imageURL']) && !empty($_POST['imageURL']) ){
            $imagecheck=1;
        }else{
            $image_error="error unaccepted!";
        }
    
        $get_users=$connections->prepare("SELECT username as usnam,password as pass,email as admemail FROM users ;");
        $get_users->execute();
        $users__=$get_users->fetchAll();
        foreach($users__ as $user__){
            if($user__['usnam']== $username || $user__['pass']==$password || $user__['admemail']== $email){
                $message_error="Error! this information already exite choose another info please! ";
                $usercheck=$passcheck= $emailcheck= 0;

            }
        }

        if($usercheck==1 && $passcheck==1 && $emailcheck==1 && $imagecheck==1){
            $create_at=date("Y-m-d H:m:s");
            $set_users=$connections->prepare("INSERT INTO users () VALUES('','{$username}','{$email}','{$password}','Active','user','{$create_at}','','{$image}','');");
            $set_users->execute();
 
            $email_error="";
            $pass_error="";
            $name_error="";
            $image_error="";
                   
                    sleep(3);
                    echo "<script>alert('Add Admin is done successfully.');</script>";
                    header("Location:../../login.php?");

        }else{
                    $message_error="Error! unAccepted error happend OR this information already exite choose another info please! ";
            }
            
        

    }
  
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add User</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- bootstrap5  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">


    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../includes/assets/css/add_admin.css">
</head>
    <style>
        <?php 
          include "../includes/assets/css/add_admin.css";
        ?>
    </style>
<body>

    <div class="main">

        <div class="container">
            <div class="signup-content">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" id="signup-form" class="signup-form" onsubmit="return validation()">

                    <h2>Add User</h2>
                    <p class="desc">This form is to Make account for you in my Store be happy😍</p>
                    
                    <div class="form-group">
                        <input type="text" class="form-input" name="name" id="name" placeholder="Your Name"/>
                        <p class="text-danger" id="message_name_error"><?php echo $name_error?></p>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="Email"/>
                        <p class="text-danger" id="message_email_error"> <?php echo $email_error?> </p>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-input" name="password" id="password" placeholder="Password"/>
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        <p class="text-danger" id="message_pass_error"><?php echo $pass_error?></p>
 
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-input" name="imageURL" id="image" placeholder="Your URL Image"/>
                      <p class="text-danger" id="message_image_error"><?php echo $image_error?></p>
                    </div>

                      <p class="text-dark"><?php echo $message_error ?></p>

                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit submit" value="Sign up"/>
                        
                    </div>
                     <span class="text-light">If you have account </span><a href="../../login.php" class="text-info">SinIn</a> Here.
                </form>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    
<!-- bootstrap  boundler-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="js/main.js"></script>
    <script src="../includes/assets/js/add_admin.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>