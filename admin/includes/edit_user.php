<?php
if(isset($_GET['edit_user'])){
    $edit_user_id = $_GET['edit_user'];
}

$query="SELECT * FROM users where user_id = '$edit_user_id'";
$select_user_by_id= mysqli_query($connection,$query);
while($row= mysqli_fetch_assoc($select_user_by_id)){
        // $post_id = $row['post_id'];
        $user_id = $row['user_id'];
        $username  = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image']; 
        $user_role = $row['user_role'];
        $user_date  = $row['user_date'];
}

if(isset($_POST['edit_user'])){
//    $user_id = $_POST['user_id'];
   $user_firstname = $_POST['user_firstname'];
   $user_lastname = $_POST['user_lastname'];
   $user_role = $_POST['user_role'];
   $username = $_POST['username'];
   $user_image = $_FILES['user_image']['name'];
   $user_image_temp = $_FILES['user_image']['tmp_name'];
   $user_email = $_POST['user_email'];
   $user_password = $_POST['user_password'];
   $user_date = date('d-m-y');
   

   move_uploaded_file($user_image_temp, "../images/$user_image");

   $harshformat ="$2y$10$";
   $salt = "iusesomecrazystrings22";
   $salty = $salt.$harshformat;
   $passsword = crypt($user_password,$salty);

   if(empty($user_image)){
        $query = "SELECT * from users WHERE user_id = '$edit_user_id' ";
        $select_image = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_image)){
                 $user_image = $row['user_image'];
        }
}

$query = "UPDATE users SET username='$username',user_password='$passsword',user_firstname='$user_firstname',
user_lastname='$user_lastname', user_email='$user_email',user_image='$user_image', user_role='$user_role',
user_date=now() WHERE user_id='$edit_user_id'";

$edit_user_query= mysqli_query($connection,$query);
confirmQuery($edit_user_query);
header("location: user.php");
     
}

?>

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
           <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
           <?php
           if($user_role == 'admin'){
             echo   "<option value='subscriber'>Subscriber</option>";
           }else{
             echo   "<option value='admin'>Admin</option>"; 
           }
      
           ?>

           </select>
    </div>
    <div class="form-group">
            
            <img src="../images/<?php echo $user_image ?>" alt="" width="100">
            <input type="file"  name="user_image">
    </div>
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
             <input  class="btn btn-primary" type="submit"  name="edit_user" value="edit user">
    </div>
</form>