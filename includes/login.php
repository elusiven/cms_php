<?php include "db.php";

include "../admin/functions.php";

session_start();


if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
}
    
mysqli_real_escape_string($connection, $username);
mysqli_real_escape_string($connection, $password);

$query = "SELECT * FROM users WHERE username = '{$username}' ";
$select_user_query = mysqli_query($connection, $query);

ConfirmQuery($select_user_query);

while($row = mysqli_fetch_array($select_user_query)){
    
    $id = $row['id'];
    $user = $row['username'];
    $pass = $row['password'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $role = $row['role'];
}

if(password_verify($password, $pass) && $username === $user) {
    
    $_SESSION['id'] = $id;
    $_SESSION['username'] = $user;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['role'] = $role;
    $_SESSION['password'] = $pass;
    header('Location: ../admin/index.php');
    
} else {
    
    header('Location: ../index.php');
}

?>