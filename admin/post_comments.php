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
                            Welcome to Admin Page
                            <small>Author</small>
                        </h1>
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
                              
                              <?php ShowPostComments(); ?>

                           </tbody>
                       </table>
                    </div>
                </div>
            </div>
                       
                       
<?php

    DeleteComment();
    UnApproveComment();
    ApproveComment();

?>

