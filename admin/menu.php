<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "db_getcoffee"); 

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "SELECT * FROM menu";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Get Coffee</title>
 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #fcf8f4;
            color: #2b2b2b;
            padding-bottom: 80px; 
        }

        /* Navbar Styling */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            margin: 20px auto;
            padding: 15px 40px;
            border-radius: 50px;
            width: 95%;
            max-width: 1200px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 20px;
        }

        .brand img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #666;
            font-weight: 600;
            font-size: 15px;
        }

        .nav-links a.active {
            color: #2b2b2b;
            background-color: #f0e6df;
            padding: 8px 20px;
            border-radius: 20px;
        }

        .btn-order {
            background-color: #321f14;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
        }

        /* Main Content Layout */
        .container {
            display: flex;
            max-width: 1200px;
            margin: 60px auto 0 auto;
            padding: 0 40px;
            gap: 50px;
            align-items: flex-start;
        }

        .left-content {
            flex: 1;
            position: sticky; 
            top: 40px;
        }

        .sub-title {
            color: #c49a6c;
            font-size
