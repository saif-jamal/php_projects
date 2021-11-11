<?php
// continue the session
session_start();

include("includes/db/db.php");
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saif Store</title>

    <!-- bootstrap con -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- bootstrap5  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">



    <!-- font awesome ........... -->
    <script src="https://kit.fontawesome.com/fe3c29cbcd.js" crossorigin="anonymous"></script>
    <!-- swiperjs  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- main style  -->
    <link rel="stylesheet" href="includes/assets/css/style.css">
</head>
<style>
    <?php
    include "includes/assets/css/style.css"
    ?>
    .profile{
        cursor: pointer;
        object-fit: cover;
    }
    .dash{
        position: absolute;
        bottom: 15%;
        left: 10%;
    }.aside_menu:hover .dash{ 
        left: 30%;

    }
    .dash2{
        position: absolute;
        bottom: 10%;
        left: 10%;
    }.aside_menu:hover .dash2{ 
        left: 30%;

    }
</style>

<body>

    <!-- aside menu  -->
    <div class="aside_menu">
        <div class="content align-items-center justify-content-center text-center">
           <a href="#main"> <img src="includes/assets/img/Logo.png" class="logo img-fluid mb-5" alt="" ></a>

            <a href="#main">
                <div class="main d-flex align-items-center justify-content-center text-center mt-5">
                    <p class="text-light  main__ mt-3  ">Main </p>
                    <i class="fas fa-home text-light "></i>
               </div>
            </a>

            <a href="#software">
                <div class="software d-flex align-items-center justify-content-center text-center m-1">
                    <p class="text-light main__ my-2 mx-1">SoftWare </p>
                    <i class="fab fa-microsoft text-light  "></i>
                </div>
            </a>
            <a href="#android">
                <div class="android d-flex align-items-center justify-content-center text-center m-1">
                    <p class="text-light main__ my-2 mx-1">Games </p>
                    <i class="fas fa-mobile-alt text-light"></i>
                </div>
            </a>
            <a href="#pc">
                <div class="pc d-flex align-items-center justify-content-center text-center m-1">
                    <p class="text-light main__ my-2 mx-1">Games </p>
                    <i class="fas fa-desktop text-light"></i>
                </div>
            </a>

            <a href="logout.php" class="dash">
                <div class="pc d-flex align-items-center justify-content-center text-center m-1">
                    <p class="text-light main__ my-2 mx-1 h4">LogOut </p>
                </div>
            </a>
            <a href="admin/Login_Admin.php" class="dash2">

                <div class="pc d-flex align-items-center justify-content-center text-center m-1">
                    <p class="text-light main__ my-2 mx-1 h4">Dashboard </p>
                </div>
            </a>

        </div>
    </div>


    <!-- wellcome message to store  -->
    <main class="wellcom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 my-2">
                    <div class="welc text-center align-items-center justify-content-center d-flex fa-1x">
                        <p class="text-light">Wellcom To Gaming Store</p>
                        <i class="fas fa-times fa-2x text-light close-wellcom"></i>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- header  -->
    <header class="header my-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12  d-flex subheader">

                    <!-- get_file -->
                    <div class="file__ text-center div ">
                        <p class="text-light mt-3">Get FIle <i class="fas fa-file-download text-light"></i> </p>
                    </div>

                    <!-- search -->
                    <div class="search">
                        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 text-center m-auto">
                            <input type="search" class="form-control form-control-dark m-auto" placeholder="Search..." aria-label="Search">
                        </form>
                    </div>

                    <!-- login and faivorate -->
                    <div class="login ">
                        <?php 
                           if(!empty($_SESSION['username']) && !empty($_SESSION['userpass'])){

                            $get_info_login=$connections->prepare("SELECT users.image as usimage, users.username as userName FROM users where username='{$_SESSION['username']}' and password='{$_SESSION['userpass']}';");
                            $get_info_login->execute();
                            $user_login=$get_info_login->fetchAll();
                            foreach($user_login as $user__login){
                            
                
                        ?>
                        <img class="img-fluid profile" src="<?php echo $user__login['usimage'] ;?> "  title="<?php echo $user__login['userName'] ;?>">
                        
                        <?php
                        }
                          }else{
                        ?>
                        <a href="login.php"> <button class="btn btn-info">Sin in</button></a>
                        <?php
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <!-- header slide  -->
    <div class="slide_image_show"  id="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 my-4">
                    <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-pointer-events pb-5">
                        <div class="swiper-wrapper" id="swiper-wrapper-7296b2b8c0f2bf30" aria-live="polite">

                            <?php
                            $numberOFpopular_posts = 0;
                            $get_post_user_categories = $connections->prepare("SELECT users.username,users.image as userImage,posts.postname,posts.image as postImage,categories.title FROM ((posts
                                    INNER JOIN users ON posts.user_id = users.ID)
                                    INNER JOIN categories ON posts.categories_id = categories.ID);");
                            $get_post_user_categories->execute();
                            $posts_users_categories = $get_post_user_categories->fetchAll();
                            foreach ($posts_users_categories as $post_user_categorie) {
                                if ($numberOFpopular_posts <10) {
                                    $numberOFpopular_posts++;
                            ?>
                                    <div class="swiper-slide " role="group" style="width: 200px;">
                                        <div class="card slide_image_post">
                                            <div class="categories">
                                                <?php
                                                if ($post_user_categorie['title'] == "Android Games") {
                                                ?>
                                                    <i class="fab fa-android" title="Android Games"></i>
                                                <?php
                                                } elseif ($post_user_categorie['title'] == "PC Games") {
                                                ?>
                                                    <i class="fas fa-desktop" title="PC Games"></i>
                                                <?php
                                                } else {
                                                ?>
                                                    <i class="fab fa-microsoft" title="Software"></i>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <img class="back_img" src="<?php echo $post_user_categorie['postImage']; ?>" alt="">

                                            <div class="show_details p-4">

                                                <div class="heade_sh  text-light">
                                                    <img src="<?php echo $post_user_categorie['userImage'] ?>" alt="">
                                                    <p class="mt-2 ml-4 pl-3">&nbsp; <?php echo $post_user_categorie['username'] ?></p>
                                                </div>

                                                <p class="head_sh_text text-light"><?php echo $post_user_categorie['postname'] ?></p>

                                                <div class="head_sh_icons text-center ">
                                                    <i class="fas fa-download text-light"></i>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                            <?php
                                }
                            }
                            ?>

                        </div>
                        <div class="swiper-pagination "></div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- android games show packge  -->
    <section class="android_games container-fluid" id="android">

        <div class="row mb-5">
            <div class="col-md-12 d-flex  android_header">
                <p class="text-light m-2">Android Games </p>
                <i class="fab fa-android text-light  fa-2x m-2" title="Android Games"></i>
            </div>

            <?php

            $get_post_user_categories__ = $connections->prepare("SELECT users.username,users.image as userImage,posts.postname,posts.image as postImage,categories.title FROM ((posts
                        INNER JOIN users ON posts.user_id = users.ID)
                        INNER JOIN categories ON posts.categories_id = categories.ID) where categories.title='Android Games';");
            $get_post_user_categories__->execute();
            $posts_users_categories__ = $get_post_user_categories__->fetchAll();
            foreach ($posts_users_categories__ as $post_user_categorie__) {

            ?>

                <div class="col-9 col-sm-6 col-md-5 col-lg-4 col-xl-2 my-3 align-items-center justify-content-center">
                    <div class="card">

                        <div class="img_title">
                            <i class="fab fa-android  fa-2x m-2" title="Android Games"></i>
                        </div>

                        <div class="shadow_card"></div>
                        <img src="<?php echo $post_user_categorie__['postImage'] ?>" alt="" class="back_fiexed">

                        <div class="content_card">

                            <div class="title_card_post p-3">
                                <p class="text-light pr-2 mt-1 mr-3"><?php echo $post_user_categorie__['username'] ?> &nbsp;</p>
                                <img class="user_post_card mr-3" src="<?php echo $post_user_categorie__['userImage'] ?>" alt="" />
                            </div>

                            <p class="text-light user_test_card px-1 text-left"><?php echo $post_user_categorie__['postname'] ?></p>

                            <div class="footer_ueser_post p-3">
                                <div class="download_post">
                                    <i class="fas fa-download text-light fa-1x"></i>
                                </div>
                                <i class="fas fa-heart  fa-2x heart"  ></i>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

            <!-- space  -->
            <div class="col-md-12"></div>
        </div>

    </section>
    <!-- end  -->

    <!-- pc Games  -->
    <div class="pc_games container-fluid" id="pc">

        <div class="row mb-5">
            <div class="col-md-12 d-flex  pc_header">
                <p class="text-light m-2">PC Games </p>
                <i class="fas fa-desktop text-light  fa-2x m-2" title="Android Games"></i>
            </div>

            <?php

            $get_post_user_categories___pc = $connections->prepare("SELECT users.username,users.image as userImage,posts.postname,posts.image as postImage,categories.title FROM ((posts
                  INNER JOIN users ON posts.user_id = users.ID)
                  INNER JOIN categories ON posts.categories_id = categories.ID) where categories.title='PC Games';");
            $get_post_user_categories___pc->execute();
            $posts_users_categories__pc = $get_post_user_categories___pc->fetchAll();
            foreach ($posts_users_categories__pc as $post_user_categorie__pc) {

            ?>

                <div class="col-9 col-sm-6 col-md-5 col-lg-4 col-xl-2 my-3 align-items-center justify-content-center">
                    <div class="card">

                        <div class="img_title">
                            <i class="fas fa-desktop  fa-2x m-2" title="PC Games"></i>
                        </div>

                        <div class="shadow_card"></div>
                        <img src="<?php echo $post_user_categorie__pc['postImage'] ?>" alt="" class="back_fiexed">

                        <div class="content_card">

                            <div class="title_card_post p-3">
                                <p class="text-light pr-2 mt-1 mr-3"><?php echo $post_user_categorie__pc['username'] ?> &nbsp;</p>
                                <img class="user_post_card mr-3" src="<?php echo $post_user_categorie__pc['userImage'] ?>" alt="" />
                            </div>

                            <p class="text-light user_test_card px-1 text-left"><?php echo $post_user_categorie__pc['postname'] ?></p>

                            <div class="footer_ueser_post p-3">
                                <div class="download_post">
                                    <i class="fas fa-download text-light fa-1x"></i>
                                </div>
                                <i class="fas fa-heart  fa-2x heart" ></i>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

            <!-- space  -->
            <div class="col-md-12"></div>
        </div>

    </div>
    <!-- end  -->


    <!-- softWare Games  -->
    <div class="softWare_games container-fluid" id="software">

        <div class="row mb-5">
            <div class="col-md-12 d-flex  softWare_header">
                <p class="text-light m-2">SoftWare Apps </p>
                <i class="fas fa-desktop text-light  fa-2x m-2" title="SoftWare Apps"></i>
            </div>

            <?php

            $get_post_user_categories___soft = $connections->prepare("SELECT users.username,users.image as userImage,posts.postname,posts.image as postImage,categories.title FROM ((posts
                  INNER JOIN users ON posts.user_id = users.ID)
                  INNER JOIN categories ON posts.categories_id = categories.ID) where categories.title='Software Apps';");
            $get_post_user_categories___soft->execute();
            $posts_users_categories__soft = $get_post_user_categories___soft->fetchAll();
            foreach ($posts_users_categories__soft as $post_user_categorie__soft) {

            ?>

                <div class="col-9 col-sm-6 col-md-5 col-lg-4 col-xl-2 my-3 align-items-center justify-content-center">
                    <div class="card">

                        <div class="img_title">
                            <i class="fab fa-microsoft  fa-2x m-2" title="Software Apps"></i>
                        </div>

                        <div class="shadow_card"></div>

                        <img src="<?php echo $post_user_categorie__soft['postImage'] ?>" class="back_fiexed">

                        <div class="content_card">

                            <div class="title_card_post p-3">
                                <p class="text-light pr-2 mt-1 mr-3"><?php echo $post_user_categorie__soft['username'] ?> &nbsp;</p>
                                <img class="user_post_card mr-3" src="<?php echo $post_user_categorie__soft['userImage'] ?>" alt="" />
                            </div>

                            <p class="text-light user_test_card px-1 text-left"><?php echo $post_user_categorie__soft['postname'] ?></p>

                            <div class="footer_ueser_post p-3">
                                <div class="download_post">
                                    <i class="fas fa-download text-light fa-1x"></i>
                                </div>
                                <i class="fas fa-heart  fa-2x heart"  ></i>
                            </div>
                        </div>
                        </img>
                    </div>
                </div>

                <?php
            }
                ?>

                <!-- space  -->
                <div class="col-md-12"></div>
                

       </div>
    </div>
    <!-- end  -->


    <!-- footer  -->
    <footer class="container-fluid footer"> 
       
                <div class="row">
                    <div class="col-md-12 text-center py-3">
                        <div class="h6 text-light">Copyright &copf;<?php echo date('Y');?>Saif Jamal</div>
                    </div>
               </div>
        
      
    </footer>


        <!-- bootstrap  boundler-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <!-- swiperjs  -->
        <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
        <!-- main style  -->
        <script src="includes/assets/js/main.js"></script>


</body>

</html>