<?php


// Show a specific post to edit

if(isset($_GET['u_id'])){
    
    $u_id = $_GET['u_id'];
    
}

$query = "SELECT * FROM users WHERE id = {$u_id}";
$select_users_by_id = mysqli_query($connection, $query);
                                
      while($row = mysqli_fetch_assoc($select_users_by_id)) {
                                                             
        $user_username = $row['username'];
        $user_password = $row['password'];
        $user_firstname = $row['firstname'];
        $user_lastname = $row['lastname'];
        $user_image = $row['user_image'];
        $user_email = $row['email'];
        $user_role = $row['role'];
          
      }

if(isset($_POST['edit_user'])){
    
      $post_title = $_POST['post_title'];
      $post_category_id = $_POST['post_category'];
      $post_author = $_POST['post_author'];
      $post_status = $_POST['post_status'];
      $post_tags = $_POST['post_tags'];
      $post_image = $_FILES['image']['name'];
      $post_image_temp = $_FILES['image']['tmp_name'];
      $post_content = $_POST['post_content'];
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    if(empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $p_id ";
        $query_select_image = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($query_select_image)){
            $post_image = $row['post_image'];
        }
    }
    
    $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_category_id}', post_date = now(), post_author = '{$post_author}', post_status = '{$post_status}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_image = '{$post_image}' WHERE post_id = {$p_id}";
    
    $edit_post_query = mysqli_query($connection, $query);
    
    ConfirmQuery($edit_post_query);
    
}

?>
   

  
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $user_username; ?>">
    </div>
    <div class="form-group">
        <label for="title">Password</label>
        <input type="text" class="form-control" name="password" value="<?php echo $user_password; ?>">
    </div>
    <div class="form-group">
        <label for="post_status">First Name</label>
        <input type="text" class="form-control" name="firstname" value="<?php echo $user_firstname; ?>">
    </div>
       <div class="form-group">
        <label for="post_status">Last Name</label>
        <input type="text" class="form-control" name="lastname" value="<?php echo $user_lastname; ?>">
    </div>
       <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="text" class="form-control" name="email" value="<?php echo $user_email; ?>">
    </div>
    <div class="form-group">
        <label for="post_image">User Image</label><br>
        <img src="../images/avatars/<?php echo $user_image; ?>" alt="Image" width="100px"><br>
        <input type="file" name="image">
    </div>
    <div class="form-group">
       <label for="user_role">Role</label><br>
       <select name="role" id="">
          <?php 
            
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
                          
                 while($row = mysqli_fetch_assoc($select_users)){
                                     
                    $user_id = $row['id'];
                    $user_role = $row['role'];
                     
                    echo "<option value='$user_id'>$user_role</option>";  
                 }
            ?>
        </select>
    </div>
    <input type="submit" name="edit_user" class="btn btn-primary" value="Create New User">
</form>
   
  