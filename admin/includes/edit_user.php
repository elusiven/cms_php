<?php


// Show a specific post to edit

if(isset($_GET['u_id'])){
    
    $u_id = $_GET['u_id'];
    
}

$query = "SELECT * FROM users WHERE id = {$u_id}";
$select_users_by_id = mysqli_query($connection, $query);
                                
      while($row = mysqli_fetch_assoc($select_users_by_id)) {
                                                             
        $user_username = $row['username'];
        $db_password = $row['password'];
        $user_firstname = $row['firstname'];
        $user_lastname = $row['lastname'];
        $user_image = $row['user_image'];
        $user_email = $row['email'];
        $user_role = $row['role'];
          
      }


if(isset($_POST['edit_user'])){
    
        $user_username = escape($_POST['username']);
        $user_password = escape($_POST['password']);
        $user_firstname = escape($_POST['firstname']);
        $user_lastname = escape($_POST['lastname']);
        $user_email = escape($_POST['email']);
        $user_role = escape($_POST['role']);
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
    
    move_uploaded_file($user_image_temp, "../images/$user_image");
    
    if(empty($post_image)) {
        $query = "SELECT * FROM users WHERE id = $u_id ";
        $query_select_image = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($query_select_image)){
            $user_image = $row['user_image'];
        }
    }
    
    $user_password = mysqli_real_escape_string($connection, $user_password);

    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

    $query_with_pass = "UPDATE users SET username = '{$user_username}', password = '{$hashed_password}', firstname = '{$user_firstname}', lastname = '{$user_lastname}', user_image = '{$user_image}', email = '{$user_email}', role = '{$user_role}' WHERE id = {$u_id}";
    
    $query = "UPDATE users SET username = '{$user_username}', firstname = '{$user_firstname}', lastname = '{$user_lastname}', user_image = '{$user_image}', email = '{$user_email}', role = '{$user_role}' WHERE id = {$u_id}";
    
    if(!empty($_POST['password']) && !empty($_POST['username']) && !empty($_POST['email'])){
        
        if($user_password === $db_password){
            // pass is same
            $edit_user = mysqli_query($connection, $query);
            $message = "<div class='alert alert-success'><strong>User has been successfuly edited.</strong> <a href='users.php'>View All Users</a></div>";
        } else {
            // pass is different
            $edit_user_withpass = mysqli_query($connection, $query_with_pass);
            header('Location: ../includes/logout.php');
        }
        
    } else {
        
        $message = "<div class='alert alert-danger'><strong>Missing Information.</strong> Fields cannot be empty.</div>";
        
    }
    
} else {
    $message = "";
}

?>
   

  
  <form action="" method="POST" enctype="multipart/form-data">
   <?php echo $message; ?>
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $user_username; ?>">
    </div>
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" class="form-control" name="password" value="<?php echo $db_password; ?>">
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
       <select name="role" id="" value="Select Roles">
       <option value="<?php echo $user_role; ?>">Select Role</option>
           <?php
           if ($user_role == 'admin'){
                echo "<option value='subscriber'>Subscriber</option>";
           } else {
               echo "<option value='admin'>Admin</option>";
           }
           ?>
           
           
        </select>
    </div>
    <input type="submit" name="edit_user" class="btn btn-primary" value="Update User">
</form>
   
  