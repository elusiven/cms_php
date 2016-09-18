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
                              
                              <?php ShowAllComments(); ?>

                           </tbody>
                       </table>
                       
                       
<?php

  if(isset($_GET['delete'])) {
      
      $the_comment_id = $_GET['delete'];
      
      $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
      
      $delete_comment_query = mysqli_query($connection, $query);
      
      ConfirmQuery($delete_comment_query);
      
      Header("Location: comments.php");
        
    }

?>

