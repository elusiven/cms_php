<?php

if(isset($_POST['create_user'])){

    $user_username = $_POST['username'];
    $user_password = $_POST['password'];
    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    $user_email = $_POST['email'];
    $user_role = $_POST['role'];
    
    move_uploaded_file($user_image_temp, "../images/avatars/$user_image");
    
    $password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
    
    $query = "INSERT INTO users(username, password, firstname, lastname, user_image, email, role) VALUES ('{$user_username}', '{$password}', '{$user_firstname}', '{$user_lastname}', '{$user_image}', '{$user_email}', '{$user_role}') ";
    
    $add_user_query = mysqli_query($connection, $query);
    
    ConfirmQuery($add_user_query);
    
    echo "<div class='alert alert-success'><strong>User Created:</strong> " . " " . "<a href='users.php'>View Users</a></div>";
}


?>
   

   
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="title">Password</label>
        <input type="text" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label for="post_status">First Name</label>
        <input type="text" class="form-control" name="firstname">
    </div>
       <div class="form-group">
        <label for="post_status">Last Name</label>
        <input type="text" class="form-control" name="lastname">
    </div>
       <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="text" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
       <label for="user_role">Role</label><br>
       <select name="role" id="">
          <option value="admin">Admin</option>
          <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <input type="submit" name="create_user" class="btn btn-primary" value="Create New User">
</form>