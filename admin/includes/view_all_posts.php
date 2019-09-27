<?php
include ("delete_modal.php ");

?>
<?php
if(isset($_POST['checkBoxArray'])){
  foreach($_POST['checkBoxArray'] as $checkBoxValue){
     $bulkoption = $_POST['bulk_options'];

     switch($bulkoption){
        case 'published':
        $query="UPDATE posts SET post_status ='$bulkoption' WHERE post_id = '$checkBoxValue'";
        $update_post = mysqli_query($connection, $query);
        break;
        case 'draft':
        $query="UPDATE posts SET post_status ='$bulkoption' WHERE post_id = '$checkBoxValue'";
        $update_post = mysqli_query($connection, $query);
        break;
        case 'delete':
        $query="DELETE from posts WHERE post_id = '$checkBoxValue'";
        $delete_post = mysqli_query($connection, $query);
        break;
        case 'clone':
          $query="SELECT * FROM posts   WHERE  post_id = '$checkBoxValue'";
          $select_posts_query= mysqli_query($connection,$query);
          while($row= mysqli_fetch_assoc($select_posts_query)){
          $post_author  = $row['post_author'];
          $post_title  = $row['post_title'];
          $post_category_id  = $row['post_category_id'];
          $post_status  = $row['post_status'];
          $post_image  = $row['post_image'];
          $post_tags  = $row['post_tags'];
          $post_comment_count  = $row['post_comment_count'];
          $post_date  = $row['post_date'];

   $query ="INSERT INTO posts(post_category_id,post_title,post_author,post_date,
   post_image,post_tags,post_status) ";
   $query .= "VALUES($post_category_id,'$post_title','$post_author', now(),
              '$post_image','$post_tags','$post_status') ";
      $copy_query= mysqli_query($connection, $query);
      if(!$copy_query){
            die("failed".mysqli_error($connection));
      }

        break;
     }
  }
}
}
?>




<form action="" method="post">
  <div id="bulkOptionContainer" class="col-xs-4 form-group">

     <select name="bulk_options" id="" class="form-control">
        <option value=""> Select Option</option>
        <option value="published"> Publish</option>
        <option value="draft"> Draft</option>
        <option value="delete"> Delete</option>
        <option value="clone"> Clone</option>
     </select>

  </div>   
     
  <div class="col-xs-4 form-group">
  <input type="submit" name="submit" class="btn btn-success" value="apply">
  <a href="./posts.php?source=add_post" class="btn btn-primary">Add New</a>
  
  </div>
  
  
  


    <table class="table table-bordered table-hover">
        <thead>
            <tr>

                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>S/N</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            $i=1;
                $query="SELECT * FROM posts ORDER BY post_id DESC ";
                $select_posts= mysqli_query($connection,$query);
                while($row= mysqli_fetch_assoc($select_posts)){
                $post_id = $row['post_id'];
                $post_author  = $row['post_author'];
                $post_title  = $row['post_title'];
                $post_category_id  = $row['post_category_id'];
                $post_status  = $row['post_status'];
                $post_image  = $row['post_image'];
                $post_tags  = $row['post_tags'];
                $post_comment_count  = $row['post_comment_count'];
                $post_date  = $row['post_date'];
     
             
                echo "<tr>";
                ?>
               <td><input class="checkboxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id ?>"></td>


                <?php
                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_title</td>";

                $query="SELECT * FROM categories WHERE cat_id = '$post_category_id' ";
                $select_categories= mysqli_query($connection,$query);
                 confirmQuery($select_categories);
     
                while($row= mysqli_fetch_assoc($select_categories)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                  echo "<td>$cat_title</td>";
                }
                echo "<td>$post_status</td>";
                echo "<td><img src='../images/$post_image' alt='image' width='100'></td>";
                echo "<td>$post_tags</td>";
                echo "<td>$post_comment_count</td>";
                echo "<td>$post_date</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>edit</a></td>";
                echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>delete</a></td>";
                // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}'>delete</a></td>";
                
                echo "</tr>";

                if(isset($_GET['delete'])){
                     $del_post_id = $_GET['delete'];
                     $query = "DELETE FROM posts WHERE post_id = '$del_post_id'";
                     $del_post_query = mysqli_query($connection, $query);
                     confirmQuery($del_post_query);
                     header("Location: posts.php");
                }

            
                }
            
            ?>
         
        </tbody>
    </table>
</form>
<script>
$(document).ready(function(){
$(" .delete_link").on('click', function(){
  var id = $(this).attr("rel");
 
  var delete_url = "posts.php?delete="+id+"";
  $(".modal_delete_link").attr("href", delete_url);
  $("#myModal").modal('show');
  // alert(delete_url);
});
});



</script> 