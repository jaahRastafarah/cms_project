<?php include "includes/admin_header.php" ?>
 <?php
 if(isset($_SESSION['username'])){
    $username =  $_SESSION['username'];
    $query = "SELECT * FROM users where username='{$username}'";
    $select_user_profie_query = mysqli_query($connection, $query);
    if(!$select_user_profie_query){
           die("failed". mysqli_error($connection));
    }  
     while($row= mysqli_fetch_assoc($select_user_profie_query)){
        $user_id = $row['user_id'];
        $username  = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        // $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_date  = $row['user_date'];
     }
 }
 
 
 
 ?>

 <?php
 if(isset($_POST['update_profile'])){
    //  $user_id = $_POST['user_id'];
       $user_firstname = $_POST['user_firstname'];
       $user_lastname = $_POST['user_lastname'];
       $user_role = $_POST['user_role'];
       $username = $_POST['username'];
    //    $user_image = $_FILES['user_image']['name'];
    //    $user_image_temp = $_FILES['user_image']['tmp_name'];
       $user_email = $_POST['user_email'];
       $user_password = $_POST['user_password'];
       $user_date = date('d-m-y');

       $query = "UPDATE users SET username='$username',user_password='$user_password',user_firstname='$user_firstname',
          user_lastname='$user_lastname', user_email='$user_email',user_role='$user_role',
           user_date=now() WHERE user_id='$user_id'";

        $update_profile_query= mysqli_query($connection,$query);
        if(!$update_profile_query){
               die("failed". mysqli_error($connection));
        }
        
 } 
 
 
 ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                           Welcome to Admin
                            <small>Author</small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" value="<?php echo $user_firstname ?>" name="user_firstname">
                        </div>
                        <div class="form-group">
                        <label for="user_lastname">Last Name</label>
                        <input type="text" class="form-control" value="<?php echo $user_lastname ?>" name="user_lastname">
                        </div>
                        <div class="form-group">
                        <select name="user_role" id="" >
                        <option value="subscriber"><?php echo $user_role ?></option>
                        <?php
                        if($user_role == 'admin'){
                        echo   "<option value='subscriber'>Subscriber</option>";
                        }else{
                        echo   "<option value='admin'>Admin</option>"; 
                        }

                        ?>

                        </select>
                        </div>
                        <!-- <div class="form-group">

                        <img src="../images/<?php echo $user_image ?>" alt="" width="100">
                        <input type="file"  name="user_image">
                        </div> -->
                        <div class="form-group">
                        <label for="post_tags">Username</label>
                        <input type="text" value="<?php echo $username ?>" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                        <label for="post_tags">Email</label>
                        <input type="text" class="form-control" value="<?php echo $user_email ?>" name="user_email">
                        </div>
                        <div class="form-group">
                        <label for="post_tags">Password</label>
                        <input type="password" class="form-control" value="<?php echo $user_password ?>" name="user_password">
                        </div>
                        <div class="form-group">
                        <input  class="btn btn-primary" type="submit"  name="update_profile" value="update profile">
                        </div>
                    </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php" ?>