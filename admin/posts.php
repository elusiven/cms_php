<?php include "includes/admin_header.php"; ?>
<?php include "functions.php"; ?>

<?php ob_start(); ?>


    <div id="wrapper">

       <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin Page
                            <small>Author</small>
                        </h1>
                                                
                      <?php
                        
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        } else {
                            $source = '';
                        }
                        
                        switch($source) {
                            case 'add_post';
                            include "includes/add_post.php";
                            break;
                            case '34';
                            echo "NICE";
                            break;
                            case '34';
                            echo "NICE";
                            break;
                                
                            default:
                            include "includes/view_all_posts.php";
                            break;
                        }
                        
                        ?>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>