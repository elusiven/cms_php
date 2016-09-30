<?php include "includes/admin_header.php"; ?>
   <?php include "functions.php"; ?>
    <div id="wrapper">
      <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome back, <?php echo $_SESSION['username']; ?>.
                        </h1>
                    </div>
                </div>
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
                     
                        $query = "SELECT * from posts ";
                        $select_posts = mysqli_query($connection, $query);
                        $post_count = mysqli_num_rows($select_posts);
                        
                    ?>
                  <div class='huge'><?php echo $post_count; ?></div>
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
                    
                        $query = "SELECT * from comments ";
                        $select_comments = mysqli_query($connection, $query);
                        $comment_count = mysqli_num_rows($select_comments);
                        
                    ?>
                     <div class='huge'><?php echo $comment_count; ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
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
                        $query = "SELECT * from users ";
                        $select_users = mysqli_query($connection, $query);
                        $user_count = mysqli_num_rows($select_users);
                       ?>
                    <div class='huge'><?php echo $user_count; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
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
                       $query = "SELECT * from categories ";
                        $select_categories = mysqli_query($connection, $query);
                        $categories_count = mysqli_num_rows($select_categories);
                        ?>
                        <div class='huge'><?php echo $categories_count; ?></div>
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
                // Get count of published posts
               
                $post_published_count = checkStatus('posts','post_status','published');
                // Get count of draft posts
                $post_draft_count = checkStatus('posts','post_status','draft');
                // Get count of unapproved comments
                $comment_unapproved_count = checkStatus('comments','comment_status','unapproved');
                // Get count of subscribers
                $user_role_count = checkStatus('users','role','subscriber');
            ?>
                
                
            <div class="row">
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Statistics','Count'],
            
              <?php
                
                $element_text = ['All Posts', 'Published Posts', 'Draft Posts', 'Comments', 'Draft Comments', 'Users', 'Subscribers', 'Categories'];
                $element_count = [$post_count, $post_published_count,$post_draft_count, $comment_count, $comment_unapproved_count, $user_count, $user_role_count, $categories_count];
                
                for($i = 0; $i < 8; $i++) {
                    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                }
                
                
                ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
        <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>