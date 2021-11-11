<?php
session_start();

include("ini.php");

// number of users 
$users_statment = $connections->prepare("select * from users");
$users_statment->execute();
$count_users = $users_statment->rowCount();

// number of posts 
$posts_statment = $connections->prepare("select * from posts");
$posts_statment->execute();
$count_posts = $posts_statment->rowCount();

// number of comments
$comments_statment = $connections->prepare("select * from comments");
$comments_statment->execute();
$count_comments = $comments_statment->rowCount();

// number of Categories
$categories_statment = $connections->prepare("select * from categories");
$categories_statment->execute();
$count_categories = $categories_statment->rowCount();

?>



<!-- control dashboards  -->
<section class="control-dashboard py-5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">


            <!-- wellcome message  -->
            <div class="col-md-12  my-3  ">
                <div class="card text-center bg-dark p-5 rounded position-relative">
                <?php
                                    $get_users=$connections->prepare("SELECT username as name FROM users where role='Admin';");
                                    $get_users->execute();
                                    $users__=$get_users->fetchAll();
                                    foreach($users__ as $user__){
                 ?>
                    <h1 class="text-light">Wellcome To Dashboard <span class="text-info"><?php echo $user__['name']?></span></h1>
                <?php
                    }
                ?>

                    <i class="fas fa-times-circle position-absolute  text-light fa-3x close"></i>
                </div>
            </div>


            <!-- users view  -->
            <div class="col-md-3  my-3  ">
                <div class="card text-center bg-dark p-5 rounded">
                    <i class="fas fa-users fa-3x card-img-top text-light"></i>
                    <div class="card-body">
                        <h3 class="card-title text-light mt-2">Users</h3>
                        <p class="card-text text-light fa-3x"><?php echo $count_users ?></p>
                        <a href="userview.php"><button class="btn btn-danger mt-3">Show</button></a>
                    </div>
                </div>
            </div>

            <!-- posts view -->
            <div class="col-md-3  my-3">
                <div class="card text-center bg-dark p-5 rounded">
                    <i class="fas fa-address-card fa-3x card-img-top text-light"></i>
                    <div class="card-body">
                        <h3 class="card-title text-light mt-2">Posts</h3>
                        <p class="card-text text-light fa-3x"><?php echo $count_posts ?></p>
                        <a href="posts.php"><button class="btn btn-info mt-3">Show</button></a>
                    </div>
                </div>
            </div>

            <!-- comments view  -->
            <div class="col-md-3  my-3">
                <div class="card text-center bg-dark p-5 rounded">
                    <i class="fas fa-comments fa-3x card-img-top text-light"></i>
                    <div class="card-body">
                        <h3 class="card-title text-light mt-2">Comments</h3>
                        <p class="card-text text-light fa-3x"><?php echo $count_comments ?></p>
                        <a href="comments.php"><button class="btn btn-success mt-3">Show</button></a>
                    </div>
                </div>
            </div>
            <!-- categorie view  -->
            <div class="col-md-3  my-3">
                <div class="card text-center bg-dark p-5 rounded">
                    <i class="fas fa-shapes fa-3x card-img-top text-light"></i>
                    <div class="card-body">
                        <h3 class="card-title text-light mt-2">Categories</h3>
                        <p class="card-text text-light fa-3x"><?php echo $count_categories ?></p>
                        <a href="categories.php"><button class="btn btn-warning mt-3">Show</button></a>
                    </div>
                </div>
            </div>

            <!-- slide images  -->
            <div class="col-md-12 text-center text-light">
                <div class="card bg-dark slide-images">
                    <img src="includes/assets/img/01.jpg" id="slider" alt="Image" class="img-fluid height-400">
                </div>
            </div>
   
            <!-- circle-images  -->
            <div class="col-md-12 text-center my-5">
                <span class=" h1 text-dark dashboaard_user">Users</span>
            </div>
            <?php
              $get_users=$connections->prepare("SELECT * FROM users");
              $get_users->execute();
              $users__=$get_users->fetchAll();
              foreach($users__ as $user__){
            ?>
                <div class="col-md-3 mb-3 mt-5  ">
                    <div class="card bg-dark cir-img m-auto">
                    <img src="<?php echo $user__['image']?>" alt="" class="inside-put">
                    <div class="slide-up-img text-center ">
                        <h5 class="text-light mt-3"><?php echo $user__['username']?></h5><br>
                        <p class="text-success"><?php echo $user__['role']?></p>
                    </div>
                    </div>
                </div>
            <?php
              }
            ?>
  

             <!-- footer  -->
             <div class="col-md-12 text-center text-light">
                <div class="card bg-dark slide-images align-items-center justify-content-center text-center footer">
                    <h3>Copyright &copy; 2021 Saif Jamal</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end  control  -->




<?php
include("includes/templates/footer.php");
?>