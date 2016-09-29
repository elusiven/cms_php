<?php


// Show a specific post to edit

if(isset($_GET['p_id'])){
    
    $p_id = $_GET['p_id'];
    
}

$query = "SELECT * FROM posts WHERE post_id = {$p_id}";
$select_posts_by_id = mysqli_query($connection, $query);
                                
      while($row = mysqli_fetch_assoc($select_posts_by_id)) {
                                                             
         $post_id = $row['post_id'];
         $post_user = $row['post_user'];
         $post_title = $row['post_title'];
         $post_cat = $row['post_category_id'];
         $post_status = $row['post_status'];
         $post_image = $row['post_image'];
         $post_tags = $row['post_tags'];
         $post_content = $row['post_content'];
         $post_comments = $row['post_comment_count'];
         $post_date = $row['post_date'];
          
      }

if(isset($_POST['edit_post'])){
    
      $post_title = $_POST['post_title'];
      $post_category_id = $_POST['post_category'];
      $post_user = $_POST['post_user'];
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
    
    $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_category_id}', post_date = now(), post_user = '{$post_user}', post_status = '{$post_status}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_image = '{$post_image}' WHERE post_id = {$p_id}";
    
    $edit_post_query = mysqli_query($connection, $query);
    
    ConfirmQuery($edit_post_query);
    
    echo "<div class='alert alert-success'><strong>Post Successfuly Updated.</strong> <a href='../post.php?p_id={$post_id}'>View Post</a> or go back to <a href='posts.php'>All Posts</a></div>";
    
}

?>
   

   
   <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <select name="post_category" id="">

           <?php 
            
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
                          
                 while($row = mysqli_fetch_assoc($select_categories)){
                                     
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                     
                    echo "<option value='$cat_id'>$cat_title</option>";  
                 }
            ?>
        </select>
    </div>
   <div class="form-group">
       <select name="post_user" id="">
           <?php echo "<option value='$post_user'>$post_user</option>"; ?>
           <?php
           
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query); 
           
                while($row = mysqli_fetch_assoc($select_users)){
                    $user_id = $row['id'];
                    $username = $row['username'];
                    
                    echo "<option value='$username'>$username</option>";
                }
           
           ?>
       </select>
   </div>
    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" id="post_status">
           <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
           <?php
           if($post_status === 'published'){
            echo "<option value='draft'>Draft</option>";  
           } else {
            echo "<option value='published'>Published</option>";  
           }
           ?>
            
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label><br>
        <img src="../images/<?php echo $post_image; ?>" alt="Image" width="100px"><br>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="10" class="form-control"><?php echo $post_content; ?></textarea>
    </div>
    <input type="submit" name="edit_post" class="btn btn-primary" value="Edit Post">
</form>
