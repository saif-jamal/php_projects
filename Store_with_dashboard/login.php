<?php
// Start the session
session_start();
$_SESSION['username']="";
$_SESSION['userpass']="";

  include("includes/db/db.php");
  ob_start();


// check admin 
$message_error="";
$usercheck=$passcheck=0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["user_username"]);
        $password = test_input($_POST["user_Password"]);

        if(isset($_POST['user_username']) && !empty($_POST['user_username']) ){
            $usercheck=1;
        }else{
            $message_error="error unaccepted!";
        }
        if(isset($_POST['user_Password']) && !empty($_POST['user_Password']) ){
            $passcheck=1;
        }else{
            $message_error="error unaccepted!";
        }

        if($usercheck==1 && $passcheck==1){
            $get_users=$connections->prepare("SELECT username as usnam,password as pass FROM users where role='user';");
            $get_users->execute();
            $users__=$get_users->fetchAll();
            foreach($users__ as $user__){
                if($user__['usnam']==$username && $user__['pass']==$password ){
                    $_SESSION['username']=$username;
                    $_SESSION['userpass']=$password;
                    // $time_start = microtime(true); 
                    $message_error="login successfull";
                    // $time_end = microtime(true);
                    // $execution_time = ($time_end - $time_start);
                    sleep(2);
                    header("Location:index.php?");

                }else{
                    $message_error="Error! username or password is not correct <br> go to Sin Up";
                }
            }
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
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- font awesome ........... -->
    <script src="https://kit.fontawesome.com/fe3c29cbcd.js" crossorigin="anonymous"></script>



    


</head>
<style>
    <?php
    include "includes/assets/css/login.css";
    ?>
    .sinup{
        display: flex;
        justify-content: space-evenly;
    }
    a{
        text-decoration: none;
        list-style: none; 
        color: rgb(13,184,222);
    }
</style>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    Login User
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" onsubmit="return validation()">
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="text" class="form-control" name="user_username" id="ad_username">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" class="form-control" name="user_Password" id="ad_password">
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-12 login-btm login-text">
                                    <p class="error_mesage text-info  lead" id="error_message"><?php echo $message_error;?></p>
                                </div>
                                <div class="col-lg-12 login-btm login-button sinup">
                                    <button type="submit" class="btn btn-outline-primary">LOGIN</button>
                                    <button type="submit" class="btn btn-outline-primary"><a href="includes/add_user/register.php">Sin UP</a></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>

         



        <!-- bootstrap  boundler-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

        <script src="includes/assets/js/login.js"></script>
</body>
</html>