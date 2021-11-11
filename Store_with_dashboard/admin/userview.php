<?php
   session_start();
  include("includes/db/db.php");
  ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<!-- start header  -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- bootstrap con -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- bootstrap5  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">



    <!-- font awesome ........... -->
    <script src="https://kit.fontawesome.com/fe3c29cbcd.js" crossorigin="anonymous"></script>

    <!-- main style  -->
    <link rel="stylesheet" href="includes/assets/css/style1.css">
    <link rel="stylesheet" href="includes/assets/css/user1.css">


</head>
<!-- end header  -->
<style>
     <?php
      include "includes/assets/css/style1.css";
      include "includes/assets/css/user1.css";
     ?>

</style>

<body>

    <?php
    include("includes/templates/navbar.php");
    include("includes/templates/aside_menu.php");
    ?>
    <section class="ftco-section">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5 mt-5">
                    <span class="heading-section h1 user_dfgdfgd">Users View</span>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table table-responsive-xl">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                                    $get_users=$connections->prepare("SELECT * FROM users");
                                    $get_users->execute();
                                    $users__=$get_users->fetchAll();
                                    foreach($users__ as $user__){
                            ?>
                                <tr class="alert" role="alert">
                                    <td>
                                        <label class="checkbox-wrap checkbox-primary">
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <div class="img" style="background-image:url(<?php echo $user__['image']?>)"></div>
                                        <div class="pl-3 email">
                                            <span><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="214c40534a4e55554e61444c40484d0f424e4c"><?php echo $user__['email']?></a></span>
                                            <span>Added: <?php echo $user__['create_at']?></span>
                                        </div>
                                    </td>
                                    <td><?php echo $user__['username']?></td>
                                    <td class="status"><span class="active"><?php echo $user__['status']?></span></td>
                                    <td class="status"><span class="active"><?php echo $user__['role']?></span></td>
                                    <td>
                                        <a href="?user=deleted&id=<?php echo $user__['ID']?>">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                            </button>
                                        </a>
                                       
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- delete user  -->
    <?php
    if(isset($_GET['user']) && $_GET['user']=='deleted'){
        $delet_user=$connections->prepare("DELETE FROM users WHERE ID=?;");
        $delet_user->execute(array($_GET['id']));
        // header("Location:userview.php");
        header("Location:userview.php?data=delet_user_successfully");
    }
    
    ?>
    <!-- end delete user  -->





    <?php
    include("includes/templates/footer.php");
    ?>