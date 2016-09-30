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
                            
                            $cat_title = escape($_POST['cat_title']);
                            
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
                                     echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                     echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                     echo "</tr>";
              
                                 }
}

function DeleteCategory() {
     
    if(isset($_GET['delete'])){
        
         global $connection;
        
         $the_cat_id = escape($_GET['delete']);                           
         $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
         $delete_query = mysqli_query($connection, $query);
         header("Location: categories.php");
                                    
    }
}

// POSTS FUNCTIONS START HERE

function ShowAllPosts() {
    
                                
}

function checkStatus($table,$column,$status) {
    
    global $connection;
    
    $query = "SELECT * from $table WHERE $column = '$status' ";
    $result = mysqli_query($connection, $query);
    ConfirmQuery($result);
    return mysqli_num_rows($result);
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
          
          $comment_post_query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
          $select_post_id_query = mysqli_query($connection, $comment_post_query);
          while($row = mysqli_fetch_assoc($select_post_id_query)){
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];
          }
         
         ConfirmQuery($select_post_id_query);
          
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

// COMMENTS FOR SPECIFIC POSTS

function ShowPostComments() {
    
    global $connection;
    
    $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_reaL_escape_string($connection, $_GET['id']) . " ";
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
         echo "<td><a href='post_comments.php?approve=$comment_id'>Approve</a></td>";
         echo "<td><a href='post_comments.php?unapprove=$comment_id'>Unapprove</a></td>";
         echo "<td><a href='post_comments.php?delete=$comment_id'>Delete</a></td>";
         echo "</tr>";
      }
}

// USER FUNTIONS START HERE

function ShowAllUsers() {
    
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
        
        if(isset($_SESSION['user_role'])){
            if($_SESSION['user_role'] === 'admin'){
        
        $the_user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE id = $the_user_id ";
        $delete_user_query = mysqli_query($connection, $query);
      
        ConfirmQuery($delete_user_query);
        header("Location: users.php");
           }
        }
    }
}

function users_online() {
    

        if(isset($_GET['onlineusers'])){
        
        global $connection;
            
        if(!$connection){
            session_start();
            include("../includes/db.php");
            
            
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;
        
        $query = "SELECT * from users_online WHERE session = '$session' ";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);
        
        if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time') ");
        } else {
            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
        }
        
        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
        echo $count_user = mysqli_num_rows($users_online_query);
            
            
            }  // Connection ends here               
        } // Get Request ends here 
}

users_online();

function escape($string) {
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

?>