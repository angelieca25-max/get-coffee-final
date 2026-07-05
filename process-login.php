<?php
session_start();
include 'connection.php'; 

if (isset($_POST['submit_login'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = $_POST['password']; 

    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Support hashed passwords and legacy plaintext
        if (password_verify($password, $row['password']) || $password === $row['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['status'] = "login";
            
            header("Location: admin/dashboard.php");
            exit(); 
        }
    }
    
    echo "<script>alert('Invalid Username or Password!'); window.location='login.php';</script>";
} else {
    header("Location: login.php");
    exit();
}
?>
