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
    <link rel="stylesheet" href="includes/assets/css/comments.css">


</head>
<!-- end header  -->

<style>
     <?php
      include "includes/assets/css/style1.css";
      include "includes/assets/css/comments.css";
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
                    <span class="heading-section h1 comm_dfgdfgd">Comments View</span>
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
                                    <th>PostsName</th>
                                    <th>Comments</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                                    $get_comments=$connections->prepare("SELECT users.username,users.image,users.email,comments.create_at,comments.comment,comments.ID,posts.postname FROM ((comments
                                    INNER JOIN users ON comments.user_id = users.ID)
                                    INNER JOIN posts ON comments.post_id = posts.ID);");
                                    $get_comments->execute();
                                    $comments__=$get_comments->fetchAll();
                                    foreach($comments__ as $comments__){
                            ?>
                                <tr class="alert" role="alert">
                                    <td>
                                        <label class="checkbox-wrap checkbox-primary">
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <div class="img px-4" style="background-image:url(<?php echo $comments__['image']?>)"></div>
                                        <div class="pl-3 email">
                                            <span><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="214c40534a4e55554e61444c40484d0f424e4c"><?php echo $comments__['email']?></a></span>
                                            <span>Comment Added at : <?php echo $comments__['create_at']?></span>
                                        </div>
                                    </td>
                                    <td><?php echo $comments__['username']?></td>
                                    <td class="postname"><span class="px-3"><?php echo $comments__['postname']?></span></td>
                                    <td class="comments"><span class="px-3"><?php echo $comments__['comment']?></span></td>
                                    <td>
                                        <a href="?comment=deleted&id=<?php echo $comments__['ID']?>">
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

 <!-- delete comments  -->
 <?php
    if(isset($_GET['comment']) && $_GET['comment']=='deleted'){
        $delet_user=$connections->prepare("DELETE FROM comments WHERE ID=?;");
        $delet_user->execute(array($_GET['id']));
        // header("Location:userview.php");
        header("Location:comments.php?data=delet_comments_successfully");
    }
    
    ?>
    <!-- end delete user  -->




<?php
    include("includes/templates/footer.php");
?>
