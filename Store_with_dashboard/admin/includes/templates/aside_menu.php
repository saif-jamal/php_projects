
<!-- aside menu  -->
<aside class="aside-nav bg-dark text-light align-items-center justify-content-center ">
         
       <div class="show_aside_menu bg-dark rounded"> 
           <i class="fas fa-chevron-circle-right fa-3x text-light mx-1 " title="Close Admins" id="sh_aside_menu"></i>
           <i class="fas fa-chevron-circle-left fa-3x text-light mx-1" title="Show Admins" id="close_aside_menu"></i>      
       </div>

       <?php 
                if(!empty($_SESSION['admin_username']) && !empty($_SESSION['admin_pass'])){

                $get_info_login_admin=$connections->prepare("SELECT users.image as usimage, users.username as userName FROM users where username='{$_SESSION['admin_username']}' and password='{$_SESSION['admin_pass']}';");
                $get_info_login_admin->execute();
                $admin_login=$get_info_login_admin->fetchAll();
                foreach($admin_login as $admin__login){
                            
                
        ?>
            <a class="ssss_user" href="dashboard.php"><img src="<?php echo $admin__login['usimage']?>" alt="admin" class="img-fluid mt-5" id="admin_imag" title="<?php echo $admin__login['userName']?>" style="object-fit: cover;" >
                <h3 class="mt-1 mb-3 text-light">Admin</h3>
            </a> 
        <?php
            }
        }
        ?>

   
   <a href="userview.php"><i class="fas fa-users fa-3x card-img-top text-danger my-3" title="Users"></i></a> 
   <a href="posts.php"><i class="fas fa-address-card fa-3x card-img-top text-info my-3" title="Posts"></i></a>
   <a href="comments.php"><i class="fas fa-comments fa-3x card-img-top text-success my-3" title="Comments"></i></a>
   <a href="categories.php"><i class="fas fa-shapes fa-3x card-img-top text-warning my-3" title="Categories"></i></a>

    <div class="drow-img my-5">
        <img src="includes/assets/img/tr.png" alt="">
    </div>

</aside>

<div class="show_admin position-fixed  bg-dark">
       <div class="show_close_admin bg-dark rounded">
           <i class="fas fa-chevron-circle-left fa-3x text-light mx-1" title="Show Admins" id="show_ad"></i>
           <i class="fas fa-chevron-circle-right fa-3x text-light mx-1 " title="Close Admins" id="close_ad"></i>
              
       </div>
      <div class="container">
          <div class="row">
          <?php
            $get_users=$connections->prepare("SELECT username as name,image,role FROM users where role='Admin';");
            $get_users->execute();
            $count_admin=$get_users->rowCount();
            $users__=$get_users->fetchAll();
            foreach($users__ as $user__){
               if($count_admin>1){
            ?>
            <div class="col-md-4 my-2  ">
                <div class="card bg-dark cir-img m-auto">
                    <img src="<?php echo $user__['image']?>" alt="" class="inside-put">
                    <div class="slide-up-img text-center ">
                        <h6 class="text-light mt-3"><?php echo $user__['name']?></h6><br>
                        <p class="text-success position-relative adm">Admin</p>
                    </div>
                </div>
            </div>

            <?php
                }
               }
            ?>
          </div>
      </div>
</div>
<!-- end aside menu  -->