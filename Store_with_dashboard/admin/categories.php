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
                    <span class="heading-section h1 user_dfgdfgd">Categories View</span>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table table-responsive-xl">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>id</th>
                                    <th>Catrgories type</th>
                                    <th>Created At</th>
                                    <th>UpDated At</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                                    $get_catgor=$connections->prepare("SELECT * FROM categories");
                                    $get_catgor->execute();
                                    $catgors__=$get_catgor->fetchAll();
                                    foreach($catgors__ as $catgor__){
                            ?>
                                <tr class="alert" role="alert">
                                    <td>
                                        <label class="checkbox-wrap checkbox-primary">
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class=""><span class="active"><?php echo $catgor__['ID']?></span></td>
                                    <td><?php echo $catgor__['title']?></td>
                                    <td class="status"><span class="active"><?php echo $catgor__['create_at']?></span></td>
                                    <td class="status"><span class="active"><?php echo $catgor__['update_at']?></span></td>
                                    <td>
                                        <a href="?categories=deleted&categorid=<?php echo $catgor__['ID']?>">
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






 <!-- delete Catgories  -->
 <?php
    if(isset($_GET['categories']) && $_GET['categories']=='deleted'){
        $delet_user=$connections->prepare("DELETE FROM categories WHERE ID=?;");
        $delet_user->execute(array($_GET['categorid']));
        // header("Location:userview.php");
        header("Location:categories.php?data=delet_categories_successfully");
    }
    
    ?>
    <!-- end delete user  -->









<?php
    include("includes/templates/footer.php");
?>
