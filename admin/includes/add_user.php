<?php
if(isset($_POST['create_user'])){
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

   $query ="INSERT INTO users(username,user_password,user_firstname,user_lastname,
   user_email,user_image,user_role, user_date) VALUES ('$username','$user_password','$user_firstname', '$user_lastname',
   '$user_email','$user_image','$user_role',now()) ";
   

    $create_user_query = mysqli_query($connection,$query);
               confirmQuery($create_user_query);
    echo "User Created:". " " . "<a href='user.php'> View User </a> ";
     
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
            <label for="user_lastname">Last Name</label>
            <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
           <select name="user_role" id="">
           <option value="subscriber ">Select Option</option>
           <option value="admin">Admin</option>
           <option value="subscriber">Subscriber</option>
           </select>
    </div>
    <div class="form-group">
            <label for="user_image">User Images</label>
            <input type="file"  name="user_image">
    </div>
    <div class="form-group">
            <label for="post_tags">Username</label>
            <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
            <label for="post_tags">Email</label>
            <input type="text" class="form-control" name="user_email">
    </div>
    <div class="form-group">
            <label for="post_tags">Password</label>
            <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
             <input  class="btn btn-primary" type="submit"  name="create_user" value="Add post">
    </div>
</form>