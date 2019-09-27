<?php
if(isset($_GET['p_id'])){
$edit_id = $_GET['p_id'];
}

$query="SELECT * FROM posts where post_id = '$edit_id'";
$select_posts_by_id= mysqli_query($connection,$query);
while($row= mysqli_fetch_assoc($select_posts_by_id)){
        $post_id = $row['post_id'];
        $post_author  = $row['post_author'];
        $post_title  = $row['post_title'];
        $post_category_id  = $row['post_category_id'];
        $post_status  = $row['post_status'];
        $post_image  = $row['post_image'];
        $post_tags  = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_date  = $row['post_date'];
}
     if(isset($_POST['update_post'])){
        $post_title = $_POST['title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['status'];
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)){
                $query = "SELECT * from posts WHERE post_id = '$edit_id' ";
                $select_image = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_image)){
                         $post_image = $row['post_image'];
                }
        }

        $query = "UPDATE posts SET post_author='$post_author',post_title='$post_title',post_category_id='$post_category_id',
                  post_date=now(), post_status='$post_status',post_tags='$post_tags', post_image='$post_image' WHERE  
                  post_id='$post_id'";

                $edit_query_update= mysqli_query($connection,$query);
                confirmQuery($edit_query_update);
                // header("location: posts.php");
                echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$edit_id}'>View Post</a> or <a href='./posts.php'> Edit more post</a></p>";


       }?>



<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" value = "<?php echo $post_title; ?>" class="form-control" name="title">
    </div>
    <div class="form-group">
           <select name="post_category" id="">
           <?php
           $query="SELECT * FROM categories";
           $select_categories= mysqli_query($connection,$query);
            confirmQuery($select_categories);

           while($row= mysqli_fetch_assoc($select_categories)){
               $cat_id = $row['cat_id'];
               $cat_title = $row['cat_title'];
               echo  "<option value='$cat_id'>$cat_title</option>";
           }?>
           
           </select>
    </div>
    <div class="form-group">
            <label for="post_author">Post Author</label>
            <input type="text" value = "<?php echo $post_author; ?>" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <select name="status" id="">
        <option value="<?php echo $post_status; ?>"><?php echo $post_status;?></option>

        <?php
        if($post_status == published){
        echo "<option value='draft'>Draft</option>";
        }
        else{
         echo "<option value='published'>Published</option>";    
        }
        
        
        ?>
        
        </select>
   </div>



    <!-- <div class="form-group">
            <label for="post_status">Post Status</label>
            <input type="text" value = "<?php echo $post_status; ?>" class="form-control" name="status">
    </div> -->
    <div class="form-group">
         <img src="../images/<?php echo $post_image; ?>" alt="" width="100">
         <input type="file" name="post_image">
    </div>
    <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input type="text" value = "<?php echo $post_tags; ?>" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea type="text"  class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
             <input  class="btn btn-primary" type="submit"  name="update_post" value="Update post">
    </div>
</form>