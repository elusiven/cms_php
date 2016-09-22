<?php include "includes/admin_header.php"; ?>
<?php include "functions.php"; ?>

<?php ob_start(); ?>

<?php  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_profile_query = mysqli_query($connection, $query);
    ConfirmQuery($select_user_profile_query);
    
    while($row = mysqli_fetch_array($select_user_profile_query)){
        
         $user_id = $row['id'];
         $user_username = $row['username'];
         $user_password = $row['password'];
         $user_firstname = $row['firstname'];
         $user_lastname = $row['lastname'];
         $user_email = $row['email'];
         $user_role = $row['role'];
        
    }
}
 
if(isset($_POST['edit_user'])){
    
        $user_username = $_POST['username'];
        $user_password = $_POST['password'];
        $user_firstname = $_POST['firstname'];
        $user_lastname = $_POST['lastname'];
        $user_email = $_POST['email'];
        $user_role = $_POST['role'];
    
    $query = "UPDATE users SET username = '{$user_username}', password = '{$user_password}', firstname = '{$user_firstname}', lastname = '{$user_lastname}', email = '{$user_email}', role = '{$user_role}' WHERE username = '{$username}'";
    
    $edit_post_query = mysqli_query($connection, $query);
    
    ConfirmQuery($edit_post_query);
    header("Location: users.php");
    
}


    
?>

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
                          
                                                <!--- FORM STARTS HERE -->                      
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $user_username; ?>">
    </div>
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" class="form-control" name="password" value="<?php echo $user_password; ?>">
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
    <input type="submit" name="edit_user" class="btn btn-primary" value="Update Profile">
</form>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>