<?php include "includes/admin_header.php" ?>

    <div id="wrapper">
        <?php
        
        ?>
        
   

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Welcome to Admin
                           
                            <small><?php echo $_SESSION['firstname']?></small>
                        </h1>
                    
                      
                    </div>
                </div>
                <!-- /.row -->
                        
                <!-- /.row -->
                
             <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php
                                $query ="SELECT * FROM posts";
                                $post_query = mysqli_query($connection, $query);
                                confirmQuery($post_query);
                                $post_count = mysqli_num_rows($post_query);
                               
                                ?>

                                <div class='huge'><?php echo $post_count ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php
                                $query ="SELECT * FROM comments";
                                $comments_query = mysqli_query($connection, $query);
                                confirmQuery($comments_query);
                                $comments_count = mysqli_num_rows($comments_query);
                               
                                ?>


                                    <div class='huge'><?php echo $comments_count ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comment.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php
                                $query ="SELECT * FROM users";
                                $user_query = mysqli_query($connection, $query);
                                confirmQuery($post_query);
                                $user_count = mysqli_num_rows($user_query);
                               
                                ?>
                                <div class='huge'><?php echo $user_count ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="user.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php
                                $query ="SELECT * FROM categories";
                                $category_query = mysqli_query($connection, $query);
                                confirmQuery($category_query);
                                $category_count = mysqli_num_rows($category_query);
                               
                                ?>
                                    <div class='huge'><?Php echo $category_count?></div>
                                        <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                </div>
                <!-- /.row -->
                <?php
                $query ="SELECT * FROM posts WHERE post_status='Published'";
                $select_all_published_post = mysqli_query($connection, $query);
                confirmQuery( $select_all_published_post);
                $post_published_count = mysqli_num_rows($select_all_published_post);

                 $query ="SELECT * FROM posts WHERE post_status='draft'";
                 $select_all_draft_post = mysqli_query($connection, $query);
                 confirmQuery( $select_all_draft_post);
                 $post_draft_count = mysqli_num_rows($select_all_draft_post);

                 $query ="SELECT * FROM comments WHERE comment_status='unapproved'";
                 $select_all_unapproved_status = mysqli_query($connection, $query);
                 confirmQuery(  $select_all_unapproved_status);
                 $unapproved_comments_count = mysqli_num_rows($select_all_unapproved_status);

                 $query ="SELECT * FROM users WHERE user_role='subscriber'";
                 $select_all_sub_user = mysqli_query($connection, $query);
                 confirmQuery( $select_all_sub_user);
                 $sub_user_count = mysqli_num_rows($select_all_sub_user);


                ?>


                  <div class="row">
                    <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                    ['Data', 'Counts'],
                     <?php
                     $element_text =['All posts','Active Posts', 'Draft posts','Comments', 'unapproved comments','Users', 'Subscribers Users','Categories'];  
                     $element_count =[$post_count, $post_published_count, $post_draft_count, $comments_count,  $unapproved_comments_count, $user_count, $sub_user_count, $category_count]; 
                     
                     for($i=0; $i< 8; $i++){
                          echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                     }
                     
                     
                     
                     
                     
                     ?>

                    // ['Posts', 1000],
                    ]);

                    var options = {
                    chart: {
                    title: '',
                    subtitle: '',
                    }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    </script>
                  
                  
                  
                  <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                  
                  
                  
                  
                  </div>
                     



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php" ?>