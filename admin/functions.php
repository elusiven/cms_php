<?php

// CATEGORY FUNCTIONS START HERE

function insert_categories() {
    
    global $connection;

      if(isset($_POST['submit'])){
                            
                            $cat_title = $_POST['cat_title'];
                            
                            if($cat_title == "" || empty($cat_title)){
                                echo '<div class="alert alert-warning"><strong>Warning!</strong> This field should not be empty.</div>';
                            } else {
                                $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";
                                $add_category_query = mysqli_query($connection, $query);
                                
                                
                                if(!$add_category_query){
                                    die('<div class="alert alert-danger"><strong>Error!</strong> Could not add category to database.</div>') . mysqli_error($connection);
                                }
                            }
                            
                        }
    
}

function ShowAllCategories() {
    global $connection;
    
    // FIND ALL CATEGORIES 
               $query = "SELECT * FROM categories";
               $select_categories = mysqli_query($connection, $query);
                                ?>
                                <?php // DISPLAY ALL CATEGORIES IN A TABLE & LOOP
                                
                                 while($row = mysqli_fetch_assoc($select_categories)){
                                     
                                     $cat_id = $row['cat_id'];
                                     $cat_title = $row['cat_title'];
                    
                                     echo "<tr>";
                                     echo "<td>{$cat_id}</td>";
                                     echo "<td>{$cat_title}</td>";
                                     echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                     echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                     echo "</tr>";
              
                                 }
}

function DeleteCategory() {
     
    if(isset($_GET['delete'])){
        
         global $connection;
        
         $the_cat_id = $_GET['delete'];                           
         $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
         $delete_query = mysqli_query($connection, $query);
         header("Location: categories.php");
                                    
    }
}

// CATEGORY FUNCTIONS END HERE


// POSTS FUNCTIONS START HERE

function ShowAllPosts() {
    
    global $connection;
   
    $query = "SELECT * FROM posts";
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
         echo "<td>$post_id</td>";
         echo "<td>$post_author</td>";
         echo "<td>$post_title</td>";
         echo "<td>$post_cat</td>";
         echo "<td>$post_status</td>";
         echo "<td>$post_image</td>";
         echo "<td>$post_tags</td>";
         echo "<td>$post_comments</td>";
         echo "<td>$post_date</td>";
         echo "</tr>";
                                    
   }
}
?>