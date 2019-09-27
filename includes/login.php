<?php include "db.php" ?>
<?php session_start(); ?>


<?php
if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  if($username && $password){
    $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);

    $query = "SELECT * FROM users WHERE username='{$username}'";
    $find_user_query = mysqli_query($connection,$query);
    if(!$find_user_query){
          die("failed". mysqli_error($connection));
    }
    while($row=mysqli_fetch_assoc($find_user_query)){
          $db_user_id = $row['user_id'];
          $db_username = $row['username'];
          $db_user_password = $row['user_password'];
          $db_user_firstname = $row['user_firstname'];
          $db_user_lastname = $row['user_lastname'];
          $db_user_role = $row['user_role'];
    }

//     $password = crypt($password2,$db_user_password);
    if($username !== $db_username && $password !== $db_user_password){
          header("location: ../index.php");
    }
    else {
          $_SESSION['username'] = $db_username;
          $_SESSION['firstname'] = $db_user_firstname;
          $_SESSION['lastname'] = $db_user_lastname;
          $_SESSION['user_role'] = $db_user_role;



          header("location: ../admin/index.php");
    }
    }
    else{
      header("location: ../index.php");
      }
    
  //   $query = "SELECT * FROM users WHERE username='{$username}' AND user_password ='{$password}'";
  //   $find_user_query = mysqli_query($connection,$query);
  //   if(!$find_user_query){
  //         die("failed". mysqli_error($connection));
  //   }
  //   $result = mysqli_num_rows($find_user_query);
  //     if($result > 0){
  //       $row= mysqli_fetch_assoc($find_user_query);
  //       $user_firstname = $row['user_firstname'];
  //       $user_lastname = $row['user_lastname'];
  //       header("Location: ../admin/index.php");
  //     }
  //        else{
  //          header("Location: ../index.php");
  //        }
  //   }  
  // else{
  //   header("Location: ../index.php"); 

  // }



}

?>