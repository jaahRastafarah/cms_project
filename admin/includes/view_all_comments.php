<table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>In Response to</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                $query="SELECT * FROM comments";
                $select_comment= mysqli_query($connection,$query);
                while($row= mysqli_fetch_assoc($select_comment)){
                $comment_id = $row['comment_id'];
                $comment_post_id  = $row['comment_post_id'];
                $comment_author  = $row['comment_author'];
                $comment_content  = $row['comment_content'];
                $comment_email  = $row['comment_email'];
                $comment_status  = $row['comment_status'];
                $comment_date  = $row['comment_date'];
               

                echo "<tr>";
                echo "<td>$comment_id</td>";
                echo "<td>$comment_author</td>";
                echo "<td>$comment_content</td>";

                // $query="SELECT * FROM categories WHERE cat_id = '$post_category_id' ";
                // $select_categories= mysqli_query($connection,$query);
                //  confirmQuery($select_categories);
     
                // while($row= mysqli_fetch_assoc($select_categories)){
                //     $cat_id = $row['cat_id'];
                //     $cat_title = $row['cat_title'];

                //   echo "<td>$cat_title</td>";
                // }
                echo "<td>$comment_email</td>";
                echo "<td>$comment_status </td>";
                 
                $query = "SELECT * FROM posts WHERE post_id = '$comment_post_id' ";
                $select_post_id_query = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_post_id_query)){
                       $post_id = $row['post_id'];
                       $post_title = $row['post_title'];
                       echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
                }


                
                echo "<td>$comment_date</td>";
                echo "<td><a href='comment.php?approved={$comment_id}'>Approve</a></td>";
                echo "<td><a href='comment.php?unapproved={$comment_id}'>Unapprove</a></td>";
                
                echo "<td><a href='comment.php?delete={$comment_id}'>delete</a></td>";
                
                echo "</tr>";

                if(isset($_GET['delete'])) {
                     $comment_post_id = $_GET['delete'];
                     $query = "DELETE FROM comments WHERE comment_id = '$comment_post_id'";
                     $del_post_query = mysqli_query($connection, $query);
                     confirmQuery($del_post_query);
                     header("Location: comment.php");
                }

              

               if(isset($_GET['approved'])) {
                $comment_post_id = $_GET['approved'];
                $query = "UPDATE comments SET comment_status='approved' WHERE comment_id= '$comment_post_id' ";
                $approve_comment_query = mysqli_query($connection, $query);
                confirmQuery($approve_comment_query);
                header("Location: comment.php");
               }

               if(isset($_GET['unapproved'])) {
                $comment_post_id = $_GET['unapproved'];
                $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id= '$comment_post_id' ";
                $unapprove_comment_query = mysqli_query($connection, $query);
                confirmQuery($unapprove_comment_query);
                header("Location: comment.php");
              }


            
                }
            
            ?>
         
        </tbody>
    </table>
