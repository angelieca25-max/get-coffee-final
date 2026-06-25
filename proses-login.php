<?php
session_start();
include 'koneksi.php'; 

function logAdminLogin($conn, $adminId, $username, $status) {
    $adminId = intval($adminId);
    $username = mysqli_real_escape_string($conn, trim($username));
    $status = mysqli_real_escape_string($conn, trim($status));
    $ipAddress = mysqli_real_escape_string($conn, $_SERVER['REMOTE_ADDR'] ?? '');
    $activity = 'Login Dashboard';
    $details = "username=$username, status=$status";
    mysqli_query($conn, "INSERT INTO admin_history (admin_id, target_admin_id, activity, details, ip_address, created_at) VALUES ($adminId, NULL, '$activity', '$details', '$ipAddress', NOW())");
}

if (isset($_POST['submit_login'])) {
   
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password']; 

   
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $data  = mysqli_query($koneksi, $query);
    
    
    $cek = mysqli_num_rows($data);

    if ($cek > 0) {
        $row = mysqli_fetch_assoc($data);
        $_SESSION['id_admin'] = $row['id_admin'];
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";

        logAdminLogin($koneksi, $row['id_admin'], $username, 'sukses');
        
        header("location:admin/dashboard.php");
        exit(); 
    } else {
       
        $failedAdmin = mysqli_query($koneksi, "SELECT id_admin FROM admin WHERE username = '$username'");
        if (mysqli_num_rows($failedAdmin) > 0) {
            $failedRow = mysqli_fetch_assoc($failedAdmin);
            logAdminLogin($koneksi, $failedRow['id_admin'], $username, 'gagal');
        }
        echo "<script>alert('Username atau Password salah!'); window.location='login.php';</script>";
    }
} else {
    header("location:login.php");
    exit();
}
?>