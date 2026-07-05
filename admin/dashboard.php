<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Get Coffee</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>

<div class="admin-box">
    <h2>GET COFFEE - ADMIN HUB</h2>
    <p style="color: var(--text-muted); margin-bottom: 25px;">Welcome to the Admin Control Panel!</p>
    <hr style="border: 0; border-top: 1px solid var(--glass-border); margin-bottom: 20px;">

    <h3>Navigation Menu:</h3>
    <ul class="admin-nav">
        <li><a href="menu.php">Manage Menus</a></li>
        <li><a href="category.php">Manage Categories</a></li>
        <li><a href="users.php">Manage Users</a></li>
        <li><a href="testimonials.php">Manage Testimonials</a></li>
        <li><a href="../logout.php" style="background: rgba(255, 107, 107, 0.05); color: var(--danger-color); border-color: rgba(255, 107, 107, 0.2);">Logout</a></li>
    </ul>
</div>

</body>
</html>
