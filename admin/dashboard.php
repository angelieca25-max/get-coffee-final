<?php

session_start();


if(!isset($_SESSION['username'])) { header("Location: ../login.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Get Coffee</title>
</head>
<body>

    <h1>GET COFFEE - ADMIN HUB</h1>

    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="menu.php">Kelola Menu</a></li>
        <li><a href="../logout.php">Logout</a></li>
    </ul>

</body>
</html>
