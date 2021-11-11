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


</head>
<!-- end header  -->

<style>
     <?php
      include "includes/assets/css/style1.css";
      include "includes/assets/css/posts.css";
     ?>

</style>
<body>
<?php
    include("includes/templates/navbar.php");
    include("includes/templates/aside_menu.php");
?>

<!-- posts show here  -->
<section class="posts mb-5 pb-5">
        <div class="container">
            <div class="row  align-items-center justify-content-center">
                <div class="col-md-12 text-center align-items-center justify-content-center my-5">
                    <span class="text-dark h1 posttttt">Posts View</span>
                </div>

            <?php
                    $get_comments=$connections->prepare("SELECT users.username,users.image as userimage ,users.status as userstatus,posts.postname,posts.descriptions,posts.image as postimage,posts.ID as postID,categories.title as categoriesTitle FROM ((posts
                    INNER JOIN users ON posts.user_id = users.ID)
                    INNER JOIN categories ON posts.categories_id = categories.ID);");
                    $get_comments->execute();
                    $posts__=$get_comments->fetchAll();
                    foreach($posts__ as $post__){
            ?>
                <div class=" col-10 col-sm-12 col-md-6 col-lg-4  my-4">
                    <div class="card bg-dark">
                         <div class="delete_posts">
                            <a href="?posts=delete&postid=<?php echo $post__['postID']?>"><i class="fas fa-times fa-2x text-dark " title="Delete Post"></i></a>
                           
                         </div>
                        <div class="img_user_post_it">
                            <img class="img_posts_user" src="<?php echo $post__['userimage']?>" alt="">

                            
                            <div class="slide_up bg-dark">
                                <p class="text-center  text-light mt-1"><?php echo $post__['username']?></p>
                                <p class="text-success text-center"><?php echo $post__['userstatus']?></p>
                            </div>
                        </div>

                        <img src="<?php echo $post__['postimage']?>" alt="image" class="card-img-top width-100">
                        <div class="card-body">
                            <h4 class="card-title text-light"><?php echo $post__['postname']?></h4>
                            <p class="card-text text-light"><?php echo $post__['descriptions']?></p>
                            <span class="text-light">Categories:</span>
                             <div class="catogries_sh bg-light px-1 d-flex text-center align-items-center justify-content-center mt-1">
                                 <p class="text-dark mt-2 h6"><?php echo $post__['categoriesTitle']?></p>
                             </div>
                        </div>
                    </div>
                </div>

            <?php
                }
            ?>


            </div>
        </div>
    </section>

  <!-- delete post  -->
  <?php
    if(isset($_GET['posts']) && $_GET['posts']=='delete'){
        $delet_user=$connections->prepare("DELETE FROM posts WHERE ID=?;");
        $delet_user->execute(array($_GET['postid']));
        // header("Location:userview.php");
        header("Location:posts.php?data=delet_post_successfully");
    }
    
    ?>
    <!-- end delete user  -->


<?php
    include("includes/templates/footer.php");
?>
