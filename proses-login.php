<?php
session_start();
include 'koneksi.php'; 

if (isset($_POST['submit_login'])) {
   
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password']; 

   
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $data  = mysqli_query($koneksi, $query);
    
    
    $cek = mysqli_num_rows($data);

    if ($cek > 0) {
        
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        
       
        header("location:index.php");
    } else {
       
        echo "<script>alert('Username atau Password salah!'); window.location='login.php';</script>";
    }
} else {
    header("location:login.php");
}
?>