<?php


function ConfirmQuery($result) {
    
    global $connection;
    
    if(!$result){
         die("QUERY FAILED." . mysqli_error($connection));
    }
}

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
         echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
         echo "<td><a href='posts.php?delete={$post_id}''>Delete</a></td>";
         echo "</tr>";
                                    
   }
}

// COMMENT FUNCTIONS START HERE

function ShowAllComments() {
    
    global $connection;
   
    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query);
                                
      while($row = mysqli_fetch_assoc($select_comments)) {
                                   
                                    
         $comment_id = $row['comment_id'];
         $comment_post_id = $row['comment_post_id'];
         $comment_author = $row['comment_author'];
         $comment_email = $row['comment_email'];
         $comment_content = $row['comment_content'];
         $comment_status = $row['comment_status'];
         $comment_date = $row['comment_date'];
                                    
         echo "<tr>";
         echo "<td>$comment_id</td>";
         echo "<td>$comment_author</td>";
         echo "<td>$comment_content</td>";
         echo "<td>$comment_email</td>";
         echo "<td>$comment_status</td>";
          
          $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
          $select_post_id_query = mysqli_query($connection, $query);
          while($row = mysqli_fetch_assoc($select_post_id_query)){
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];
          }
          
         echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
         echo "<td>$comment_date</td>";
         echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
         echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
         echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
         echo "</tr>";
                                    
   }
}

function DeleteComment() {
    
    if(isset($_GET['delete'])) {
           
        global $connection;
      
        $the_comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = $the_comment_id ";
        $delete_comment_query = mysqli_query($connection, $query);
      
        ConfirmQuery($delete_comment_query);
        header("Location: comments.php"); 
    }
}

function UnApproveComment() {
    
    if(isset($_GET['unapprove'])){
        
         global $connection;
        
         $the_comment_id = $_GET['unapprove'];                           
         $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
         $unapprove_comment_query = mysqli_query($connection, $query);
        
         ConfirmQuery($unapprove_comment_query);
         header("Location: comments.php");
        }
}

function ApproveComment() {
    
    if(isset($_GET['approve'])){
        
         global $connection;
        
         $the_comment_id = $_GET['approve'];                           
         $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
         $approve_comment_query = mysqli_query($connection, $query);
        
         ConfirmQuery($approve_comment_query);
         header("Location: comments.php");
        }
}

// USER FUNTIONS START HERE

function ShowALlUsers() {
    
    global $connection;
   
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);
                                
      while($row = mysqli_fetch_assoc($select_users)) {
                                   
                                    
         $user_id = $row['id'];
         $user_username = $row['username'];
         $user_password = $row['password'];
         $user_firstname = $row['firstname'];
         $user_lastname = $row['lastname'];
         $user_email = $row['email'];
         $user_image = $row['user_image'];
         $user_role = $row['role'];
                                    
         echo "<tr>";
         echo "<td>$user_id</td>";
         echo "<td>$user_username</td>";
         echo "<td>$user_firstname</td>";
         echo "<td>$user_lastname</td>";
         echo "<td>$user_email</td>";
         echo "<td>$user_role</td>";  
         echo "<td><a href='users.php?source=edit_user&u_id=$user_id'>Edit</a></td>";
         echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
         echo "</tr>";
    
      }
}

function DeleteUser() {
 
    if(isset($_GET['delete'])) {
           
        global $connection;
      
        $the_user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE id = $the_user_id ";
        $delete_user_query = mysqli_query($connection, $query);
      
        ConfirmQuery($delete_user_query);
        header("Location: users.php"); 
    
    }
}
?>