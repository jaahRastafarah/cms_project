<table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Email</th>
                <th>Image</th>
                <th>Role</th> 
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                $query="SELECT * FROM users";
                $select_users= mysqli_query($connection,$query);
                while($row= mysqli_fetch_assoc($select_users)){
                $user_id = $row['user_id'];
                $username  = $row['username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
                $user_date  = $row['user_date'];

                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td>$username</td>";
                echo "<td>$user_firstname</td>";

                // $query="SELECT * FROM categories WHERE cat_id = '$post_category_id' ";
                // $select_categories= mysqli_query($connection,$query);
                //  confirmQuery($select_categories);
     
                // while($row= mysqli_fetch_assoc($select_categories)){
                //     $cat_id = $row['cat_id'];
                //     $cat_title = $row['cat_title'];

                //   echo "<td>$cat_title</td>";
                // }
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";
                echo "<td><img src='../images/$user_image' alt='image' width='100'></td>";
                echo "<td>$user_role</td>";
                echo "<td>$user_date</td>";
                echo "<td><a href='user.php?change_to_admin={$user_id}'>Admin</a></td>";
                echo "<td><a href='user.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
                echo "<td><a href='user.php?source=edit_user&edit_user={$user_id}'>edit</a></td>";
                echo "<td><a href='user.php?delete={$user_id}'>delete</a></td>";
                
                echo "</tr>";

                if(isset($_GET['delete'])){
                    if (isset($_SESSION['user_role'])){
                     if($_SESSION['user_role'] == 'admin'){     
                     $del_user_id = mysqli_real_escape_string($connection, $_GET['delete']) ;
                     $query = "DELETE FROM users  WHERE user_id = '$del_user_id'";
                     $del_user_query = mysqli_query($connection, $query);
                     confirmQuery($del_user_query);
                     header("Location: user.php");
                    }
                  }
                }
                
               if(isset($_GET['change_to_admin'])) {
                $change_user_id = $_GET['change_to_admin'];
                $query = "UPDATE users SET user_role ='admin' WHERE user_id= '$change_user_id' ";
                $change_admin_query = mysqli_query($connection, $query);
                confirmQuery($change_admin_query);
                header("Location: user.php");
               }

               if(isset($_GET['change_to_subscriber'])) {
                $change_user_id = $_GET['change_to_subscriber'];
                $query = "UPDATE users SET user_role ='subscriber' WHERE user_id= '$change_user_id' ";
                $change_subscriber_query = mysqli_query($connection, $query);
                confirmQuery($change_subscriber_query);
                header("Location: user.php");
               }

            
                }
            
            ?>
         
        </tbody>
    </table>
