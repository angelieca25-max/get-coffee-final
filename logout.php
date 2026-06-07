<?php
session_start();
session_destroy(); // Menghapus semua session login aktif
header("location:login.php"); 
exit;
?>
