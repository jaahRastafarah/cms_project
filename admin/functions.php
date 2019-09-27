<?php include "../includes/db.php" ?>

<?php
function escape ($string){
  global $connection;
  return  mysqli_real_escape_string($connection, trim($string));
}

function users_online(){
    if(isset($_GET['onlineusers'])){
    global $connection;

    if(!$connection){
         session_start();
         include ("../includes/db.php");

         $session = session_id();
         $time = time();
         $time_out_in_seconds = 05;
         $time_out = $time - $time_out_in_seconds;
     
         $query = "SELECT * FROM users_online WHERE session='$session'";
         $send_query = mysqli_query($connection, $query);
       
         $count = mysqli_num_rows($send_query);
         if($count == NULL){
           mysqli_query($connection,"INSERT INTO users_online(session,time) VALUES('$session','$time')");
         }else{
           mysqli_query($connection,"UPDATE users_online SET time='$time' WHERE session='$session'"); 
         }
         $users_online_query =  mysqli_query($connection,"SELECT * FROM users_online WHERE time>'$time_out'");
         echo  $count_user = mysqli_num_rows($users_online_query);   
    }
  }
}
users_online();





function confirmQuery($result){
    global $connection;
    if(!$result){
    die("failed". mysqli_error($connection));
    }
}


function insert_categories(){

   global $connection;

        if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title){
            $query ="INSERT INTO categories(cat_title) VALUES('{$cat_title}')";
            $create_category_query = mysqli_query($connection, $query);
            if (!$create_category_query){
                die("failed". mysqli_error($connection));
            } 
        }
        else{
            echo "this field can not be empty";
        }
        }

        ?>
        <form action="" method="post">
        <div class="form-group">
            <label for="cat-title">Add Category</label>
            <input type="text" class="form-control" name="cat_title">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="submit" value="Add category">
        </div>
        </form>

        <?php
        if(isset($_GET['edit'])){
            
        $cat_id= $_GET['edit'];
        include "includes/update_categories.php";
        }
      
}

function FindAllCategories(){
    global $connection;
    $query="SELECT * FROM categories";
    $select_all_categories= mysqli_query($connection,$query);
    while($row= mysqli_fetch_assoc($select_all_categories)){
    $cat_id = $row['cat_id'];
    $cat_title  = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
    

}


function deletequery(){
    global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query="DELETE FROM categories WHERE cat_id =  '$the_cat_id'";
        $delete_query = mysqli_query($connection, $query);
        header("location: categories.php");

    }

}











?>