
<?php

// Loop through each checkbox value and and assign it to a variable and then use it with switch statement on one condition. 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $checkBoxValue){
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options){
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue} ";
                    $update_post_published = mysqli_query($connection, $query);
                    ConfirmQuery($update_post_published);
                break;
                    
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue} ";
                    $update_post_draft = mysqli_query($connection, $query);
                    ConfirmQuery($update_post_draft);
                break;
                    
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue} ";
                    $delete_post = mysqli_query($connection, $query);
                    ConfirmQuery($delete_post);
                break;
            }
        }
    }
?>             
                         
                           <form action="" method="POST">
                          <table class="table table-bordered table-hover">
                          <div id="bulkOptionsContainer" class="col-xs-4">
                                <select class="form-control" name="bulk_options" id="">
                                <option value="">Select Options</option>
                                <option value="published">Publish</option>
                                <option value="draft">Draft</option>
                                <option value="delete">Delete</option>
                                </select>
                          </div>
                          <div class="col-xs-4">
                              <input type="submit" name="submit" class="btn btn-success" value="Apply"><a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
                          </div>
                           <thead>
                               <tr>
                                   <th><input id="selectAllBoxes" type="checkbox"></th>
                                   <th>Id</th>
                                   <th>Author</th>
                                   <th>Title</th>
                                   <th>Category</th>
                                   <th>Status</th>
                                   <th>Image</th>
                                   <th>Tags</th>
                                   <th>Comments</th>
                                   <th>Date</th>   
                                   <th>View</th>
                                   <th>Edit</th>
                                   <th>Delete</th>                            
                                   </tr>
                           </thead>
                           <tbody>
                            </form>
                          
                <?php   
    $query = "SELECT * FROM posts ";
    $select_posts = mysqli_query($connection, $query);
                                
      while($row = mysqli_fetch_assoc($select_posts)) {
                                   
                                    
         $post_id = $row['post_id'];
         $post_author = $row['post_author'];
         $post_title = $row['post_title'];
         $post_cat = $row['post_category_id'];
         $post_status = $row['post_status'];
         $post_image = $row['post_image'];
         $post_tags = $row['post_tags'];
         $post_comments = $row['post_comment_count'];
         $post_date = $row['post_date'];
                                    
         echo "<tr>";
         ?>
         <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
         <?php 
         echo "<td>$post_id</td>";
         echo "<td>$post_author</td>";
         echo "<a href='post.php?p_id={$post_id}'><td>$post_title</td></a>";
          
          $query = "SELECT * FROM categories WHERE cat_id = $post_cat ";
          $select_categories_id = mysqli_query($connection, $query);
                                
           while($row = mysqli_fetch_assoc($select_categories_id)){
                                     
             $cat_id = $row['cat_id'];
             $cat_title = $row['cat_title']; 
               
            echo "<td>{$cat_title}</td>";
               
           }

         echo "<td>$post_status</td>";
         echo "<td><img src='../images/$post_image' width='100px' alt='image'></td>";
         echo "<td>$post_tags</td>";
         echo "<td>$post_comments</td>";
         echo "<td>$post_date</td>";
         echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
         echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
         echo "<td><a href='posts.php?delete={$post_id}''>Delete</a></td>";
         echo "</tr>";
      }
         ?>
                           
                           </tbody>
                       </table>
                       

                       
                       
                       
<?php

  if(isset($_GET['delete'])) {
      
      $the_post_id = $_GET['delete'];
      
      $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
      
      $delete_post_query = mysqli_query($connection, $query);
      
      ConfirmQuery($delete_post_query);
      
      Header("Location: posts.php");
        
    }

?>

